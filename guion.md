# Guion de defensa – GIA (Guía de Incubación Asistida)

Este guion está pensado para una persona no técnica que debe presentar y defender el proyecto. Úsalo como narrativa durante la demo; incluye mensajes clave, pasos de demostración y respuestas rápidas a preguntas comunes.

---

## 1) Mensaje de apertura (30–45 seg)
- GIA es una plataforma web que acompaña a emprendedores paso a paso con “misiones” prácticas y un asistente de IA que responde dudas en tiempo real.
- El objetivo es acelerar el aprendizaje aplicado y que cada persona avance con claridad, sin perderse en teoría.
- Hoy mostraré cómo un usuario entra, ve sus misiones, completa la primera misión y usa el asistente.

Frase clave: “GIA convierte el contenido en acciones concretas, con IA como copiloto”.

---

## 2) Problema y solución (45–60 seg)
- Problema: en programas de formación, la gente se pierde entre mucha teoría y poca práctica; además, cada quien avanza a ritmos distintos y surgen dudas puntuales.
- Solución: estructura por módulos y misiones accionables + un asistente de IA contextual para resolver dudas al instante.
- Beneficio: más finalización de tareas, mejor retención y mayor sensación de acompañamiento.

---

## 3) A quién sirve (20–30 seg)
- Emprendedores y participantes de programas de incubación/aceleración.
- Organizaciones que quieren seguimiento claro del avance.

---

## 4) Demo – recorrido guiado (4–6 min)

Tienes dos formas de mostrar la demo; elige la A (completa) si tienes el entorno, o la B (ligera) si solo quieres enseñar el flujo visual.

A) Demo completa (Laravel/XAMPP)
1. Acceso: abre `http://localhost/innova/public/` (servido por XAMPP) o `php artisan serve` si usas el servidor embebido.
2. Inicio/Registro/Login: muestra la pantalla de bienvenida y el acceso.
3. Dashboard: se ven los módulos disponibles y el progreso del usuario.
4. Módulos y Misiones: entra al listado de misiones.
5. Misión 1: abre la misión de ejemplo (curso + quiz). Explica: “cada misión tiene instrucciones claras y una entrega concreta”.
6. Asistente IA: abre el asistente desde la vista de misión, haz una pregunta típica (ej.: “¿Cómo definir mi propuesta de valor?”). Di que usa la API de Groq.
7. Entrega y progreso: muestra cómo se envía una entrega y cómo se actualiza el progreso/badges.
8. Cierre: vuelve al dashboard y resalta el avance registrado.

B) Demo ligera (maquetas HTML)
1. Abre `front/gia-mvp/dashboard.html` en el navegador.
2. Navega a `front/gia-mvp/mission.html` para enseñar el flujo de misión.
3. Muestra los elementos clave (instrucciones, quiz, botón de entrega, asistente simulado si corresponde).

Tips de demo
- Narra “objetivo > acción > resultado”. Evita términos técnicos.
- Mantén una pregunta preparada para el asistente. Resalta que responde en segundos.

---

## 5) ¿Qué hace diferente a GIA? (60–90 seg)
- Acción antes que teoría: misiones con entregables, no solo lectura.
- Acompañamiento 24/7: asistente IA dentro del flujo, no en otra pestaña.
- Progreso claro: dashboard, misiones, posibles insignias/medallas.
- Fácil de operar: funciona en entornos simples (XAMPP) y se puede desplegar en hosting tradicional.

---

## 6) Arquitectura explicada sin tecnicismos (45–60 seg)
- Backend: Laravel (PHP) organiza la lógica, guarda el progreso y sirve las páginas.
- Frontend: vistas limpias con Tailwind y Vite para estilos y assets.
- IA: un servicio conecta con Groq (proveedor de modelos de lenguaje) para responder preguntas.
- Base de datos: registra usuarios, módulos, misiones, envíos y progreso.

Metáfora: “Laravel es el organizador; la BD es la libreta; la IA es el tutor”.

---

## 7) Requisitos para correrlo (solo si te preguntan)
- XAMPP con MySQL en `127.0.0.1:3307` (configurable).
- PHP 8.2+, Composer, y opcionalmente Node para compilar estilos.
- URL local típica: `http://localhost/innova/public/`.

---

## 8) Seguridad, datos y licencias (30–45 seg)
- Datos: se guardan los avances y entregas por usuario.
- Licencias: Laravel, Tailwind, Vite y la mayoría de dependencias son MIT (permisivas).
- Marcas y logos: si aparece algún logo de terceros (ej. `public/assets/images/childfund-logo.jpg`), es solo con fines demostrativos; usar con permiso.

---

## 9) Roadmap (qué sigue) (30–45 seg)
- Más misiones y rutas de aprendizaje por perfil.
- Panel para facilitadores con analítica de cohortes.
- Rubricas de evaluación y feedback asistido por IA.
- Gamificación ampliada (insignias, niveles, ranking optativo).

---

## 10) Cierre (20–30 seg)
- “GIA guía con claridad, convierte el aprendizaje en acciones y resuelve dudas en el momento. Estamos listos para pilotearlo con un grupo y medir impacto”.

CTA sugerido: “¿Les gustaría verlo en un piloto de 2 semanas?”

---

## 11) Preguntas frecuentes (FAQ breve)
- ¿Necesita internet? Para usar la IA, sí. El resto funciona local si está instalado.
- ¿Se puede personalizar el contenido? Sí, los módulos y misiones se pueden editar/cargar.
- ¿Cómo se guarda el progreso? En la base de datos, por usuario y misión.
- ¿Qué modelo de IA usan? Groq (configurable por variable de entorno).
- ¿Qué pasa con los datos? Solo se almacenan datos del uso de la plataforma; cumplir políticas de privacidad del implementador.

---

## 12) Plan B si algo falla en vivo
- Si el backend no arranca, muestra la demo ligera con `front/gia-mvp/*.html` para enseñar el flujo.
- Si la IA no responde, di: “el asistente depende de internet/API; aquí pueden ver el flujo y dónde aparece su respuesta”.

---

## 13) Anexo para el presentador
- Enlace local: `http://localhost/innova/public/`
- Usuario de prueba: crea uno antes de la demo y avanza una misión para mostrar progreso.
- 3 frases clave:
  1) “Misiones accionables, no solo teoría.”
  2) “Asistente IA dentro del flujo.”
  3) “Progreso claro y medible.”

---

Hecho para presentar sin tecnicismos. Si necesitas una versión en una sola página de slides, este guion puede transformarse en 7–8 diapositivas siguiendo los mismos títulos.
