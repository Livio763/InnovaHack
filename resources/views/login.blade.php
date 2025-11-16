@extends('layouts.app')

@section('title', 'GIA - Iniciar sesión')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white border border-gray-100 rounded-3xl shadow-2xl p-8">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('assets/images/childfund-logo.jpg') }}" alt="ChildFund Bolivia" class="h-20 object-contain mb-3">
            <h1 class="text-3xl font-extrabold text-gray-900">Iniciar sesión</h1>
            <p class="text-sm text-gray-600">Accede a tu cuenta para continuar</p>
        </div>

        <form id="loginForm" action="{{ route('api.login') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/>
                    </svg>
                    Correo o teléfono
                </label>
                <input 
                    type="text" 
                    name="identifier"
                    id="identifier" 
                    required
                    placeholder="Ej: juan@ejemplo.com o 71234567" 
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-600 focus:outline-none text-gray-800 font-semibold">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Contraseña
                </label>
                <input 
                    type="password" 
                    name="password"
                    id="password" 
                    required
                    placeholder="••••••" 
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-green-600 focus:outline-none text-gray-800 font-semibold">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4">
                    Recordarme
                </label>
                <a href="{{ url('index.php/register') }}" class="text-sm font-semibold hover:underline" style="color:#009639">Registrarme</a>
            </div>

            <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded-lg text-xs"></div>

            <button 
                type="submit" 
                class="w-full text-white font-bold text-lg py-4 px-8 rounded-full shadow-lg transform hover:scale-105 transition-all duration-200" 
                style="background:#009639">
                Entrar
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const errorMessage = document.getElementById('errorMessage');
        const submitButton = this.querySelector('button[type="submit"]');
        
        // Deshabilitar botón y mostrar estado de carga
        submitButton.disabled = true;
        const originalButtonText = submitButton.textContent;
        submitButton.textContent = 'Iniciando sesión...';
        
        // Limpiar errores previos
        errorMessage.classList.add('hidden');
        errorMessage.textContent = '';
        
        try {
            const response = await fetch(`${window.APP_API_BASE}/login`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    identifier: formData.get('identifier'),
                    password: formData.get('password')
                })
            });
            
            const data = await response.json();
            
            if (response.ok) {
                // Guardar token y datos del usuario
                localStorage.setItem('auth_token', data.token);
                localStorage.setItem('user', JSON.stringify(data.user));
                localStorage.setItem('isLoggedIn', 'true');
                
                // Redirigir a dashboard (home)
                window.location.href = window.APP_BASE_URL + '/index.php/dashboard';
            } else {
                // Mostrar errores de validación o mensaje general
                if (data.errors) {
                    const errorMessages = Object.values(data.errors).flat().join('<br>');
                    errorMessage.innerHTML = errorMessages;
                } else {
                    errorMessage.textContent = data.message || 'Credenciales incorrectas';
                }
                errorMessage.classList.remove('hidden');
                
                // Rehabilitar botón
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        } catch (error) {
            console.error('Error de login:', error);
            errorMessage.textContent = 'Error de conexión. Por favor verifica tu conexión a internet e inténtalo de nuevo.';
            errorMessage.classList.remove('hidden');
            
            // Rehabilitar botón
            submitButton.disabled = false;
            submitButton.textContent = originalButtonText;
        }
    });
</script>
@endpush
@endsection
