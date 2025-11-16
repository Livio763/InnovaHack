@extends('layouts.app')

@section('title', 'GIA - Misión')

@section('content')
<x-header />

<div class="max-w-2xl mx-auto p-6">
    <button onclick="window.location.href=window.APP_BASE_URL + '/index.php/modules'" class="mb-4 flex items-center gap-2 text-gray-700 font-semibold hover:text-green-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        <span>Volver</span>
    </button>
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 id="missionTitle" class="text-2xl font-extrabold text-gray-800 mb-3">Misión</h2>
        <h3 class="text-lg font-bold mb-2" style="color:#009639">¿Qué vas a aprender?</h3>
        <p id="missionDesc" class="text-gray-700"></p>
        <ul class="mt-3 text-sm text-gray-600 list-disc pl-5" id="learnList">
            <li>Finanzas básicas para tu emprendimiento</li>
            <li>Cómo aprovechar los módulos y misiones</li>
            <li>Hábitos y mentalidad emprendedora</li>
        </ul>
    </div>

    <div class="bg-gray-50 rounded-2xl p-5 mb-6 border-2 border-gray-200 text-center" id="rewardBox" style="display:none">
        <p class="font-bold text-gray-800 mb-2"> Recompensa al completar</p>
        <div class="flex items-center justify-center gap-4">
            <div class="bg-white rounded-xl px-4 py-2 shadow-md">
                <p class="text-2xl font-extrabold" style="color:#009639" id="rewardPoints">+0</p>
                <p class="text-xs text-gray-600">Puntos</p>
            </div>
        </div>
    </div>

    <!-- Paso 1: Curso de bienvenida (placeholder tipo cuaderno/video) -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">1</div>
            <h3 class="text-lg font-extrabold text-gray-800">Mira el curso de bienvenida</h3>
        </div>
        <!-- Cuaderno/Video placeholder -->
        <div id="videoPlaceholder" class="relative w-full aspect-video bg-gray-100 border-2 border-dashed border-gray-300 rounded-xl flex items-center justify-center">
            <div class="absolute inset-0 pointer-events-none" style="background: repeating-linear-gradient(0deg, rgba(0,0,0,0.02), rgba(0,0,0,0.02) 2px, transparent 2px, transparent 40px)"></div>
            <div class="w-16 h-16 rounded-full bg-white shadow flex items-center justify-center border border-gray-200">
                <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M6.5 5.5l7 4-7 4v-8z"></path></svg>
            </div>
        </div>
        <button id="markWatched" class="mt-4 w-full text-white font-bold text-lg py-3 px-6 rounded-2xl shadow-md hover:shadow-lg transition" style="background:#009639">Marcar como visto</button>
        <p class="text-xs text-gray-500 text-center mt-2">Consejo: toma notas rápidas de lo más importante </p>
    </div>

    <!-- Paso 2: Quiz de repaso (bloqueado hasta marcar video) -->
    <div class="bg-gray-100 rounded-2xl shadow-md p-6 mt-6 opacity-60 pointer-events-none" id="quizCard">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold" style="background: var(--cf-orange)">2</div>
            <h3 class="text-lg font-extrabold text-gray-500">Quiz de repaso <span class="text-sm accent-orange">(Mira el video primero)</span></h3>
        </div>
        <form id="quizForm" class="space-y-5">
            <div>
                <p class="font-semibold text-gray-800 mb-2">1) ¿Cuál es un pilar del programa?</p>
                <label class="block text-sm"><input type="radio" name="q1" value="a" class="mr-2"/>Tomar fotos profesionales</label>
                <label class="block text-sm"><input type="radio" name="q1" value="b" class="mr-2"/>Finanzas básicas</label>
                <label class="block text-sm"><input type="radio" name="q1" value="c" class="mr-2"/>Diseño gráfico avanzado</label>
            </div>
            <div>
                <p class="font-semibold text-gray-800 mb-2">2) ¿Para qué sirve este asistente?</p>
                <label class="block text-sm"><input type="radio" name="q2" value="a" class="mr-2"/>Solo para chatear sin relación al curso</label>
                <label class="block text-sm"><input type="radio" name="q2" value="b" class="mr-2"/>Capacitarte, resolver dudas y prepararte para el quiz</label>
                <label class="block text-sm"><input type="radio" name="q2" value="c" class="mr-2"/>Descargar certificados</label>
            </div>
            <div>
                <p class="font-semibold text-gray-800 mb-2">3) ¿Qué deberías hacer al finalizar el video?</p>
                <label class="block text-sm"><input type="radio" name="q3" value="a" class="mr-2"/>Cerrar la app inmediatamente</label>
                <label class="block text-sm"><input type="radio" name="q3" value="b" class="mr-2"/>Reforzar puntos clave con el asistente o prepararte para el quiz</label>
                <label class="block text-sm"><input type="radio" name="q3" value="c" class="mr-2"/>Esperar sin hacer nada</label>
            </div>
            <button type="submit" class="w-full text-white font-bold text-lg py-3 px-6 rounded-2xl shadow-md hover:shadow-lg transition btn-orange">Revisar respuestas</button>
        </form>
        <p id="quizResult" class="hidden mt-3 text-center font-semibold"></p>
        <button id="completeButton" class="w-full mt-4 text-white font-bold text-lg py-4 px-6 rounded-2xl shadow-lg transform hover:scale-105 transition-all hidden btn-orange">✅ Completar misión</button>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/auth-guard.js') }}"></script>
