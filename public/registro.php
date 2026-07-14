<?php
/**
 * Módulo de Registro DML mediante Sentencias Preparadas
 */

require_once 'conexion.php';


$username = 'examen';
$email    = 'correo@ejemplo.com';
$password_plano = 'examen123'; 


$password = password_hash($password_plano, PASSWORD_BCRYPT);

// Sentencia SQL parametrizada utilizando placeholders posicionales (?) o nombrados
$sql = "INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :password)";

try {
    // 1. Preparación de la consulta en el servidor de base de datos
    $stmt = $pdo->prepare($sql);

    // 2. Ejecución pasando el mapeo de variables mediante placeholders
    // Este paso sanitiza y separa estrictamente la lógica SQL de los datos
    $stmt->execute([
        ':username' => $username,
        ':email'    => $email,
        ':password' => $password
    ]);

    echo "Registro ejecutado exitosamente. Filas afectadas: " . $stmt->rowCount();

} catch (\PDOException $e) {
    // Control de excepciones en caso de fallos en la capa DML (ej. restricción de unicidad)
    error_log("Error en inserción DML: " . $e->getMessage());
    echo "Error crítico al procesar la solicitud.";
}
