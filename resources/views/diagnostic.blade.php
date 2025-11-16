@extends('layouts.app')

@section('title', 'GIA - Diagnóstico Inicial')

@section('content')
<x-header />

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Progreso -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-bold text-gray-600">Diagnóstico Inicial</span>
            <span class="text-sm font-bold" style="color: var(--cf-green)">Paso 1 de 3</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="h-2 rounded-full" style="width: 33%; background: var(--cf-green)"></div>
        </div>
    </div>

    <!-- Título -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
        <h2 class="text-2xl font-extrabold text-gray-800 mb-2">¿Cuál es tu situación actual?</h2>
        <p class="text-gray-600 text-sm">Selecciona la opción que mejor describa tu situación. Esto nos ayudará a personalizar tu experiencia.</p>
    </div>

    <!-- Opciones de diagnóstico -->
    <div class="space-y-3">
        @php
        $options = [
            ['id' => 1, 'title' => 'TENGO UN EMPRENDIMIENTO', 'desc' => 'Ya inicié mi negocio y quiero hacerlo crecer'],
            ['id' => 2, 'title' => 'NO TENGO MUCHO DINERO', 'desc' => 'Necesito opciones de bajo costo para empezar'],
            ['id' => 3, 'title' => 'QUIERO PONERLO EN MARCHA', 'desc' => 'Tengo una idea y quiero validarla'],
            ['id' => 4, 'title' => 'NO SE MARKETING', 'desc' => 'Necesito aprender a promocionar mi negocio'],
            ['id' => 5, 'title' => 'NO TENGO TIEMPO PARA VER VIDEOS LARGOS', 'desc' => 'Prefiero contenido rápido y práctico'],
            ['id' => 6, 'title' => 'NO TENGO TIEMPO DE IR A TODOS LOS DÍAS', 'desc' => 'Necesito flexibilidad de horarios'],
            ['id' => 7, 'title' => 'SOLO TENGO 1 HORA DIARIA PARA APRENDER', 'desc' => 'Busco contenido optimizado para mi tiempo'],
            ['id' => 8, 'title' => 'NECESITO UNA SOLUCIÓN DIGITAL FÁCIL', 'desc' => 'Quiero aprender desde mi celular'],
            ['id' => 9, 'title' => 'BUSCO UNA PÁGINA GRATUITA DE APRENDIZAJE', 'desc' => 'No puedo pagar cursos costosos'],
            ['id' => 10, 'title' => 'ENCUENTRO CHILDFUND', 'desc' => 'Quiero conocer más sobre el programa']
        ];
        @endphp

        @foreach($options as $option)
        <button onclick="selectOption({{ $option['id'] }})" class="diagnostic-option w-full bg-white border-2 border-gray-200 rounded-xl p-4 text-left hover:border-green-600 transition-all duration-200 flex items-start gap-3">
            <div class="flex-shrink-0 w-6 h-6 rounded-full border-2 border-gray-300 mt-0.5"></div>
            <div>
                <p class="font-bold text-gray-800">{{ $option['title'] }}</p>
                <p class="text-sm text-gray-600">{{ $option['desc'] }}</p>
            </div>
        </button>
        @endforeach
    </div>

    <!-- Botón continuar -->
    <div id="continueBtn" class="hidden mt-6">
        <button onclick="continueToRegister()" class="w-full bg-white border-2 rounded-full py-4 px-6 font-bold text-lg shadow-lg hover:scale-105 transition-all duration-200" style="background: var(--cf-green); color: white;">
            Continuar →
        </button>
    </div>
</div>

@push('scripts')
<script>
    let selectedOption = null;

    function selectOption(optionNumber) {
        selectedOption = optionNumber;
        
        // Remover selección previa
        document.querySelectorAll('.diagnostic-option').forEach(btn => {
            btn.classList.remove('border-green-600');
            btn.style.background = 'white';
            const circle = btn.querySelector('div');
            circle.style.background = 'white';
            circle.style.borderColor = '#d1d5db';
        });

        // Marcar opción seleccionada
        const selectedBtn = event.currentTarget;
        selectedBtn.classList.add('border-green-600');
        selectedBtn.style.background = '#f0fdf4';
        const circle = selectedBtn.querySelector('div');
        circle.style.background = '#009639';
        circle.style.borderColor = '#009639';

        // Mostrar botón continuar
        document.getElementById('continueBtn').classList.remove('hidden');
    }

    function continueToRegister() {
        if (selectedOption) {
            localStorage.setItem('diagnosticOption', selectedOption);
            localStorage.setItem('diagnosticCompleted', 'true');
            
            const isLoggedIn = localStorage.getItem('isLoggedIn');
            if (isLoggedIn === 'true') {
                window.location.href = '{{ route("classification") }}';
            } else {
                window.location.href = '{{ route("register") }}';
            }
        }
    }
</script>
@endpush
@endsection
