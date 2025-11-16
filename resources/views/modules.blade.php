@extends('layouts.app')

@section('title', 'GIA - Mis Módulos')

@section('content')
<x-header />

<div class="max-w-4xl mx-auto p-6">
    <!-- Botón de vuelta a Dashboard -->
    <button onclick="window.location.href=window.APP_BASE_URL + '/index.php/dashboard'" class="mb-4 flex items-center gap-2 text-gray-700 font-semibold hover:text-green-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        <span>Volver al inicio</span>
    </button>

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-lg font-extrabold text-gray-800">Progreso General</h2>
            <span class="text-sm font-bold" style="color: var(--cf-green)" id="overallProgress">0%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div id="progressBar" class="h-3 rounded-full transition-all duration-300" style="width: 0%; background: var(--cf-green)"></div>
        </div>
    </div>

    <div id="modulesContainer" class="space-y-6">
        <!-- Contenido generado por JS desde /api/missions -->
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/auth-guard.js') }}"></script>
<script type="module">
    // Proteger esta página - requiere autenticación
    if (!window.authGuard.checkAuth()) {
        throw new Error('No autenticado');
    }

    import { api } from '{{ asset('js/api.js') }}';

    async function loadModules(){
        try{
            const token = localStorage.getItem('auth_token') || localStorage.getItem('authToken');
            const res = await fetch(`${window.APP_API_BASE}/missions`, {
                headers: token ? { 'Authorization': 'Bearer ' + token } : {}
            });
            const modules = await res.json();
            const container = document.getElementById('modulesContainer');
            container.innerHTML = '';

            let totalMissions = 0, done = 0;

            modules.forEach(m => {
                const missions = (m.missions || []);
                const completedCount = missions.filter(mi => (mi.progress||[]).some(p => p.status === 'completed')).length;
                totalMissions += (m.missions||[]).length;
                done += completedCount;

                const mod = document.createElement('div');
                mod.className = 'bg-white rounded-2xl shadow-md border-2 border-gray-200 overflow-hidden';
                const missionUrlBase = `${window.APP_BASE_URL}/index.php/mission`;
                // Regla de bloqueo: hasta que la PRIMERA misión esté completada, las demás quedan bloqueadas
                const firstCompleted = missions.length > 0 ? ((missions[0].progress||[]).some(p => p.status==='completed')) : false;

                const missionsHtml = missions.map((mi, idx) => {
                    const isCompleted = (mi.progress||[]).some(p => p.status==='completed');
                    // Bloqueo secuencial: sólo se desbloquea si la misión anterior está COMPLETADA
                    const prevCompleted = idx === 0 ? true : ((missions[idx-1].progress||[]).some(p => p.status==='completed'));
                    const locked = !prevCompleted;
                    const statusHtml = locked
                        ? '<span class="text-xs px-2 py-1 rounded-full font-bold bg-gray-200 text-gray-600">Bloqueada</span>'
                        : `<span class="text-xs px-2 py-1 rounded-full font-bold ${isCompleted ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600'}">${isCompleted ? 'Completada' : 'Por hacer'}</span>`;
                    const iconHtml = locked
                        ? '<svg class="w-5 h-5 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7a4 4 0 10-8 0v4m0 0h12m-6 0v6a2 2 0 104 0v-6"></path></svg>'
                        : '<svg class="w-5 h-5 flex-shrink-0" style="color: var(--cf-green)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                    const baseClasses = 'flex items-center gap-3 p-3 rounded-lg transition';
                    const classes = locked ? `${baseClasses} bg-gray-100 cursor-not-allowed opacity-60` : `${baseClasses} bg-gray-50 hover:bg-gray-100 cursor-pointer`;
                    const content = `
                        <div class="${classes}">
                            ${iconHtml}
                            <p class="text-sm font-bold text-gray-700 flex-1">${mi.title}</p>
                            ${statusHtml}
                        </div>
                    `;
                    if (locked) return content;
                    return `<a href="${missionUrlBase}/${mi.id}">${content}</a>`;
                }).join('');

                mod.innerHTML = `
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0" style="background: #e8f5e9">
                                    <svg class="w-8 h-8" style="color: var(--cf-green)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-extrabold text-gray-800 mb-1">${m.name}</h3>
                                    <p class="text-sm text-gray-600 mb-2">${m.description || ''}</p>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="text-xs font-bold px-3 py-1 rounded-full" style="background: #e8f5e9; color: var(--cf-green)">${completedCount}/${(m.missions||[]).length} misiones</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">${missionsHtml}</div>
                    </div>
                `;
                container.appendChild(mod);
            });

            const pct = totalMissions ? Math.round((done/totalMissions)*100) : 0;
            document.getElementById('overallProgress').textContent = pct + '%';
            document.getElementById('progressBar').style.width = pct + '%';
        }catch(e){
            console.error(e);
        }
    }

    loadModules();
</script>
@endpush
@endsection
