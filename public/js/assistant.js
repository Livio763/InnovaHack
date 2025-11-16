/**
 * GIA Assistant - Cliente JavaScript
 * Maneja interacciones del chat, contexto y comunicación con API
 */

(function() {
    let currentContext = 'general';
    let isOpen = false;

    // Detectar contexto actual según URL
    function detectContext() {
        const path = window.location.pathname;
        if (path.includes('/dashboard')) return 'dashboard';
        if (path.includes('/modules')) return 'modules';
        if (path.includes('/mission/')) {
            const missionId = path.split('/mission/')[1];
            return `mission:${missionId}`;
        }
        if (path.includes('/classification')) return 'classification';
        return 'general';
    }

    // Agregar mensaje al chat
    function addMessage(text, isUser = false) {
        const messagesContainer = document.getElementById('giaChatMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex ${isUser ? 'justify-end' : 'justify-start'}`;
        
        const bubble = document.createElement('div');
        bubble.className = `max-w-xs px-4 py-2 rounded-2xl ${
            isUser 
                ? 'bg-green-600 text-white' 
                : 'bg-white border border-gray-200 text-gray-800'
        }`;
        bubble.innerHTML = `<p class="text-sm">${text}</p>`;
        
        messageDiv.appendChild(bubble);
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Mostrar indicador de escritura
    function showTyping() {
        const messagesContainer = document.getElementById('giaChatMessages');
        const typingDiv = document.createElement('div');
        typingDiv.id = 'giaTyping';
        typingDiv.className = 'flex justify-start';
        typingDiv.innerHTML = `
            <div class="bg-white border border-gray-200 px-4 py-2 rounded-2xl">
                <div class="flex gap-1">
                    <div class="w-2 h-2 bg-green-600 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                    <div class="w-2 h-2 bg-green-600 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                    <div class="w-2 h-2 bg-green-600 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                </div>
            </div>
        `;
        messagesContainer.appendChild(typingDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function hideTyping() {
        const typing = document.getElementById('giaTyping');
        if (typing) typing.remove();
    }

    // Enviar mensaje a la API
    async function sendMessage(message) {
        const token = localStorage.getItem('auth_token') || localStorage.getItem('authToken');
        if (!token) {
            addMessage('⚠️ Debes iniciar sesión para usar el asistente.');
            return;
        }

        addMessage(message, true);
        showTyping();

        try {
            const response = await fetch(`${window.APP_API_BASE}/assistant/chat`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: message,
                    context: currentContext
                })
            });

            hideTyping();

            if (response.ok) {
                const data = await response.json();
                addMessage(data.response);
            } else {
                addMessage('⚠️ Hubo un error. Intenta de nuevo.');
            }
        } catch (error) {
            hideTyping();
            console.error('Error en chat:', error);
            addMessage('⚠️ Error de conexión. Verifica tu internet.');
        }
    }

    // Cargar saludo inicial
    async function loadGreeting() {
        const token = localStorage.getItem('auth_token') || localStorage.getItem('authToken');
        if (!token) return;

        try {
            const response = await fetch(`${window.APP_API_BASE}/assistant/greeting?context=${currentContext}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();
                addMessage(data.greeting);
                addMessage('¿En qué puedo ayudarte hoy? 😊');
            }
        } catch (error) {
            console.error('Error al cargar saludo:', error);
            addMessage('¡Hola! Soy GIA, tu asistente emprendedor. ¿En qué puedo ayudarte? 😊');
        }
    }

    // Toggle panel
    function togglePanel() {
        const panel = document.getElementById('giaPanel');
        const icon = document.getElementById('giaIcon');
        const closeIcon = document.getElementById('giaCloseIcon');
        
        isOpen = !isOpen;
        
        if (isOpen) {
            panel.classList.remove('hidden');
            icon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            
            // Cargar saludo si es la primera vez
            const messagesContainer = document.getElementById('giaChatMessages');
            if (messagesContainer.children.length === 0) {
                loadGreeting();
            }
        } else {
            panel.classList.add('hidden');
            icon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    }

    // Pregunta rápida
    window.giaQuickQuestion = function(question) {
        sendMessage(question);
    };

    // Inicialización
    document.addEventListener('DOMContentLoaded', function() {
        currentContext = detectContext();

        // Toggle del chat
        const toggleBtn = document.getElementById('giaToggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', togglePanel);
        }

        // Enviar mensaje con botón
        const sendBtn = document.getElementById('giaSend');
        const input = document.getElementById('giaInput');
        
        if (sendBtn && input) {
            sendBtn.addEventListener('click', () => {
                const message = input.value.trim();
                if (message) {
                    sendMessage(message);
                    input.value = '';
                }
            });

            // Enviar con Enter
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    const message = input.value.trim();
                    if (message) {
                        sendMessage(message);
                        input.value = '';
                    }
                }
            });
        }
    });
})();
