<?php
session_start();
require_once "conexion.php";

header("Content-Type: application/json");

if (!isset($_SESSION["usuario_id"])) {
    echo json_encode([
        "ok" => false,
        "mensaje" => "Sesión no válida."
    ]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);

$bpm = intval($input["bpm"] ?? 100);
$compas = intval($input["compas"] ?? 4);
$sonido = trim($input["sonido"] ?? "click");
$acentos = !empty($input["acentos"]) ? 1 : 0;

if ($bpm < 40 || $bpm > 220) {
    echo json_encode([
        "ok" => false,
        "mensaje" => "El BPM debe estar entre 40 y 220."
    ]);
    exit();
}

if (!in_array($compas, [2, 3, 4, 6])) {
    echo json_encode([
        "ok" => false,
        "mensaje" => "Compás no válido."
    ]);
    exit();
}

if (!in_array($sonido, ["click", "wood", "beep"])) {
    echo json_encode([
        "ok" => false,
        "mensaje" => "Sonido no válido."
    ]);
    exit();
}

try {
    $stmt = $conexion->prepare("
        INSERT INTO configuraciones (usuario_id, bpm, compas, sonido, acentos)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$_SESSION["usuario_id"], $bpm, $compas, $sonido, $acentos]);

    echo json_encode([
        "ok" => true,
        "mensaje" => "Configuración guardada correctamente."
    ]);
} catch (Exception $e) {
    echo json_encode([
        "ok" => false,
        "mensaje" => "Error al guardar la configuración."
    ]);
}
?>
