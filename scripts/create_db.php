<?php
$dsn = 'mysql:host=127.0.0.1;port=3307';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS innova CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "Database 'innova' creada (o ya existía).\n";
} catch (Exception $e) {
    echo "Error creando la base de datos: " . $e->getMessage() . "\n";
    exit(1);
}
