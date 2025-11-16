# VirtualHost para GIA en Apache XAMPP

## Opción 1: Agregar VirtualHost (Recomendado)

1. Abre `C:\xampp\apache\conf\extra\httpd-vhosts.conf`

2. Agrega al final:
```apache
<VirtualHost *:80>
    ServerName gia.local
    DocumentRoot "C:/xampp/htdocs/Innova/public"
    
    <Directory "C:/xampp/htdocs/Innova/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog "logs/gia-error.log"
    CustomLog "logs/gia-access.log" common
</VirtualHost>
```

3. Abre `C:\Windows\System32\drivers\etc\hosts` como administrador

4. Agrega:
```
127.0.0.1 gia.local
```

5. Reinicia Apache en XAMPP

6. Accede a: `http://gia.local`

---

## Opción 2: Usar servidor de Laravel (Más fácil)

1. En VS Code, abre terminal

2. Ejecuta:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

3. Accede a: `http://localhost:8000`

---

## Problema actual

Apache/XAMPP no está procesando correctamente las rutas de Laravel en subdirectorios.
La estructura de carpetas `localhost/innova/public` causa conflictos con las rutas API.
