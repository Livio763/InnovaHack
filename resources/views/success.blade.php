@extends('layouts.app')

@section('title', '¡Éxito! - GIA')

@section('content')
<x-header />

<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 text-center">
            <div class="mb-6">
                <div class="inline-block p-4 rounded-full bg-green-100 mb-4">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--cf-green)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <h2 class="text-4xl font-extrabold mb-4" style="color: var(--cf-green)">¡Felicitaciones!</h2>
            <p class="text-xl text-gray-700 mb-6" id="successMessage">Has completado exitosamente esta etapa</p>

            <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-lg p-6 mb-6">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--cf-green)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    <div class="text-left">
                        <p class="text-2xl font-extrabold" style="color: var(--cf-green)" id="pointsEarned">+50 Puntos</p>
                        <p class="text-sm text-gray-600">Has ganado una nueva insignia</p>
                    </div>
                </div>
            </div>

            <div class="space-y-3 mb-6 text-left">
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-gray-700">Progreso guardado</span>
                </div>
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-gray-700">Insignia desbloqueada</span>
                </div>
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-gray-700">Nivel actualizado</span>
                </div>
            </div>

            <div class="flex gap-3 justify-center">
                <a href="{{ route('dashboard') }}" class="bg-white text-gray-800 font-bold py-3 px-6 rounded-full border-2 border-gray-300 hover:border-green-600 transition-all duration-200">
                    Ver Dashboard
                </a>
                <button onclick="continueToModules()" class="text-white font-bold py-3 px-6 rounded-full shadow-lg transform hover:scale-105 transition-all duration-200" style="background: var(--cf-green);">
                    Continuar
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function continueToModules() {
        window.location.href = '{{ route("modules") }}';
    }

    // Personalizar mensaje según contexto
    const urlParams = new URLSearchParams(window.location.search);
    const context = urlParams.get('context') || 'default';
    const messages = {
        mission: '¡Has completado la misión con éxito!',
        module: '¡Has finalizado el módulo!',
        diagnostic: '¡Diagnóstico completado!',
        default: 'Has completado exitosamente esta etapa'
    };
    document.getElementById('successMessage').textContent = messages[context] || messages.default;
</script>
@endpush
@endsection
