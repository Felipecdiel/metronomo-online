<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../registro.php");
    exit();
}

$nombre = trim($_POST["nombre"] ?? "");
$correo = trim($_POST["correo"] ?? "");
$password = $_POST["password"] ?? "";

if ($nombre === "" || $correo === "" || $password === "") {
    header("Location: ../registro.php?error=Todos los campos son obligatorios.");
    exit();
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../registro.php?error=El correo electrónico no es válido.");
    exit();
}

if (strlen($password) < 6) {
    header("Location: ../registro.php?error=La contraseña debe tener mínimo 6 caracteres.");
    exit();
}

try {
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);

    if ($stmt->fetch()) {
        header("Location: ../registro.php?error=El correo ya se encuentra registrado.");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $correo, $password_hash]);

    header("Location: ../index.php?mensaje=Usuario registrado correctamente. Ahora puedes iniciar sesión.");
    exit();

} catch (Exception $e) {
    header("Location: ../registro.php?error=Error al registrar el usuario.");
    exit();
}
?>
