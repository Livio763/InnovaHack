# 🚀 GIA - Guía de Incubación Asistida

**MVP Frontend-Only** para InnovaHack - Una plataforma de aprendizaje emprendedor gamificada para jóvenes bolivianos (16-24 años).

---

## 📋 Descripción

GIA (Guía de Incubación Asistida) es una plataforma educativa progresiva que transforma el programa de incubación de ChildFund en una experiencia digital interactiva, diseñada específicamente para contextos de baja conectividad.

### ✨ Características principales

- ✅ **100% Frontend** - No requiere backend ni base de datos
- 📱 **Mobile-first** - Diseño optimizado para celulares
- 🎮 **Gamificación** - Misiones, puntos e insignias
- 🔌 **Funciona offline** - PWA instalable
- 🎯 **Cero formularios** - Solo botones grandes con emojis
- 📹 **Zero-rated friendly** - Enlaces externos a TikTok (no consume datos)

---

## 🏗️ Estructura del Proyecto

```
gia-mvp/
├── index.html          # Pantalla de bienvenida
├── quiz-1.html         # Quiz: ¿Idea o negocio activo?
├── quiz-2.html         # Quiz: Rubro del emprendimiento
├── route.html          # Asignación de ruta personalizada
├── dashboard.html      # Dashboard de misiones
├── mission.html        # Pantalla de misión individual
├── success.html        # Celebración de misión completada
├── manifest.json       # Configuración PWA
├── sw.js              # Service Worker (cache offline)
└── js/
    └── app.js         # Lógica JavaScript principal
```

---

## 🚀 Cómo usar

### Opción 1: Abrir localmente

1. Descarga o clona este repositorio
2. Abre `index.html` directamente en tu navegador
3. ¡Listo! No necesitas servidor

### Opción 2: Desplegar en GitHub Pages

1. Sube el proyecto a un repositorio de GitHub
2. Ve a **Settings** → **Pages**
3. Selecciona la rama `main` como source
4. Tu app estará disponible en: `https://tu-usuario.github.io/gia-mvp/`

### Opción 3: Usar Live Server (VS Code)

1. Instala la extensión "Live Server" en VS Code
2. Clic derecho en `index.html` → "Open with Live Server"
3. Se abrirá en `http://localhost:5500`

---

## 📱 Flujo de Usuario

```
1. index.html
   ↓ (Continuar como invitado)
2. quiz-1.html
   ↓ (Seleccionar: Idea / Negocio activo)
3. quiz-2.html
   ↓ (Seleccionar rubro: Comida / Ropa / Servicios / Otro)
4. route.html
   ↓ (Asignación automática de ruta personalizada)
5. dashboard.html
   ↓ (Ver misiones disponibles)
6. mission.html
   ↓ (Ver tutorial TikTok + Subir foto)
7. success.html
   ↓ (Celebración: +100 puntos, insignia 📸)
   ↓
   Volver a dashboard.html
```

---

## 🎯 Misiones Disponibles (MVP)

### ✅ Misión 1: Saca fotos que vendan
- **Contenido:** Tutorial de fotografía de productos
- **Acción:** Subir foto aplicando lo aprendido
- **Recompensa:** +100 puntos, insignia 📸 Fotógrafo

### 🔒 Misión 2: Crea contenido viral (bloqueada)
- Desbloquea al completar Misión 1
- **Recompensa:** +150 puntos

### 🔒 Misión 3: Tu primer pitch (bloqueada)
- Desbloquea al completar Misión 2
- **Recompensa:** +200 puntos

---

## 🛠️ Tecnologías Utilizadas

- **HTML5** - Estructura semántica
- **Tailwind CSS** (vía CDN) - Estilos responsivos
- **JavaScript Vanilla** - Lógica sin frameworks
- **localStorage** - Persistencia de datos
- **PWA** (Progressive Web App) - Instalable y offline
- **Web Share API** - Compartir logros

---

## 🎨 Paleta de Colores

- **Primario:** `#3B82F6` (Azul Tailwind)
- **Secundario:** `#10B981` (Verde)
- **Acento:** `#F97316` (Naranja)
- **Degradados:** Personalizados por ruta

---

## 💾 Datos Almacenados (localStorage)

```javascript
// Respuestas del quiz
stage: 'idea' | 'active'
category: 'food' | 'fashion' | 'services' | 'other'

// Progreso
missionsCompleted: ['mission1', 'mission2', ...]
totalPoints: '250'
badges: [{ id, name, icon, earnedAt }, ...]

// Contenido del usuario
mission1Photo: 'data:image/jpeg;base64,...'
```

---

## 📦 Instalación como App Móvil

### Android (Chrome)
1. Abre la web en Chrome
2. Menú (⋮) → "Agregar a pantalla de inicio"
3. Se instala como app nativa

### iOS (Safari)
1. Abre la web en Safari
2. Botón "Compartir" → "Agregar a inicio"
3. Se instala como app

---

## 🔧 Personalización

### Cambiar colores principales
Edita las clases de Tailwind en cada archivo HTML:
```html
<!-- Ejemplo: cambiar color del header -->
<div class="bg-gradient-to-r from-blue-500 to-purple-600">
```

### Agregar más misiones
1. Agrega un nuevo botón en `dashboard.html`
2. Crea una nueva página `mission-2.html` (copia `mission.html`)
3. Actualiza las funciones en `js/app.js`

### Modificar rutas
Edita el script al final de `route.html`:
```javascript
if (stage === 'idea') {
    routeName = 'Tu nueva ruta';
    routeDescription = 'Descripción personalizada';
}
```

---

## 🐛 Troubleshooting

### La imagen no se guarda
- **Problema:** localStorage tiene límite de ~5-10MB
- **Solución:** Comprime la imagen antes de guardar

### Service Worker no funciona
- **Problema:** Requiere HTTPS (excepto localhost)
- **Solución:** Despliega en GitHub Pages o usa localhost

### Botones no responden
- **Problema:** JavaScript no se carga
- **Solución:** Verifica que `js/app.js` esté en la ruta correcta

---

## 📈 Próximos Pasos (Post-MVP)

- [ ] Backend con Node.js + MongoDB
- [ ] Sistema de autenticación
- [ ] Chat con mentores
- [ ] Más módulos (Escalamiento, Consolidación, Despegue)
- [ ] Integración real con TikTok API
- [ ] Panel de administración para mentores
- [ ] Analytics y métricas de progreso

---

## 🤝 Contribuir

Este es un MVP para hackatón. Si quieres mejorar GIA:

1. Fork el repositorio
2. Crea una rama: `git checkout -b feature/nueva-funcionalidad`
3. Commit: `git commit -m 'Agrega nueva funcionalidad'`
4. Push: `git push origin feature/nueva-funcionalidad`
5. Abre un Pull Request

---

## 📄 Licencia

Este proyecto fue desarrollado para InnovaHack 2025. Basado en el programa de incubación de ChildFund Bolivia.

---

## 👥 Equipo

- **Proyecto:** GIA - Guía de Incubación Asistida
- **Hackatón:** InnovaHack 2025
- **Inspirado en:** Programa de Incubación ChildFund Bolivia

---

## 📞 Contacto

¿Preguntas sobre GIA? Contáctanos:
- 📧 Email: [tu-email@ejemplo.com]
- 🐦 Twitter: [@tu-handle]
- 💼 LinkedIn: [Tu Perfil]

---

**¡Gracias por usar GIA! 🚀**

*Hecho con ❤️ para emprendedores jóvenes de Bolivia*
