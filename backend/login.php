<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit();
}

$correo = trim($_POST["correo"] ?? "");
$password = $_POST["password"] ?? "";

if ($correo === "" || $password === "") {
    header("Location: ../index.php?error=Debes ingresar correo y contraseña.");
    exit();
}

try {
    $stmt = $conexion->prepare("SELECT id, nombre, correo, password FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario || !password_verify($password, $usuario["password"])) {
        header("Location: ../index.php?error=Correo o contraseña incorrectos.");
        exit();
    }

    $_SESSION["usuario_id"] = $usuario["id"];
    $_SESSION["usuario_nombre"] = $usuario["nombre"];
    $_SESSION["usuario_correo"] = $usuario["correo"];

    header("Location: ../dashboard.php");
    exit();

} catch (Exception $e) {
    header("Location: ../index.php?error=Error al iniciar sesión.");
    exit();
}
?>
