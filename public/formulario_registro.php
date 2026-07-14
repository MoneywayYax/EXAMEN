<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios - Capa 1</title>
    <style>
      
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffff;
            width: 100%;
            max-width: 450px;
            /* Control estricto de espaciados y bordes */
            padding: 30px;
            border: 1px solid #e1e4e8;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        h2 {
            margin-bottom: 20px;
            color: #24292e;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444d56;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #d1d5da;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        
        input:focus {
            border-color: #0366d6;
            box-shadow: 0 0 0 3px rgba(3, 102, 214, 0.15);
        }

       
        input:focus:invalid {
            border-color: #cb2431;
            background-color: #fff8f8;
            box-shadow: 0 0 0 3px rgba(203, 36, 49, 0.15);
        }

        
        input:not(:placeholder-shown):valid {
            border-color: #28a745;
            background-color: #f6ffed;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #2f363d;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #24292e;
        }

        /* Alertas de la Capa 2 (Servidor) */
        .error-box {
            background-color: #ffeef0;
            border: 1px solid #f97583;
            color: #86181d;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registro de Usuario</h2>

    <?php if (isset($_SESSION['errores']) && !empty($_SESSION['errores'])): ?>
        <div class="error-box">
            <?php foreach ($_SESSION['errores'] as $error): ?>
                <p><strong>⚠️ Back-end Alert:</strong> <?= htmlspecialchars($error) ?></p>
            <?php endofach; ?>
        </div>
        <?php unset($_SESSION['errores']); // Limpieza del estado de la sesión ?>
    <?php endif; ?>

    <form action="procesar_registro.php" method="POST" novalidate>
        <div class="form-group">
            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" placeholder=" " required minlength="4" pattern="^[a-zA-Z0-9_]+$">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" placeholder=" " required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder=" " required minlength="8">
        </div>

        <button type="submit">Guardar Registro</button>
    </form>
</div>

</body>
</html>
