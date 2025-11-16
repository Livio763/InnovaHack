@extends('layouts.app')

@section('title', 'Tu Ruta Personalizada - GIA')

@section('content')
<x-header />

<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
            <div class="text-center mb-8">
                <div class="inline-block p-4 rounded-full bg-green-100 mb-4">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--cf-green)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold mb-2" style="color: var(--cf-green)">¡Tu Ruta Está Lista!</h2>
                <p class="text-lg text-gray-700">Tu nivel: <strong id="userLevel" class="font-extrabold" style="color: var(--cf-green)">Emprendedor</strong></p>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Tu Plan Personalizado</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0" style="background: var(--cf-green)">
                            <span class="text-white font-bold text-lg">1</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Diagnóstico Emprendedor</h4>
                            <p class="text-sm text-gray-600">Identifica tus fortalezas y áreas de mejora</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0 bg-gray-300">
                            <span class="text-white font-bold text-lg">2</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Módulos de Aprendizaje</h4>
                            <p class="text-sm text-gray-600">Videos y contenido adaptado a tu nivel</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0 bg-gray-300">
                            <span class="text-white font-bold text-lg">3</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Misiones Prácticas</h4>
                            <p class="text-sm text-gray-600">Aplica lo aprendido con retos reales</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0 bg-gray-300">
                            <span class="text-white font-bold text-lg">4</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Insignias y Reconocimientos</h4>
                            <p class="text-sm text-gray-600">Gana puntos y desbloquea logros</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 rounded-lg p-4 mb-6 border border-green-200">
                <p class="text-sm text-gray-700 mb-2"><strong>Consejo GIA:</strong></p>
                <p class="text-sm text-gray-600">Completa al menos una misión por día para mantener tu progreso constante y alcanzar tus objetivos más rápido.</p>
            </div>

            <div class="text-center">
                <button onclick="startJourney()" class="text-white font-bold text-lg py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition-all duration-200" style="background: var(--cf-green);">
                    Comenzar Mi Viaje
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const level = localStorage.getItem('userLevel') || 'Emprendedor';
    document.getElementById('userLevel').textContent = level;

    function startJourney() {
        window.location.href = '{{ route("diagnostic") }}';
    }
</script>
@endpush
@endsection
