const bpmInput = document.getElementById("bpm");
const bpmValue = document.getElementById("bpmValue");
const compasInput = document.getElementById("compas");
const sonidoInput = document.getElementById("sonido");
const acentosInput = document.getElementById("acentos");
const beatIndicator = document.getElementById("beatIndicator");
const startBtn = document.getElementById("startBtn");
const pauseBtn = document.getElementById("pauseBtn");
const stopBtn = document.getElementById("stopBtn");
const saveConfigBtn = document.getElementById("saveConfigBtn");
const saveMessage = document.getElementById("saveMessage");

let audioContext = null;
let intervalId = null;
let currentBeat = 1;
let running = false;

function getIntervalMs() {
    const bpm = Number(bpmInput.value);
    return 60000 / bpm;
}

function createSound(frequency, duration, type = "sine") {
    if (!audioContext) {
        audioContext = new (window.AudioContext || window.webkitAudioContext)();
    }

    const oscillator = audioContext.createOscillator();
    const gain = audioContext.createGain();

    oscillator.type = type;
    oscillator.frequency.value = frequency;

    oscillator.connect(gain);
    gain.connect(audioContext.destination);

    gain.gain.setValueAtTime(0.8, audioContext.currentTime);
    gain.gain.exponentialRampToValueAtTime(0.001, audioContext.currentTime + duration);

    oscillator.start(audioContext.currentTime);
    oscillator.stop(audioContext.currentTime + duration);
}

function playBeat() {
    const compas = Number(compasInput.value);
    const useAccent = acentosInput.checked;
    const sound = sonidoInput.value;

    beatIndicator.textContent = currentBeat;
    beatIndicator.classList.remove("accent");
    void beatIndicator.offsetWidth;

    const isAccent = currentBeat === 1 && useAccent;

    if (isAccent) {
        beatIndicator.classList.add("accent");
    }

    if (sound === "click") {
        createSound(isAccent ? 1200 : 800, 0.08, "square");
    } else if (sound === "wood") {
        createSound(isAccent ? 900 : 600, 0.06, "triangle");
    } else {
        createSound(isAccent ? 1400 : 1000, 0.07, "sine");
    }

    currentBeat = currentBeat >= compas ? 1 : currentBeat + 1;
}

function startMetronome() {
    if (running) return;

    running = true;
    playBeat();

    intervalId = setInterval(() => {
        playBeat();
    }, getIntervalMs());

    startBtn.disabled = true;
}

function pauseMetronome() {
    running = false;
    clearInterval(intervalId);
    startBtn.disabled = false;
}

function stopMetronome() {
    running = false;
    clearInterval(intervalId);
    currentBeat = 1;
    beatIndicator.textContent = "1";
    beatIndicator.classList.remove("accent");
    startBtn.disabled = false;
}

function restartIfRunning() {
    if (running) {
        clearInterval(intervalId);
        intervalId = setInterval(() => {
            playBeat();
        }, getIntervalMs());
    }
}

async function saveConfiguration() {
    const data = {
        bpm: Number(bpmInput.value),
        compas: Number(compasInput.value),
        sonido: sonidoInput.value,
        acentos: acentosInput.checked
    };

    saveMessage.textContent = "Guardando configuración...";

    try {
        const response = await fetch("backend/guardar_configuracion.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        saveMessage.textContent = result.mensaje;
        saveMessage.className = result.ok ? "save-message ok" : "save-message error-text";
    } catch (error) {
        saveMessage.textContent = "No fue posible guardar la configuración.";
        saveMessage.className = "save-message error-text";
    }
}

bpmInput.addEventListener("input", () => {
    bpmValue.textContent = bpmInput.value;
    restartIfRunning();
});

compasInput.addEventListener("change", () => {
    currentBeat = 1;
    beatIndicator.textContent = "1";
});

startBtn.addEventListener("click", startMetronome);
pauseBtn.addEventListener("click", pauseMetronome);
stopBtn.addEventListener("click", stopMetronome);
saveConfigBtn.addEventListener("click", saveConfiguration);
