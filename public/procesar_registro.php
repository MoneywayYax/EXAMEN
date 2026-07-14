<?php
// Iniciar sesión para el manejo seguro
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Recepción de datos crudos
    $username_raw = $_POST['username'] ?? '';
    $email_raw = $_POST['email'] ?? '';
    $password_raw = $_POST['password'] ?? '';

    // Arreglo para almacenar los errores de la Capa 2
    $errores_backend = [];

    // 2. Validación de Capa 2 (Zero Trust)
    
    // Validar Username (No vacío)
    $username = trim($username_raw);
    if (empty($username)) {
        $errores_backend[] = "El nombre de usuario es obligatorio.";
    }

    // Validar Email (Formato correcto)
    $email = trim($email_raw);
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores_backend[] = "El formato del correo electrónico es inválido.";
    }

    // Validar Password (Mínimo 8 caracteres, tal como exigía el Front-end)
    if (empty($password_raw) || strlen($password_raw) < 8) {
        $errores_backend[] = "La contraseña no cumple con los requisitos de seguridad.";
    }

    // 3. Resolución de la Auditoría
    if (!empty($errores_backend)) {
        // Asimetría de Confianza: El front-end fue evadido o falló.
        // Se rechaza la petición y se registran los errores.
        $_SESSION['errores'] = $errores_backend;
        
        // Redirigir de vuelta al formulario (Ajustar al nombre del archivo HTML/PHP del front)
        header("Location: formulario_registro.php");
        exit();
    } else {
        // Capa 2 superada. Los datos son seguros.
        // Aquí debes enlazar con el código de persistencia (INSERT) del Estudiante 2
        // o con la lógica de Login que preparaste anteriormente con password_verify().
        
        require_once 'registro.php'; // O la conexión correspondiente
    }
}
?>
