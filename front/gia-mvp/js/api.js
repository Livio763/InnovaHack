// API client for GIA
// Works with Laravel backend (recommended) and gracefully falls back to localStorage

const API_BASE_URL = (localStorage.getItem('API_BASE_URL') || 'http://127.0.0.1:8000').replace(/\/$/, '');

function getToken() {
  return localStorage.getItem('authToken') || '';
}

async function apiRequest(path, { method = 'GET', body = null, auth = false } = {}) {
  const headers = { 'Content-Type': 'application/json' };
  if (auth && getToken()) headers['Authorization'] = `Bearer ${getToken()}`;

  const res = await fetch(`${API_BASE_URL}${path}`, {
    method,
    headers,
    body: body ? JSON.stringify(body) : null,
    credentials: 'omit'
  });

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
