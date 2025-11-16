// GIA - JavaScript principal
// Manejo de localStorage, navegación y estado de misiones

// ==========================================
// FUNCIONES DE STORAGE
// ==========================================

function saveAnswer(key, value) {
    localStorage.setItem(key, value);
}

function getAnswer(key) {
    return localStorage.getItem(key);
}

function clearAllData() {
    localStorage.clear();
}

// ==========================================
// GESTIÓN DE MISIONES
// ==========================================

function getMissionsCompleted() {
    const completed = localStorage.getItem('missionsCompleted');
    return completed ? JSON.parse(completed) : [];
}

function markMissionCompleted(missionId) {
    const completed = getMissionsCompleted();
    if (!completed.includes(missionId)) {
        completed.push(missionId);
        localStorage.setItem('missionsCompleted', JSON.stringify(completed));
        return true;
    }
    return false;
}

function isMissionCompleted(missionId) {
    return getMissionsCompleted().includes(missionId);
}

// ==========================================
// GESTIÓN DE PUNTOS
// ==========================================

function getTotalPoints() {
    return parseInt(localStorage.getItem('totalPoints') || '0');
}

function addPoints(points) {
    const current = getTotalPoints();
    const newTotal = current + points;
    localStorage.setItem('totalPoints', newTotal.toString());
    return newTotal;
}

// ==========================================
// GESTIÓN DE INSIGNIAS
// ==========================================

function getBadges() {
    const badges = localStorage.getItem('badges');
    return badges ? JSON.parse(badges) : [];
}

function addBadge(badgeId, badgeName, badgeIcon) {
    const badges = getBadges();
    
    // Verificar si ya existe
    if (badges.find(b => b.id === badgeId)) {
        return false;
    }
    
    badges.push({
        id: badgeId,
        name: badgeName,
        icon: badgeIcon,
        earnedAt: new Date().toISOString()
    });
    
    localStorage.setItem('badges', JSON.stringify(badges));
    return true;
}

// ==========================================
// MANEJO DE IMÁGENES
// ==========================================

function saveImage(key, base64Image) {
    try {
        localStorage.setItem(key, base64Image);
        return true;
    } catch (e) {
        console.error('Error al guardar imagen:', e);
        // Si falla por tamaño, intentar comprimir
        return false;
    }
}

function getImage(key) {
    return localStorage.getItem(key);
}

// ==========================================
// VALIDACIÓN DE RUTA
// ==========================================

function hasCompletedOnboarding() {
    return localStorage.getItem('stage') && localStorage.getItem('category');
}

function redirectToOnboardingIfNeeded() {
    if (!hasCompletedOnboarding()) {
        window.location.href = 'index.html';
    }
}

// ==========================================
// UTILIDADES
// ==========================================

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('es-BO', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

function getRouteInfo() {
    const stage = getAnswer('stage');
    const category = getAnswer('category');
    
    if (!stage || !category) return null;
    
    let routeName = '';
    let routeDescription = '';
    let routeColor = '';
    
    if (stage === 'idea') {
        routeName = '🌱 Ruta Pre-incubadora';
        routeDescription = 'Convertiremos tu idea en un producto real';
        routeColor = 'from-green-400 to-teal-500';
    } else if (stage === 'active') {
        if (category === 'food') {
            routeName = '🍕 Digitaliza tu Sabor';
            routeDescription = 'Lleva tu negocio de comida al siguiente nivel';
            routeColor = 'from-orange-400 to-red-500';
        } else if (category === 'fashion') {
            routeName = '👗 Moda con Impacto';
            routeDescription = 'Crea una marca de moda memorable';
            routeColor = 'from-purple-400 to-pink-500';
        } else {
            routeName = '🚀 Ruta Incubadora';
            routeDescription = 'Escala tu negocio con estrategias digitales';
            routeColor = 'from-blue-500 to-purple-600';
        }
    }
    
    return { routeName, routeDescription, routeColor };
}

// ==========================================
// ANALYTICS (simulado)
// ==========================================

function trackEvent(eventName, eventData = {}) {
    console.log('Event:', eventName, eventData);
    // En producción, aquí irían llamadas a analytics reales
}

// ==========================================
// INSTALACIÓN PWA
// ==========================================

let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    
    // Mostrar botón de instalación (si existe)
    const installButton = document.getElementById('installButton');
    if (installButton) {
        installButton.style.display = 'block';
    }
});

function installApp() {
    if (deferredPrompt) {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('Usuario aceptó instalar PWA');
                trackEvent('pwa_installed');
            }
            deferredPrompt = null;
        });
    }
}

// ==========================================
// REGISTRO DE SERVICE WORKER
// ==========================================

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('Service Worker registrado:', registration.scope);
            })
            .catch(error => {
                console.log('Error al registrar Service Worker:', error);
            });
    });
}

// ==========================================
// COMPARTIR (Web Share API)
// ==========================================

function shareContent(title, text, url) {
    if (navigator.share) {
        navigator.share({
            title: title,
            text: text,
            url: url || window.location.href
        })
        .then(() => {
            trackEvent('content_shared', { title });
        })
        .catch((error) => {
            console.log('Error al compartir:', error);
        });
    } else {
        // Fallback: copiar al portapapeles
        const fullText = `${title}\n${text}\n${url || window.location.href}`;
        navigator.clipboard.writeText(fullText)
            .then(() => {
                alert('¡Link copiado al portapapeles!');
            })
            .catch(() => {
                alert('No se pudo compartir. Intenta desde tu navegador.');
            });
    }
}

// ==========================================
// INICIALIZACIÓN
// ==========================================

document.addEventListener('DOMContentLoaded', () => {
    console.log('GIA App iniciada');
    trackEvent('page_view', { page: window.location.pathname });
});

// ==========================================
// EXPORTAR FUNCIONES GLOBALES
// ==========================================

window.GIA = {
    saveAnswer,
    getAnswer,
    clearAllData,
    getMissionsCompleted,
    markMissionCompleted,
    isMissionCompleted,
    getTotalPoints,
    addPoints,
    getBadges,
    addBadge,
    saveImage,
    getImage,
    hasCompletedOnboarding,
    redirectToOnboardingIfNeeded,
    getRouteInfo,
    trackEvent,
    installApp,
    shareContent
};
