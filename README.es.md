# GIA (Guía de Incubación Asistida)

Aplicación web construida con Laravel que ofrece un flujo de módulos y misiones, panel de progreso y un asistente de IA (Groq). Preparada para ejecutarse con XAMPP en Windows y para servir desde subcarpeta (`/innova/public`).

## Requisitos
- PHP 8.2 o superior
- Composer
- MySQL (XAMPP) — por defecto en `127.0.0.1:3307`
- Node.js (opcional para assets con Vite)

## Instalación rápida (Windows / PowerShell)
```powershell
# 1) Dependencias PHP
composer install

# 2) Variables de entorno y clave de app
Copy-Item .env.example .env
php artisan key:generate

# 3) Configura tu base de datos en .env
#   DB_HOST=127.0.0.1
#   DB_PORT=3307           # Puerto MySQL de XAMPP
#   DB_DATABASE=innova     # Crea esta BD en MySQL o ajusta el nombre
#   DB_USERNAME=root       # O el usuario que uses
#   DB_PASSWORD=           # En XAMPP suele quedar vacío

# (Opcional) Configura Groq para el asistente
#   GROQ_API_KEY=tu_api_key
#   GROQ_MODEL=llama-3.1-70b

# 4) Migraciones y datos iniciales
php artisan migrate --seed

# 5) Vínculo de almacenamiento público
php artisan storage:link

# 6) Compilar assets (opcional si usas Vite)
npm install
npm run build
```

## Ejecución
- Con Apache de XAMPP: abre `http://localhost/innova/public/`
- Servidor embebido de Laravel:
```powershell
php artisan serve
```

## Scripts útiles
```powershell
# Desarrollo con Vite (hot reload)
npm run dev

# Atajo de project setup (instala deps, genera .env, migra y build)
composer run setup

# Entorno de desarrollo combinado (servidor + colas + logs + vite)
composer run dev
```

## Variables de entorno clave (.env)
- `APP_NAME`, `APP_ENV`, `APP_KEY`, `APP_URL`
- `DB_CONNECTION=mysql`, `DB_HOST=127.0.0.1`, `DB_PORT=3307`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `QUEUE_CONNECTION=database` (o `sync` en local), `CACHE_DRIVER=file`
- `GROQ_API_KEY`, `GROQ_MODEL` para el asistente IA

## Estructura principal
- `app/` Controladores, modelos y servicios (incluye `Services/GroqService.php`).
- `resources/views/` Vistas Blade (dashboard, misiones, módulos, etc.).
- `routes/web.php` y `routes/api.php` Definición de rutas.
- `database/migrations/` y `database/seeders/` Esquema y datos iniciales.
- `public/` Punto de entrada (`index.php`) y assets públicos.
- `front/gia-mvp/` Prototipos/maquetas HTML del front.

## Tecnologías
- Backend: Laravel ^12 (PHP ^8.2), Blade, Artisan, Migrations/Seeders, Sanctum.
- Frontend: Vite ^7, Tailwind CSS ^4, Axios ^1.11, `laravel-vite-plugin`.
- QA/Dev: PHPUnit ^11, Pint, Sail/Pail, Composer, NPM.

## Licencias y uso de terceros
- El ecosistema Laravel y las herramientas de frontend listadas usan licencias permisivas (principalmente MIT).
- Este repositorio puede incorporar marcas o imágenes de terceros. En particular, revisa `public/assets/images/` (por ejemplo `childfund-logo.jpg`).
  - Úsalas solo si cuentas con autorización o para fines demostrativos.
  - Si publicas el proyecto, considera reemplazar logos por placeholders.

### Licencia del proyecto
- En `composer.json` se declara `"license": "MIT"`. Para formalizarlo en GitHub, agrega un archivo `LICENSE` en la raíz con el texto de MIT o la licencia que elijas.
- Si prefieres mantener “Todos los derechos reservados”, elimina/revierte esa declaración y añade un aviso en este README.

## Buenas prácticas
- No subir artefactos generados (p. ej. vistas compiladas en `storage/framework/views/`).
- Mantener `.env` fuera del control de versiones.
- Usar ramas por feature y Pull Requests antes de mergear a `main`.

## Solución de problemas
- “No carga la app en XAMPP”: confirma la ruta `http://localhost/innova/public/` y que Apache está activo.
- “Error de conexión a BD”: verifica puerto `3307`, credenciales y que la BD existe.
- “Assets sin estilos”: ejecuta `npm install; npm run build` o levanta `npm run dev`.

---

Hecho con Laravel y cariño. Si necesitas una guía rápida para despliegue o agregar un archivo de licencia, abre un issue o comenta en el repositorio.