<script type="module">
    // Proteger esta página - requiere autenticación
    if (!window.authGuard.checkAuth()) {
        throw new Error('No autenticado');
    }

    const missionId = {!! json_encode($missionId ?? null) !!};

    async function loadMission(){
        const token = localStorage.getItem('auth_token') || localStorage.getItem('authToken');
        const res = await fetch(`${window.APP_API_BASE}/missions/${missionId}`, {
            headers: token ? { 'Authorization': 'Bearer ' + token } : {}
        });
        const mi = await res.json();
        document.getElementById('missionTitle').textContent = mi.title || 'Misión';
        document.getElementById('missionDesc').textContent = mi.description || '';
        // Si es la primera misión o título de bienvenida, adaptamos copy
        try {
            if (mi.order === 1 || (mi.title||'').toLowerCase().includes('bienvenida')) {
                document.getElementById('missionTitle').textContent = mi.title || 'Curso de bienvenida';
            }
        } catch (e) {}
        if (mi.points){
            document.getElementById('rewardBox').style.display = 'block';
            document.getElementById('rewardPoints').textContent = `+${mi.points}`;
        }
        // Se eliminó la insignia visual (solo mostramos puntos)

        // Marcar esta misión como "en progreso" para habilitar el botón Continuar del dashboard
        try {
            if (token) {
                await fetch(`${window.APP_API_BASE}/missions/${missionId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: 'in_progress' })
                });
            }
        } catch (e) { /* noop */ }
    }

    // Mostrar nudge del asistente a la izquierda del botón flotante
    function showAssistantNudge() {
        console.log('Mostrando nudge del asistente');
        let nudge = document.getElementById('giaNudge');
        if (nudge) nudge.remove();
        nudge = document.createElement('div');
        nudge.id = 'giaNudge';
        nudge.className = 'fixed z-50 bg-white border border-green-200 shadow-xl rounded-xl p-3 max-w-xs';
        nudge.style.right = '110px';
        nudge.style.bottom = '110px';
        
        const texto = document.createElement('p');
        texto.className = 'text-sm text-gray-800 mb-2';
        texto.textContent = '¿Quieres reforzar lo aprendido o prepararte conmigo para el quiz?';
        
        const botones = document.createElement('div');
        botones.className = 'flex gap-2';
        
        const btnReforzar = document.createElement('button');
        btnReforzar.id = 'nudgeReforzar';
        btnReforzar.className = 'text-xs px-3 py-1 rounded-full border border-green-600 text-green-700 hover:bg-green-50';
        btnReforzar.textContent = 'Reforzar';
        
        const btnQuiz = document.createElement('button');
        btnQuiz.id = 'nudgeQuiz';
        btnQuiz.className = 'text-xs px-3 py-1 rounded-full text-white';
        btnQuiz.style.background = '#009639';
        btnQuiz.textContent = 'Prepararme';
        
        botones.appendChild(btnReforzar);
        botones.appendChild(btnQuiz);
        nudge.appendChild(texto);
        nudge.appendChild(botones);
        document.body.appendChild(nudge);

        // Acciones
        btnReforzar.addEventListener('click', () => {
            if (window.giaQuickQuestion) window.giaQuickQuestion('Ayúdame a reforzar los puntos clave del curso de bienvenida.');
            nudge.remove();
        });
        btnQuiz.addEventListener('click', () => {
            if (window.giaQuickQuestion) window.giaQuickQuestion('Prepárame con ejemplos para el quiz de la misión de bienvenida.');
            const quiz = document.getElementById('quizCard');
            if (quiz && quiz.scrollIntoView) quiz.scrollIntoView({ behavior: 'smooth' });
            nudge.remove();
        });
    }

    // Simula fin de video
    function handleMarkWatched() {
        console.log('Botón Marcar como visto clickeado');
        showAssistantNudge();
        const btn = document.getElementById('markWatched');
        btn.textContent = '¡Visto! ';
        btn.disabled = true;
        btn.classList.add('opacity-80');
        
        // Habilitar quiz
        const quizCard = document.getElementById('quizCard');
        quizCard.classList.remove('bg-gray-100', 'opacity-60', 'pointer-events-none');
        quizCard.classList.add('bg-white');
        const badge = quizCard.querySelector('.bg-gray-400');
        if (badge) {
            badge.classList.remove('bg-gray-400');
            badge.classList.add('bg-green-500');
        }
        const title = quizCard.querySelector('h3');
        if (title) {
            title.classList.remove('text-gray-500');
            title.classList.add('text-gray-800');
            title.innerHTML = 'Quiz de repaso';
        }
        console.log('Quiz habilitado');
    }

    // Quiz
    function handleQuizSubmit(e) {
        e.preventDefault();
        console.log('Quiz enviado');
        const answers = {
            q1: 'b',
            q2: 'b',
            q3: 'b',
        };
        let score = 0;
        Object.keys(answers).forEach(k => {
            const checked = document.querySelector(`input[name="${k}"]:checked`);
            if (checked && checked.value === answers[k]) score++;
        });
        const result = document.getElementById('quizResult');
        result.classList.remove('hidden');
        if (score >= 2) {
            result.textContent = `¡Bien! Aprobaste con ${score}/3. Ya puedes completar la misión.`;
            result.className = 'mt-3 text-center font-semibold text-green-700';
            document.getElementById('completeButton').classList.remove('hidden');
        } else {
            result.textContent = `Obtuviste ${score}/3. ¿Quieres reforzarlo conmigo?`;
            result.className = 'mt-3 text-center font-semibold text-orange-700';
        }
    }

    async function completeMission(){
        const token = localStorage.getItem('auth_token') || localStorage.getItem('authToken');
        try{
            const resp = await fetch(`${window.APP_API_BASE}/missions/${missionId}/complete`, {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token }
            });
            if (!resp.ok) throw new Error('API error');
            window.location.href = window.APP_BASE_URL + '/index.php/dashboard';
        }catch(e){
            // Fallback local
            const completed = JSON.parse(localStorage.getItem('missionsCompleted') || '[]');
            if (!completed.includes('mission'+missionId)) completed.push('mission'+missionId);
            localStorage.setItem('missionsCompleted', JSON.stringify(completed));
            const current = parseInt(localStorage.getItem('totalPoints') || '0');
            localStorage.setItem('totalPoints', String(current + 100));
            window.location.href = window.APP_BASE_URL + '/index.php/dashboard';
        }
    }

    // Esperar a que el DOM esté listo e inicializar
    function initializeMission() {
        console.log('Inicializando misión');
        const markBtn = document.getElementById('markWatched');
        const quizForm = document.getElementById('quizForm');
        const completeBtn = document.getElementById('completeButton');
        
        console.log('Botón marcar:', markBtn);
        console.log('Form quiz:', quizForm);
        console.log('Botón completar:', completeBtn);
        
        if (markBtn) {
            markBtn.addEventListener('click', handleMarkWatched);
            console.log('Listener de markWatched registrado');
        } else {
            console.error('No se encontró el botón markWatched');
        }
        if (quizForm) {
            quizForm.addEventListener('submit', handleQuizSubmit);
            console.log('Listener de quiz registrado');
        } else {
            console.error('No se encontró el form del quiz');
        }
        if (completeBtn) {
            completeBtn.addEventListener('click', completeMission);
            console.log('Listener de completar registrado');
        } else {
            console.error('No se encontró el botón de completar');
        }
        
        loadMission();
    }

    // Ejecutar cuando el script se cargue (los elementos ya están en el DOM)
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeMission);
    } else {
        initializeMission();
    }
</script>
@endpush
@endsection
