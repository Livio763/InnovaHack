/**
 * Auth Guard - Protege páginas que requieren autenticación
 * Verifica si existe token en localStorage y redirige si no está autenticado
 */

function checkAuth() {
    const token = localStorage.getItem('auth_token') || localStorage.getItem('authToken');
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const userStr = localStorage.getItem('user');
    let user = null;
    try { user = userStr ? JSON.parse(userStr) : null; } catch (e) {}

    const base = (typeof window !== 'undefined' && window.APP_BASE_URL) ? window.APP_BASE_URL : window.location.origin;
    const url = (p) => `${base}/index.php/${p}`.replace(/\/+$/,'').replace(/([^:])\/\/+/, '$1/');

    if (!token || !isLoggedIn || isLoggedIn !== 'true') {
        window.location.href = url('login');
        return false;
    }

    const level = user && user.level ? String(user.level) : null;

    // Si no tiene 'stage' definido ('P' o 'I'), forzar clasificación
    if (!user || !user.stage) {
        window.location.href = url('classification');
        return false;
    }

    // Si está en etapa Incubadora (I) y aún está pendiente, enviar a evaluación/pending
    if (user.stage === 'I' && (!level || level === 'pending')) {
        window.location.href = url('evaluation-pending');
        return false;
    }

    // Si el nivel sigue pendiente (para etapa P), forzar clasificación
    if (!level || level === 'pending') {
        window.location.href = url('classification');
        return false;
    }

    return true;
}

function getUserData() {
    const userDataStr = localStorage.getItem('user');
    if (userDataStr) {
        try {
            return JSON.parse(userDataStr);
        } catch (e) {
            console.error('Error al parsear datos de usuario:', e);
            return null;
        }
    }
    return null;
}

function logout() {
    localStorage.removeItem('auth_token');
    localStorage.removeItem('user');
    localStorage.removeItem('isLoggedIn');
    const base = (typeof window !== 'undefined' && window.APP_BASE_URL) ? window.APP_BASE_URL : window.location.origin;
    // Ir a la pantalla de registro (raíz /public/) sin index.php
    window.location.href = `${base}/`;
}

// Exportar funciones para uso global
window.authGuard = {
    checkAuth,
    getUserData,
    logout
};
