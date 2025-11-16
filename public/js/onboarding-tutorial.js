/**
 * Sistema de Tutorial Interactivo con Mascota
 * Guía a los nuevos usuarios por las características principales del dashboard
 */

class OnboardingTutorial {
    constructor() {
        this.currentStep = 0;
        this.steps = [
            {
                target: null, // Centrado en la pantalla
                title: '¡Bienvenido a GIA! 🎉',
                message: 'Hola, soy tu guía virtual de ChildFund. Te mostraré cómo funciona tu plataforma de aprendizaje. ¡Vamos a comenzar!',
                mascotPosition: { x: '50%', y: '45%' },
                mascotPose: 'wave'
            },
            {
                target: '#userName',
                title: 'Tu Perfil',
                message: 'Aquí puedes ver tu nombre y tu nivel actual. A medida que completes misiones, ¡irás avanzando de nivel!',
                mascotPosition: { x: '30%', y: '15%' },
                mascotPose: 'explain',
                highlightParent: '.text-white.py-8' // Hero section completo
            },
            {
                target: '#progressBar',
                title: 'Tu Progreso',
                message: 'Esta barra muestra cuánto has avanzado en tu ruta de aprendizaje. ¡Cada misión completada la llena un poco más!',
                mascotPosition: { x: '70%', y: '35%' },
                mascotPose: 'confident',
                highlightParent: '.bg-white.rounded-2xl.p-6.shadow-lg'
            },
            {
                target: '#progressBar',
                title: 'Explora tus Misiones',
                message: 'Cuando tengas misiones en progreso, verás un botón para continuar donde lo dejaste. ¡Comienza tu primera misión ahora!',
                mascotPosition: { x: '25%', y: '60%' },
                mascotPose: 'explain',
                highlightParent: null
            },
            {
                target: null,
                title: '¡Todo listo! 🚀',
                message: '¡Ya conoces lo básico! Explora las misiones, gana insignias y desarrolla tu emprendimiento. ¡Mucho éxito!',
                mascotPosition: { x: '50%', y: '50%' },
                mascotPose: 'confident'
            }
        ];
        
        this.overlay = null;
        this.tooltipContainer = null;
        this.mascot = null;
    }

