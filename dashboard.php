<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php?error=Debes iniciar sesión para ingresar.");
    exit();
}

require_once "backend/conexion.php";

$usuario_id = $_SESSION["usuario_id"];
$nombre = $_SESSION["usuario_nombre"];

$config = [
    "bpm" => 100,
    "compas" => 4,
    "sonido" => "click",
    "acentos" => 1
];

try {
    $stmt = $conexion->prepare("SELECT bpm, compas, sonido, acentos FROM configuraciones WHERE usuario_id = ? ORDER BY id DESC LIMIT 1");
    $stmt->execute([$usuario_id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $config = $data;
    }
} catch (Exception $e) {
    // Si ocurre error, se mantienen valores por defecto.
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Metrónomo Online | Panel principal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <header class="topbar">
        <div>
            <h1>Metrónomo Online</h1>
            <p>Bienvenido, <?php echo htmlspecialchars($nombre); ?></p>
        </div>
        <a href="backend/logout.php" class="btn secondary">Cerrar sesión</a>
    </header>

    <main class="dashboard">
        <section class="metronome-card">
            <h2>Configuración del metrónomo</h2>

            <div class="bpm-display">
                <span id="bpmValue"><?php echo htmlspecialchars($config["bpm"]); ?></span>
                <small>BPM</small>
            </div>

            <div class="control-group">
                <label for="bpm">Velocidad</label>
                <input type="range" id="bpm" min="40" max="220" value="<?php echo htmlspecialchars($config["bpm"]); ?>">
            </div>

            <div class="grid">
                <div class="control-group">
                    <label for="compas">Compás</label>
                    <select id="compas">
                        <option value="2" <?php echo ($config["compas"] == 2) ? "selected" : ""; ?>>2/4</option>
                        <option value="3" <?php echo ($config["compas"] == 3) ? "selected" : ""; ?>>3/4</option>
                        <option value="4" <?php echo ($config["compas"] == 4) ? "selected" : ""; ?>>4/4</option>
                        <option value="6" <?php echo ($config["compas"] == 6) ? "selected" : ""; ?>>6/8</option>
                    </select>
                </div>

                <div class="control-group">
                    <label for="sonido">Sonido</label>
                    <select id="sonido">
                        <option value="click" <?php echo ($config["sonido"] == "click") ? "selected" : ""; ?>>Click clásico</option>
                        <option value="wood" <?php echo ($config["sonido"] == "wood") ? "selected" : ""; ?>>Madera</option>
                        <option value="beep" <?php echo ($config["sonido"] == "beep") ? "selected" : ""; ?>>Beep</option>
                    </select>
                </div>
            </div>

            <label class="checkbox">
                <input type="checkbox" id="acentos" <?php echo ($config["acentos"]) ? "checked" : ""; ?>>
                Activar acento en el primer pulso
            </label>

            <div class="beat-indicator" id="beatIndicator">1</div>

            <div class="button-row">
                <button class="btn primary" id="startBtn">Iniciar</button>
                <button class="btn warning" id="pauseBtn">Pausar</button>
                <button class="btn danger" id="stopBtn">Detener</button>
            </div>

            <button class="btn save" id="saveConfigBtn">Guardar configuración</button>
            <p id="saveMessage" class="save-message"></p>
        </section>

        <section class="info-card">
            <h2>Descripción del módulo</h2>
            <p>
                Este módulo permite configurar y reproducir un pulso musical. El usuario puede cambiar el BPM,
                seleccionar el compás, activar acentos y guardar su configuración en la base de datos.
            </p>

            <h3>Funciones integradas</h3>
            <ul>
                <li>Control de velocidad BPM.</li>
                <li>Selección de compás musical.</li>
                <li>Reproducción de sonido con JavaScript.</li>
                <li>Persistencia de configuración con PHP y MySQL.</li>
                <li>Control de sesión de usuario.</li>
            </ul>
        </section>
    </main>

    <script>
        const USUARIO_ID = <?php echo json_encode($usuario_id); ?>;
    </script>
    <script src="assets/js/metronomo.js"></script>
</body>
</html>
