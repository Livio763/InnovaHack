// API client for GIA
// Works with Laravel backend (recommended) and gracefully falls back to localStorage

const RAW_BASE = (typeof window !== 'undefined' && window.APP_BASE_URL) || window.location.origin;
const API_BASE_PRIMARY = (typeof window !== 'undefined' && window.APP_API_BASE)
  ? window.APP_API_BASE.replace(/\/$/, '')
  : (RAW_BASE.replace(/\/$/, '') + '/api');
const API_BASE_FALLBACK = RAW_BASE.replace(/\/$/, '') + '/index.php/api';

function getToken() {
  return localStorage.getItem('auth_token') || localStorage.getItem('authToken') || '';
}

async function apiRequest(path, { method = 'GET', body = null, auth = false } = {}) {
  const headers = { 'Content-Type': 'application/json' };
  if (auth && getToken()) headers['Authorization'] = `Bearer ${getToken()}`;

  let res = await fetch(`${API_BASE_PRIMARY}${path}`, {
    method,
    headers,
    body: body ? JSON.stringify(body) : null,
    credentials: 'omit'
  });

  // Fallback: si 404 o 405, intenta con ruta alternativa usando index.php
  if (!res.ok && (res.status === 404 || res.status === 405)) {
    try {
      res = await fetch(`${API_BASE_FALLBACK}${path}`, {
        method,
        headers,
        body: body ? JSON.stringify(body) : null,
        credentials: 'omit'
      });
    } catch (e) { /* ignore */ }
  }

  if (!res.ok) {
    const text = await res.text().catch(() => '');
    const err = new Error(`API ${method} ${path} failed: ${res.status}`);
    err.responseText = text;
    throw err;
  }
  return res.json().catch(() => ({}));
}

export const api = {
  // Auth
  async register(data) {
    // Expected Laravel route: POST /api/register
    // returns { token, user }
    return apiRequest('/api/register', { method: 'POST', body: data });
  },
  async login(identifier, password) {
    // Expected Laravel route: POST /api/login
    // body: { identifier: emailOrPhone, password }
    // returns { token, user }
    return apiRequest('/api/login', { method: 'POST', body: { identifier, password } });
  },
  async me() {
    return apiRequest('/api/me', { auth: true });
  },
  async setLevel(level) {
    // PATCH /api/me/level { level: 'pre' | 'incubadora' | 'pending' }
    return apiRequest('/api/me/level', { method: 'PATCH', auth: true, body: { level } });
  },
  async createApplication() {
    // POST /api/applications { type: 'incubator' }
    return apiRequest('/api/applications', { method: 'POST', auth: true, body: { type: 'incubator' } });
  }
};

// Helpers to sync API user to localStorage fallback
export function syncUserLocal(user) {
  if (!user) return;
  const mapped = {
    fullName: user.name || user.full_name || 'Usuario',
    phone: user.phone || '',
    email: user.email || '',
    age: user.age || null,
    city: user.city || '',
    registeredAt: user.created_at || new Date().toISOString()
  };
  localStorage.setItem('userData', JSON.stringify(mapped));
  if (user.level) localStorage.setItem('userLevel', user.level);
}

export function setToken(token) {
  if (token) localStorage.setItem('authToken', token);
}