    /**
     * Inicia el tutorial si es la primera vez del usuario
     */
    start() {
        // Verificar si ya completó el tutorial
        if (localStorage.getItem('onboarding_completed') === 'true') {
            return;
        }

        // Esperar a que el DOM esté completamente cargado
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.createTutorialElements());
        } else {
            this.createTutorialElements();
        }
    }

    /**
     * Crea los elementos HTML del tutorial
     */
    createTutorialElements() {
        // Crear overlay oscuro
        this.overlay = document.createElement('div');
        this.overlay.id = 'tutorial-overlay';
        this.overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9998;
            transition: opacity 0.3s ease;
        `;

        // Crear mascota
        this.mascot = document.createElement('img');
        this.mascot.id = 'tutorial-mascot';
        this.mascot.src = window.APP_BASE_URL + '/assets/images/mascot-childfund.png';
        this.mascot.alt = 'Guía ChildFund';
        this.mascot.style.cssText = `
            position: fixed;
            width: 120px;
            height: 120px;
            z-index: 10000;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 4px 12px rgba(0, 150, 57, 0.4));
            pointer-events: none;
        `;

        // Crear tooltip
        this.tooltipContainer = document.createElement('div');
        this.tooltipContainer.id = 'tutorial-tooltip';
        this.tooltipContainer.style.cssText = `
            position: fixed;
            max-width: 380px;
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        `;

        // Agregar al DOM
        document.body.appendChild(this.overlay);
        document.body.appendChild(this.mascot);
        document.body.appendChild(this.tooltipContainer);

        // Prevenir scroll durante el tutorial
        document.body.style.overflow = 'hidden';

        // Mostrar primer paso
        this.showStep(0);
    }

    /**
     * Muestra un paso específico del tutorial
     */
    showStep(stepIndex) {
        this.currentStep = stepIndex;
        const step = this.steps[stepIndex];

        // Remover highlight anterior
        const prevHighlight = document.querySelector('.tutorial-highlight');
        if (prevHighlight) {
            prevHighlight.classList.remove('tutorial-highlight');
            prevHighlight.style.position = '';
            prevHighlight.style.zIndex = '';
            prevHighlight.style.boxShadow = '';
            prevHighlight.style.borderRadius = '';
        }

        // Posicionar mascota
        this.mascot.style.left = step.mascotPosition.x;
        this.mascot.style.top = step.mascotPosition.y;
        this.mascot.style.transform = 'translate(-50%, -50%)';

        // Crear contenido del tooltip
        const isLastStep = stepIndex === this.steps.length - 1;
        this.tooltipContainer.innerHTML = `
            <div style="margin-bottom: 16px;">
                <h3 style="font-size: 20px; font-weight: 800; color: #1f2937; margin-bottom: 8px;">
                    ${step.title}
                </h3>
                <p style="font-size: 15px; color: #4b5563; line-height: 1.6;">
                    ${step.message}
                </p>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="font-size: 13px; color: #9ca3af; font-weight: 600;">
                    Paso ${stepIndex + 1} de ${this.steps.length}
                </div>
                <div style="display: flex; gap: 8px;">
                    ${!isLastStep ? `
                        <button onclick="window.tutorialInstance.skip()" 
                                style="padding: 10px 18px; background: #f3f4f6; color: #6b7280; 
                                       border: none; border-radius: 8px; font-weight: 700; 
                                       cursor: pointer; font-size: 14px; transition: all 0.2s;">
                            Saltar
                        </button>
                    ` : ''}
                    <button onclick="window.tutorialInstance.${isLastStep ? 'finish' : 'next'}()" 
                            style="padding: 10px 24px; background: linear-gradient(135deg, #009639 0%, #007a2e 100%); 
                                   color: white; border: none; border-radius: 8px; font-weight: 700; 
                                   cursor: pointer; font-size: 14px; transition: all 0.2s;
                                   box-shadow: 0 2px 8px rgba(0, 150, 57, 0.3);">
                        ${isLastStep ? '¡Empezar! 🚀' : 'Siguiente →'}
                    </button>
                </div>
            </div>
        `;

        // Posicionar tooltip
        if (step.target) {
            const targetElement = document.querySelector(step.target);
            
            if (targetElement) {
                // Highlight del elemento (o su contenedor padre si se especifica)
                const highlightElement = step.highlightParent 
                    ? targetElement.closest(step.highlightParent) || targetElement
                    : targetElement;
                
                highlightElement.classList.add('tutorial-highlight');
                highlightElement.style.position = 'relative';
                highlightElement.style.zIndex = '9999';
                highlightElement.style.boxShadow = '0 0 0 4px rgba(0, 150, 57, 0.5), 0 0 40px rgba(0, 150, 57, 0.3)';
                highlightElement.style.borderRadius = '12px';

                // Scroll al elemento
                highlightElement.scrollIntoView({ behavior: 'smooth', block: 'center' });

                // Posicionar tooltip cerca del elemento
                setTimeout(() => {
                    const rect = highlightElement.getBoundingClientRect();
                    const tooltipWidth = 380;
                    const spacing = 20;

                    let left, top;

                    // Intentar colocar a la derecha
                    if (rect.right + spacing + tooltipWidth < window.innerWidth) {
                        left = rect.right + spacing;
                        top = rect.top + (rect.height / 2);
                    }
                    // Si no cabe, intentar a la izquierda
                    else if (rect.left - spacing - tooltipWidth > 0) {
                        left = rect.left - spacing - tooltipWidth;
                        top = rect.top + (rect.height / 2);
                    }
                    // Si no cabe a los lados, colocar abajo
                    else {
                        left = Math.max(20, Math.min(window.innerWidth - tooltipWidth - 20, rect.left));
                        top = rect.bottom + spacing;
                    }

                    this.tooltipContainer.style.left = left + 'px';
                    this.tooltipContainer.style.top = top + 'px';
                    this.tooltipContainer.style.transform = 'translateY(-50%)';
                }, 300);
            }
        } else {
            // Centrar tooltip en la pantalla
            this.tooltipContainer.style.left = '50%';
            this.tooltipContainer.style.top = '50%';
            this.tooltipContainer.style.transform = 'translate(-50%, -50%)';
        }
    }

    /**
     * Avanza al siguiente paso
     */
    next() {
        if (this.currentStep < this.steps.length - 1) {
            this.showStep(this.currentStep + 1);
        }
    }

    /**
     * Salta el tutorial
     */
    skip() {
        this.finish();
    }

    /**
     * Finaliza el tutorial
     */
    finish() {
        // Marcar como completado
        localStorage.setItem('onboarding_completed', 'true');

        // Animación de salida
        this.overlay.style.opacity = '0';
        this.mascot.style.opacity = '0';
        this.tooltipContainer.style.opacity = '0';

        setTimeout(() => {
            // Remover elementos
            this.overlay.remove();
            this.mascot.remove();
            this.tooltipContainer.remove();

            // Remover highlight
            const highlight = document.querySelector('.tutorial-highlight');
            if (highlight) {
                highlight.classList.remove('tutorial-highlight');
                highlight.style.position = '';
                highlight.style.zIndex = '';
                highlight.style.boxShadow = '';
                highlight.style.borderRadius = '';
            }

            // Restaurar scroll
            document.body.style.overflow = '';
        }, 300);
    }
}

// Exportar para uso global
window.OnboardingTutorial = OnboardingTutorial;
