@extends('layouts.app')

@section('title', 'Evaluación en Proceso - GIA')

@section('content')
<x-header />

<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 text-center">
            <div class="mb-6">
                <div class="inline-block p-4 rounded-full bg-green-100 mb-4">
                    <svg class="w-16 h-16 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--cf-green)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-extrabold mb-4" style="color: var(--cf-green)">Estamos Creando Tu Ruta</h2>
            <p class="text-lg text-gray-700 mb-6">Analizando tus respuestas para personalizar tu experiencia...</p>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-center gap-2 mb-3">
                    <div class="w-3 h-3 rounded-full animate-bounce" style="background: var(--cf-green); animation-delay: 0ms"></div>
                    <div class="w-3 h-3 rounded-full animate-bounce" style="background: var(--cf-green); animation-delay: 150ms"></div>
                    <div class="w-3 h-3 rounded-full animate-bounce" style="background: var(--cf-green); animation-delay: 300ms"></div>
                </div>
                <p class="text-sm text-gray-600">Esto tomará solo unos segundos</p>
            </div>

            <div class="text-left space-y-2 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Evaluando tu perfil emprendedor</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Seleccionando misiones personalizadas</span>
                </div>
                <div class="flex items-center gap-2 opacity-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Preparando tu dashboard</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    setTimeout(() => {
        window.location.href = '{{ route("route") }}';
    }, 3000);
</script>
@endpush
@endsection
