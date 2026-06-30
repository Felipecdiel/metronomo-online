<?php
session_start();

if (isset($_SESSION["usuario_id"])) {
    header("Location: dashboard.php");
    exit();
}

$error = $_GET["error"] ?? "";
$mensaje = $_GET["mensaje"] ?? "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Metrónomo Online | Inicio de sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <main class="auth-container">
        <section class="auth-card">
            <div class="logo">🎵</div>
            <h1>Metrónomo Online</h1>
            <p class="subtitle">Inicia sesión para practicar tus ritmos.</p>

            <?php if ($mensaje): ?>
                <div class="alert success"><?php echo htmlspecialchars($mensaje); ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="backend/login.php" method="POST" class="form" id="loginForm">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

                <button type="submit" class="btn primary">Ingresar</button>
            </form>

            <p class="link-text">
                ¿No tienes cuenta?
                <a href="registro.php">Crear cuenta</a>
            </p>
        </section>
    </main>

    <script src="assets/js/auth.js"></script>
</body>
</html>
