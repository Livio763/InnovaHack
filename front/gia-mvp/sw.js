// Service Worker para GIA
// Versión: 1.0.0

const CACHE_NAME = 'gia-v2';
const urlsToCache = [
  '/',
  '/index.html',
  '/welcome.html',
  '/diagnostic.html',
  '/classification.html',
  '/evaluation-pending.html',
  '/login.html',
  '/home.html',
  '/modules.html',
  '/test.html',
  '/mission.html',
  '/success.html',
  '/admin-dashboard.html',
  '/js/app.js',
  '/manifest.json'
];

// Instalación del Service Worker
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        console.log('Cache abierto');
        return cache.addAll(urlsToCache);
      })
  );
});

// Activación del Service Worker
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheName !== CACHE_NAME) {
            console.log('Eliminando cache antiguo:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});

// Estrategia: Cache First (Network Fallback)
self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request)
      .then((response) => {
        // Cache hit - devolver respuesta del cache
        if (response) {
          return response;
        }

        // No está en cache - hacer petición a red
        return fetch(event.request).then((response) => {
          // Verificar si recibimos una respuesta válida
          if (!response || response.status !== 200 || response.type !== 'basic') {
            return response;
          }

          // Clonar la respuesta para guardarla en cache
          const responseToCache = response.clone();

          caches.open(CACHE_NAME)
            .then((cache) => {
              cache.put(event.request, responseToCache);
            });

          return response;
        });
      })
      .catch(() => {
        // Si falla la red, mostrar página offline simple
        return new Response(
          `<!DOCTYPE html>
          <html lang="es">
          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>GIA - Sin conexión</title>
            <style>
              body {
                font-family: 'Nunito', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
              }
              .container {
                background: white;
                border-radius: 20px;
                padding: 40px;
                text-align: center;
                max-width: 400px;
              }
              h1 { font-size: 60px; margin: 0 0 20px 0; }
              h2 { color: #333; margin: 0 0 10px 0; }
              p { color: #666; line-height: 1.6; }
            </style>
          </head>
          <body>
            <div class="container">
              <h1>📡</h1>
              <h2>Sin conexión</h2>
              <p>No te preocupes, GIA funciona offline. Recarga cuando tengas conexión.</p>
            </div>
          </body>
          </html>`,
          {
            headers: { 'Content-Type': 'text/html' }
          }
        );
      })
  );
});
