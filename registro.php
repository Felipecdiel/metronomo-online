<?php
session_start();

if (isset($_SESSION["usuario_id"])) {
    header("Location: dashboard.php");
    exit();
}

$error = $_GET["error"] ?? "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Metrónomo Online | Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <main class="auth-container">
        <section class="auth-card">
            <div class="logo">🎶</div>
            <h1>Crear cuenta</h1>
            <p class="subtitle">Regístrate para guardar tus configuraciones.</p>

            <?php if ($error): ?>
                <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="backend/registrar.php" method="POST" class="form" id="registroForm">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>

                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required minlength="6">

                <button type="submit" class="btn primary">Registrarme</button>
            </form>

            <p class="link-text">
                ¿Ya tienes cuenta?
                <a href="index.php">Iniciar sesión</a>
            </p>
        </section>
    </main>

    <script src="assets/js/auth.js"></script>
</body>
</html>
