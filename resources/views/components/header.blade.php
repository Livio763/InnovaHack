<header class="bg-white border-b border-gray-200 shadow-sm">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <img src="{{ asset('assets/images/childfund-logo.jpg') }}" alt="ChildFund Bolivia" class="h-12 object-contain">
                <div class="border-l-2 border-gray-300 h-10"></div>
                <div>
                    <h1 class="text-3xl font-extrabold" style="color: var(--cf-green)">GIA</h1>
                    <p class="text-xs text-gray-600">Guía de Incubación Asistida</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button
                    id="logoutBtn"
                    title="Cerrar sesión"
                    class="text-sm font-bold px-4 py-2 rounded-full border-2 border-green-600 text-green-700 hover:bg-green-50 transition"
                    style="display:none"
                    onclick="(window.authGuard && window.authGuard.logout) ? window.authGuard.logout() : (function(){try{localStorage.removeItem('auth_token');localStorage.removeItem('authToken');localStorage.removeItem('user');localStorage.removeItem('isLoggedIn');}catch(e){} var base=(window.APP_BASE_URL||window.location.origin); window.location.href=base + '/index.php/login';})()">
                    Cerrar sesión
                </button>
            </div>
        </div>
    </div>
    <script>
        (function(){
            try {
                var isLogged = (localStorage.getItem('isLoggedIn') === 'true') && (localStorage.getItem('auth_token') || localStorage.getItem('authToken'));
                var btn = document.getElementById('logoutBtn');
                if (btn) { btn.style.display = isLogged ? 'inline-flex' : 'none'; }
            } catch (e) {}
        })();
    </script>
    </header>
