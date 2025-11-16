@extends('layouts.app')

@section('title', 'Clasificación - GIA')

@section('content')
<x-header />

<div class="container mx-auto px-4 py-6 min-h-screen flex items-center justify-center">
    <div class="max-w-4xl w-full">
        <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold mb-3" style="color: var(--cf-green)">¡Bienvenido a GIA!</h1>
                <p class="text-lg text-gray-700">Para comenzar, cuéntanos en qué etapa te encuentras</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Opción: Tengo una idea -->
                <button onclick="selectIdea()" class="group relative overflow-hidden bg-gradient-to-br from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 border-3 border-green-200 hover:border-green-500 rounded-2xl p-8 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <div class="relative z-10">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full flex items-center justify-center" style="background: var(--cf-green)">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-extrabold text-gray-800 mb-3">Tengo una idea</h3>
                        <p class="text-sm text-gray-600 mb-4">Estoy en la etapa de ideación y quiero validar mi propuesta</p>
                        <div class="space-y-2 text-left">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 shrink-0 mt-0.5" style="color: var(--cf-green)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs text-gray-700">Validación de idea</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 shrink-0 mt-0.5" style="color: var(--cf-green)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs text-gray-700">Diseño de propuesta</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 shrink-0 mt-0.5" style="color: var(--cf-green)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs text-gray-700">Introducción a finanzas y marketing</span>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-green-400/0 to-emerald-400/0 group-hover:from-green-400/10 group-hover:to-emerald-400/10 transition-all duration-300"></div>
                </button>

                <!-- Opción: Tengo un negocio -->
                <button onclick="openBusinessModal()" class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 border-3 border-blue-200 hover:border-blue-500 rounded-2xl p-8 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <div class="relative z-10">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-blue-600 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-extrabold text-gray-800 mb-3">Tengo un negocio</h3>
                        <p class="text-sm text-gray-600 mb-4">Ya tengo un emprendimiento operando y quiero crecer</p>
                        <div class="space-y-2 text-left">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 shrink-0 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs text-gray-700">Programa Pre-incubadora</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 shrink-0 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs text-gray-700">Fortalecimiento del modelo</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 shrink-0 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-xs text-gray-700">Preparación para Incubadora</span>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400/0 to-indigo-400/0 group-hover:from-blue-400/10 group-hover:to-indigo-400/10 transition-all duration-300"></div>
                </button>
            </div>

            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">Puedes cambiar tu ruta más adelante según tu progreso</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal negocio: elegir Pre o Incubación -->
<div id="businessModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-extrabold text-gray-800 mb-2">¿Tienes un negocio?</h3>
        <p class="text-sm text-gray-600 mb-4">Elige cómo quieres continuar</p>
        <div class="space-y-3">
            <button onclick="choosePreFromBusiness()" class="w-full px-4 py-3 rounded-xl font-bold border-2 border-green-600 text-green-700 hover:bg-green-50">Entrar a cursos Pre-incubación</button>
            <button onclick="chooseIncubator()" class="w-full px-4 py-3 rounded-xl font-bold border-2 border-blue-600 text-blue-700 hover:bg-blue-50">Solicitar entrar a Incubación</button>
        </div>
        <button onclick="closeBusinessModal()" class="mt-4 text-sm text-gray-600 hover:underline">Cancelar</button>
    </div>
    
</div>

@push('scripts')
<script>
    function openBusinessModal(){ document.getElementById('businessModal').classList.remove('hidden'); document.getElementById('businessModal').classList.add('flex'); }
    function closeBusinessModal(){ document.getElementById('businessModal').classList.add('hidden'); document.getElementById('businessModal').classList.remove('flex'); }

    async function selectIdea(){
        await saveSelection({ level: 'pre', stage: 'P', diagnostic_option: 'idea' });
    }
    async function choosePreFromBusiness(){
        closeBusinessModal();
        await saveSelection({ level: 'pre', stage: 'P', diagnostic_option: 'negocio' });
    }
    async function chooseIncubator(){
        closeBusinessModal();
        // Marca solicitud de incubación: stage='I' y mantener level='pending'
        const ok = await saveSelection({ level: 'pending', stage: 'I', diagnostic_option: 'negocio' }, true);
        if (ok){
            alert('Tu solicitud para Incubación está pendiente. Te contactaremos por WhatsApp para coordinar la evaluación.');
            window.location.href = window.APP_BASE_URL + '/index.php/evaluation-pending';
        }
    }

    async function saveSelection(payload, returnBool){
        const token = localStorage.getItem('auth_token') || localStorage.getItem('authToken');
        if (!token) {
            window.location.href = '{{ url('index.php/login') }}';
            return false;
        }
        try{
            const response = await fetch(`${window.APP_API_BASE}/me/level`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': `Bearer ${token}` },
                body: JSON.stringify(payload)
            });
            if (!response.ok){ alert('Error al guardar tu selección. Inténtalo de nuevo.'); return false; }
            const user = await response.json();
            localStorage.setItem('user', JSON.stringify(user));
            if (!returnBool){ window.location.href = window.APP_BASE_URL + '/index.php/dashboard'; }
            return true;
        }catch(e){ console.error(e); alert('Error de conexión.'); return false; }
    }
</script>
@endpush
@endsection
