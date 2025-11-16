@extends('layouts.app')

@section('title', 'GIA - Bienvenido')

@section('content')
<x-header />

<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 gap-6 items-start">
            <!-- Info -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <div class="space-y-3 mb-4">
                    <h2 class="text-xl font-bold text-gray-800">¿Qué es GIA?</h2>
                    <p class="text-sm text-gray-700">Tu <strong>asistente digital personalizado</strong> que te acompaña en cada paso de tu viaje emprendedor.</p>
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2 mt-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--cf-green)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Nuestro Objetivo
                    </h3>
                    <p class="text-sm text-gray-700">Impulsar a jóvenes bolivianos a crear y escalar negocios con <strong>impacto social, económico y ambiental</strong>.</p>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--cf-green)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <p class="text-sm font-semibold text-gray-800">Videos cortos y prácticos</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--cf-green)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        <p class="text-sm font-semibold text-gray-800">Puntos e insignias</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--cf-green)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        <p class="text-sm font-semibold text-gray-800">Ruta personalizada</p>
                    </div>
                </div>

                <!-- Botón destacado de iniciar sesión (izquierda) -->
                <div class="mt-6">
                    <a href="{{ url('index.php/login') }}" class="inline-flex items-center justify-center w-full md:w-auto px-7 py-3 rounded-full font-extrabold text-white shadow-lg transform hover:scale-105 transition-all duration-200" style="background: var(--cf-green)">
                        Iniciar sesión
                    </a>
                        <p class="mt-2 text-xs text-gray-600">Si ya tienes una cuenta, entra aquí.</p>
                    </div>
                    <p class="text-center text-xs text-gray-600 mt-4">¿Ya tienes cuenta? <a href="#" onclick="showLoginModal(); return false;" class="font-bold hover:underline" style="color: var(--cf-green)">Inicia sesión</a></p>
                    <p class="mt-2 text-xs text-gray-600">Si ya tienes una cuenta, entra aquí.</p>
                </div>
            </div>

            <!-- Registro -->
            <div class="bg-white rounded-2xl shadow-2xl p-6 border border-gray-100">
                <h2 class="text-2xl font-extrabold text-gray-800 mb-1 text-center">Regístrate</h2>
                <p class="text-sm text-gray-600 text-center mb-4">Es gratis y toma menos de 1 minuto</p>

                <form id="registerForm" class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Nombre completo
                        </label>
                        <input type="text" id="fullName" required placeholder="Ej: Juan Pérez Mamani" class="w-full px-3 py-2 text-sm rounded-lg border-2 border-gray-200 focus:border-green-600 focus:outline-none text-gray-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Teléfono
                        </label>
                        <input type="tel" id="phone" required placeholder="Ej: 71234567" pattern="[0-9]{8}" class="w-full px-3 py-2 text-sm rounded-lg border-2 border-gray-200 focus:border-green-600 focus:outline-none text-gray-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Correo electrónico
                        </label>
                        <input type="email" id="email" required placeholder="Ej: juan@ejemplo.com" class="w-full px-3 py-2 text-sm rounded-lg border-2 border-gray-200 focus:border-green-600 focus:outline-none text-gray-800">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z"/></svg>
                                Edad
                            </label>
                            <input type="number" id="age" required min="16" max="99" placeholder="Ej: 22" class="w-full px-3 py-2 text-sm rounded-lg border-2 border-gray-200 focus:border-green-600 focus:outline-none text-gray-800">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Departamento
                            </label>
                            <select id="city" required class="w-full px-3 py-2 text-sm rounded-lg border-2 border-gray-200 focus:border-green-600 focus:outline-none text-gray-800">
                                <option value="">Selecciona tu departamento</option>
                                <option value="La Paz">La Paz</option>
                                <option value="Cochabamba">Cochabamba</option>
                                <option value="Santa Cruz">Santa Cruz</option>
                                <option value="Oruro">Oruro</option>
                                <option value="Potosí">Potosí</option>
                                <option value="Chuquisaca">Chuquisaca</option>
                                <option value="Tarija">Tarija</option>
                                <option value="Beni">Beni</option>
                                <option value="Pando">Pando</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                Contraseña
                            </label>
                            <input type="password" id="password" required minlength="6" placeholder="Mínimo 6 caracteres" class="w-full px-3 py-2 text-sm rounded-lg border-2 border-gray-200 focus:border-green-600 focus:outline-none text-gray-800">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                Verificar contraseña
                            </label>
                            <input type="password" id="confirmPassword" required minlength="6" placeholder="Repite tu contraseña" class="w-full px-3 py-2 text-sm rounded-lg border-2 border-gray-200 focus:border-green-600 focus:outline-none text-gray-800">
                        </div>
                    </div>
                    <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded-lg text-xs"></div>
                    <button type="submit" class="w-full text-white font-bold text-base py-3 px-6 rounded-full shadow-lg transform hover:scale-105 transition-all duration-200" style="background: var(--cf-green);">Crear cuenta</button>
                </form>

                <p class="text-center text-xs text-gray-600 mt-4">¿Ya tienes cuenta? <a href="{{ url('index.php/login') }}" class="font-bold hover:underline" style="color: var(--cf-green)">Inicia sesión</a></p>
                    <p class="text-center text-xs text-gray-600 mt-4">¿Ya tienes cuenta? <a href="#" onclick="showLoginModal(); return false;" class="font-bold hover:underline" style="color: var(--cf-green)">Inicia sesión</a></p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('registerForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const fullName = document.getElementById('fullName').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const email = document.getElementById('email').value.trim();
        const age = document.getElementById('age').value.trim();
        const city = document.getElementById('city').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const errorMessage = document.getElementById('errorMessage');
        const submitBtn = document.querySelector('button[type="submit"]');

        // Validaciones
        if (!fullName || !phone || !email || !age || !city || !password || !confirmPassword) { 
            errorMessage.textContent='Por favor completa todos los campos'; 
            errorMessage.classList.remove('hidden'); 
            return; 
        }
        if (phone.length !== 8 || isNaN(phone)) { 
            errorMessage.textContent='El teléfono debe tener 8 dígitos'; 
            errorMessage.classList.remove('hidden'); 
            return; 
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
        if (!emailRegex.test(email)) { 
            errorMessage.textContent='Ingresa un correo electrónico válido'; 
            errorMessage.classList.remove('hidden'); 
            return; 
        }
        const ageNum = parseInt(age); 
        if (ageNum < 16 || ageNum > 99) { 
            errorMessage.textContent='Debes tener al menos 16 años'; 
            errorMessage.classList.remove('hidden'); 
            return; 
        }
        if (password.length < 6) { 
            errorMessage.textContent='La contraseña debe tener al menos 6 caracteres'; 
            errorMessage.classList.remove('hidden'); 
            return; 
        }
        if (password !== confirmPassword) { 
            errorMessage.textContent='Las contraseñas no coinciden'; 
            errorMessage.classList.remove('hidden'); 
            return; 
        }

        // Deshabilitar botón y mostrar loading
        submitBtn.disabled = true;
        submitBtn.textContent = 'Creando cuenta...';
        errorMessage.classList.add('hidden');

        try {
            // Registrar en la API
            const response = await fetch(`${window.APP_API_BASE}/register`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: fullName,
                    email: email,
                    password: password,
                    password_confirmation: confirmPassword,
                    phone: phone,
                    age: ageNum,
                    city: city
                })
            });

            const data = await response.json();

            if (response.ok) {
                // Guardar token y datos del usuario
                localStorage.setItem('auth_token', data.token);
                localStorage.setItem('user', JSON.stringify(data.user));
                localStorage.setItem('isLoggedIn', 'true');
                
                // Redirigir a clasificación (forzando index.php para Apache)
                window.location.href = '{{ url('index.php/classification') }}';
            } else {
                // Mostrar errores de validación
                if (data.errors) {
                    const firstError = Object.values(data.errors)[0][0];
                    errorMessage.textContent = firstError;
                } else {
                    errorMessage.textContent = data.message || 'Error al crear la cuenta';
                }
                errorMessage.classList.remove('hidden');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Crear cuenta';
            }
        } catch (error) {
            console.error('Error:', error);
            errorMessage.textContent = 'Error de conexión. Verifica tu internet.';
            errorMessage.classList.remove('hidden');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Crear cuenta';
        }
    });
</script>
@endpush
@endsection
