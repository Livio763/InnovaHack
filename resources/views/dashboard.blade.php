@extends('layouts.app')

@section('title', 'GIA - Mi Dashboard')

@section('content')
<x-header />

<!-- Hero Section con stats principales -->
<div class="text-white py-8 px-6" style="background: linear-gradient(135deg, #009639 0%, #007a2e 100%)">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-extrabold mb-2">¡Hola, <span id="userName">Emprendedor</span>!</h1>
        <p class="text-green-100 text-sm mb-6">Sigue avanzando en tu ruta de aprendizaje</p>
        
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4 text-center border border-white border-opacity-30">
                <div class="text-4xl font-extrabold" id="totalPoints">0</div>
                <div class="text-xs opacity-90 mt-1">Puntos</div>
            </div>
            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4 text-center border border-white border-opacity-30">
                <div class="text-4xl font-extrabold" id="completedMissions">0</div>
                <div class="text-xs opacity-90 mt-1">Misiones</div>
            </div>
            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4 text-center border border-white border-opacity-30">
                <div class="text-4xl font-extrabold" id="totalBadges">0</div>
                <div class="text-xs opacity-90 mt-1">Insignias</div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto p-6 space-y-6">
    <!-- Card de progreso general -->
    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-extrabold text-gray-800">📊 Tu Progreso General</h2>
            <span class="text-2xl font-extrabold" style="color: #009639" id="progressPercent">0%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
            <div id="progressBar" class="h-4 rounded-full transition-all duration-500" style="width: 0%; background: linear-gradient(90deg, #009639 0%, #00c853 100%)"></div>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full text-sm font-bold" style="background: #e8f5e9; color: #009639" id="userLevel">Pre-incubación 🌱</span>
        </div>
    </div>

    <!-- Card de última actividad -->
    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100" id="lastActivityCard" style="display: none;">
        <h2 class="text-xl font-extrabold text-gray-800 mb-4">🎯 Continúa donde lo dejaste</h2>
        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background: #e8f5e9">
                <svg class="w-6 h-6" style="color: #009639" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-800 mb-1" id="lastModuleName">Cargando...</h3>
                <p class="text-sm text-gray-600" id="lastMissionTitle">Cargando...</p>
            </div>
            <button onclick="resumeLastMission()" class="px-4 py-2 rounded-xl font-bold text-white shadow-md hover:shadow-lg transition-all" style="background: #009639">
                Reanudar →
            </button>
        </div>
    </div>

    <!-- CTA Principal para ir a módulos -->
    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 text-center border-2 border-green-200 shadow-lg">
        <div class="w-20 h-20 mx-auto mb-4 rounded-full flex items-center justify-center" style="background: #009639">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <h2 class="text-2xl font-extrabold text-gray-800 mb-2">¿Listo para aprender?</h2>
        <p class="text-gray-600 mb-6">Accede a todos tus módulos y misiones</p>
        <button onclick="window.location.href=window.APP_BASE_URL + '/index.php/modules'" class="px-8 py-4 rounded-full font-extrabold text-lg text-white shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-200" style="background: #009639">
            Ir a Mis Módulos →
        </button>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/auth-guard.js') }}"></script>
<script type="module">
    if (!window.authGuard.checkAuth()) {
        throw new Error('No autenticado');
    }

    let lastMissionId = null;

    async function loadDashboard(){
        const token = localStorage.getItem('auth_token') || localStorage.getItem('authToken');
        const user = window.authGuard.getUserData();
        
        // Nombre del usuario - solo primer nombre
        if (user && user.name) {
            const firstName = user.name.split(' ')[0];
            document.getElementById('userName').textContent = firstName;
        }

        // Nivel del usuario
        if (user && user.level) {
            const levelMap = {
                'pre': 'Pre-incubación 🌱',
                'incubadora': 'Incubadora 🚀',
                'pending': 'En evaluación ⏳'
            };
            document.getElementById('userLevel').textContent = levelMap[user.level] || 'Emprendedor';
        }

        // Stats desde API
        if (token){
            try{
                const stats = await fetch(`${window.APP_API_BASE}/me/stats`, { 
                    headers: { Authorization: 'Bearer ' + token }
                }).then(r=>r.json());
                
                document.getElementById('totalPoints').textContent = stats.total_points ?? 0;
                document.getElementById('totalBadges').textContent = stats.total_badges ?? 0;
                document.getElementById('completedMissions').textContent = stats.missions_completed ?? 0;

                // Progreso general
                const res = await fetch(`${window.APP_API_BASE}/missions`, {
                    headers: { 'Authorization': 'Bearer ' + token }
                });
                const modules = await res.json();
                
                let totalMissions = 0, done = 0;
                let lastInProgress = null;

                modules.forEach(m => {
                    (m.missions || []).forEach(mi => {
                        totalMissions++;
                        const prog = (mi.progress||[]);
                        if (prog.some(p => p.status === 'completed')) done++;
                        else if (prog.some(p => p.status === 'in_progress') && !lastInProgress) {
                            lastInProgress = { module: m, mission: mi };
                        }
                    });
                });

                const pct = totalMissions ? Math.round((done/totalMissions)*100) : 0;
                document.getElementById('progressPercent').textContent = pct + '%';
                document.getElementById('progressBar').style.width = pct + '%';

                // Última actividad
                if (lastInProgress) {
                    document.getElementById('lastActivityCard').style.display = 'block';
                    document.getElementById('lastModuleName').textContent = lastInProgress.module.name;
                    document.getElementById('lastMissionTitle').textContent = lastInProgress.mission.title;
                    lastMissionId = lastInProgress.mission.id;
                }
            }catch(e){ console.error(e); }
        }
    }

    window.resumeLastMission = function(){
        if (lastMissionId) {
            window.location.href = window.APP_BASE_URL + '/index.php/mission/' + lastMissionId;
        } else {
            window.location.href = window.APP_BASE_URL + '/index.php/modules';
        }
    };

    loadDashboard();
</script>
@endpush
@endsection
