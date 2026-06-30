# Pruebas básicas del sistema

## Evidencia de pruebas

| No. | Módulo | Prueba realizada | Datos de entrada | Resultado esperado | Estado |
|---|---|---|---|---|---|
| 1 | Registro | Validar campos obligatorios | Campos vacíos | El sistema solicita completar la información | Pendiente de captura |
| 2 | Registro | Crear usuario nuevo | Nombre, correo y contraseña | Usuario registrado correctamente | Pendiente de captura |
| 3 | Login | Iniciar sesión correcto | Correo y contraseña válidos | Ingreso al panel principal | Pendiente de captura |
| 4 | Login | Iniciar sesión incorrecto | Contraseña errada | Mensaje de error | Pendiente de captura |
| 5 | Metrónomo | Cambiar BPM | 80, 100, 120 BPM | Cambia la velocidad del pulso | Pendiente de captura |
| 6 | Metrónomo | Iniciar metrónomo | Botón iniciar | El pulso comienza | Pendiente de captura |
| 7 | Metrónomo | Pausar metrónomo | Botón pausar | El pulso se pausa | Pendiente de captura |
| 8 | Metrónomo | Detener metrónomo | Botón detener | El pulso se detiene y vuelve al pulso 1 | Pendiente de captura |
| 9 | Configuración | Guardar preferencias | BPM, compás, sonido y acentos | La configuración se guarda en MySQL | Pendiente de captura |
| 10 | Sesión | Cerrar sesión | Botón cerrar sesión | El sistema vuelve al login | Pendiente de captura |

## Observación

Estas pruebas deben ejecutarse en el ambiente local con XAMPP. Se recomienda tomar capturas de cada prueba y guardarlas en la carpeta `Capturas`.
