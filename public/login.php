<?php
/**
 * Módulo de Autenticación Segura y Validación de Capa 2
 */

// 1. Gestión de Sesiones Seguras (Debe llamarse antes de cualquier salida de texto)
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,         // Expiración de la cookie en 1 día
        'cookie_secure'   => true,          // Solo transmite sobre HTTPS
        'cookie_httponly' => true,          // Mitiga ataques XSS al impedir acceso vía JavaScript
        'cookie_samesite' => 'Strict',      // Previene ataques CSRF
    ]);
}

require_once '../config/conexion.php';

// Inicialización de variables para control de flujo
$error_message = "";

// Verificar método de petición HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // =========================================================================
    // VALIDACIÓN DE CAPA 2 (Re-validación estricta en el Back-end)
    // =========================================================================
    $input_email    = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $input_password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Evaluación de vulnerabilidades por evasión de Front-end
    if (!$input_email || empty($input_password)) {
        $error_message = "Credenciales inválidas o formato incorrecto.";
    } else {
        try {
            // Sentencia preparada para recuperar el registro por identificador único
            $sql = "SELECT id, username, password FROM usuarios WHERE email = :email LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $input_email]);
            $user = $stmt->fetch();

            // 2. Autenticación y Verificación de Hash
            if ($user && password_verify($input_password, $user['password'])) {
                // Regeneración del ID de sesión para prevenir Session Fixation (Fijación de Sesión)
                session_regenerate_id(true);

                // Inyección de variables de estado en la superglobal $_SESSION
                $_SESSION['user_id']    = $user['id'];
                $_SESSION['username']   = $user['username'];
                $_SESSION['last_login'] = time();

                // Redirección segura al panel principal
                header("Location: dashboard.php");
                exit();
            } else {
                // Mensaje genérico para evitar la enumeración de usuarios
                $error_message = "Credenciales incorrectas.";
            }

        } catch (\PDOException $e) {
            // AUDITORÍA DE SEGURIDAD: Registro interno omitiendo datos sensibles hacia el cliente
            error_log("Fallo crítico en autenticación (Capa de datos): " . $e->getMessage());
            $error_message = "Ocurrió un error interno en el servidor.";
        }
    }
}
