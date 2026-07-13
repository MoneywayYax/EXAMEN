<?php
/**
 * Módulo de Conexión y Abstracción de Base de Datos mediante PDO
 */

$host    = 'localhost';
$db      = 'nombre_base_datos';
$user    = 'usuario_db';
$pass    = 'contrasena_db';
$charset = 'utf8mb4';

// Configuración del Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones de configuración del driver PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
    PDO::ATTR_EMULATE_PREPARES   => false,                 
];

try {
    // Instanciación de la clase PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Captura y manejo estructurado de errores de conexión sin exponer credenciales
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
