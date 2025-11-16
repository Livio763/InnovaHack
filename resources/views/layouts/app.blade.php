<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GIA - Guía de Incubación Asistida')</title>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#009639">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script>
        (function(){
            var host = @json(request()->getSchemeAndHttpHost());
            var base = @json(request()->getBaseUrl() ?: '');
            // Si el base incluye index.php lo removemos
            base = base.replace(/\/index\.php$/, '');
            window.APP_BASE_URL = (host + base).replace(/\/$/, '');
            // API base usando index.php para evitar problemas de rewrite en Apache/subcarpetas
            window.APP_API_BASE = (window.APP_BASE_URL + '/index.php/api').replace(/\/$/, '');
        })();
    </script>
    <style>
        :root {
            --cf-green: #009639;
            --cf-green-dark: #007a33;
            --cf-orange: #FF6B35;
            --cf-text: #333333;
            --cf-bg: #FFFFFF;
        }
        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--cf-bg);
            color: var(--cf-text);
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen">
    @yield('content')
    <!-- Asistente GIA flotante -->
    <div id="giaAssistant" class="fixed bottom-6 right-6 z-50">
        <!-- Bot\u00f3n flotante -->
        <button id="giaToggle" class="w-16 h-16 rounded-full shadow-2xl flex items-center justify-center text-white transform hover:scale-110 transition-all duration-300" style="background: linear-gradient(135deg, #009639 0%, #007a2e 100%)">
            <svg id="giaIcon" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
            <svg id="giaCloseIcon" class="w-8 h-8 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Panel de chat -->
        <div id="giaPanel" class="hidden absolute bottom-20 right-0 w-96 bg-white rounded-2xl shadow-2xl border-2 border-green-200 overflow-hidden">
            <!-- Header -->
            <div class="p-4 text-white" style="background: linear-gradient(135deg, #009639 0%, #007a2e 100%)">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white bg-opacity-30 flex items-center justify-center">
                        <span class="text-2xl">🤖</span>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-lg">GIA Assistant</h3>
                        <p class="text-xs text-green-100">Tu guía emprendedora</p>
                    </div>
                </div>
            </div>

            <!-- Mensajes -->
            <div id="giaChatMessages" class="h-96 overflow-y-auto p-4 bg-gray-50 space-y-3">
                <!-- Mensaje de bienvenida (se generar\u00e1 con JS) -->
            </div>

            <!-- Botones r\u00e1pidos -->
            <div id="giaQuickButtons" class="px-4 py-2 bg-white border-t border-gray-200 flex flex-wrap gap-2">
                <button onclick="giaQuickQuestion('¿Qu\u00e9 debo hacer ahora?')" class="text-xs px-3 py-1 rounded-full border border-green-600 text-green-700 hover:bg-green-50 transition">
                    💡 ¿Qu\u00e9 sigue?
                </button>
                <button onclick="giaQuickQuestion('Resum\u00e9 este m\u00f3dulo')" class="text-xs px-3 py-1 rounded-full border border-green-600 text-green-700 hover:bg-green-50 transition">
                    📚 Resumen
                </button>
                <button onclick="giaQuickQuestion('Dame un consejo')" class="text-xs px-3 py-1 rounded-full border border-green-600 text-green-700 hover:bg-green-50 transition">
                    🚀 Consejo
                </button>
            </div>

            <!-- Input -->
            <div class="p-4 bg-white border-t border-gray-200">
                <div class="flex gap-2">
                    <input id="giaInput" type="text" placeholder="Escribe tu pregunta..." class="flex-1 px-4 py-2 border-2 border-gray-200 rounded-xl focus:border-green-600 focus:outline-none text-sm" />
                    <button id="giaSend" class="px-4 py-2 rounded-xl text-white font-bold shadow-md hover:shadow-lg transition" style="background: #009639">
                        Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/api.js') }}" type="module"></script>
        <script src="{{ asset('js/assistant.js') }}"></script>
    @stack('scripts')
</body>
</html>
