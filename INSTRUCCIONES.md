# 🚀 Instrucciones para iniciar GIA

## ⚠️ IMPORTANTE: Usar el servidor de Laravel

Para que la aplicación funcione correctamente con la base de datos, debes acceder a través del servidor de Laravel, NO Apache/XAMPP.

### Pasos:

1. **Abre una terminal PowerShell en VS Code**

2. **Inicia el servidor Laravel:**
   ```bash
   php artisan serve
   ```

3. **Abre tu navegador en:**
   ```
   http://127.0.0.1:8000
   ```
   
   ❌ NO uses: `localhost/innova/public/`
   ✅ USA: `http://127.0.0.1:8000`

### ¿Por qué?

- El servidor de Laravel (`php artisan serve`) incluye las rutas API necesarias
- Apache/XAMPP solo sirve archivos estáticos y no procesa las rutas de Laravel correctamente sin configuración adicional
- Las rutas API (`/api/register`, `/api/login`, etc.) solo funcionan con el servidor de Laravel

### Verificar que funciona:

1. Ve a: http://127.0.0.1:8000
2. Llena el formulario de registro
3. Deberías ver que se crea la cuenta y te redirige automáticamente

---

**Nota:** Asegúrate de que MySQL está corriendo en XAMPP (puerto 3307) antes de iniciar el servidor.
