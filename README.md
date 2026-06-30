# Metrónomo Online

Proyecto desarrollado como evidencia **GA8-220501096-AA1-EV01 y GA8-220501096-AA1-EV02** del programa Análisis y Desarrollo de Software.

## Descripción

Metrónomo Online es una aplicación web que permite a los usuarios registrarse, iniciar sesión y usar un metrónomo configurable con BPM, compás, acentos y diferentes sonidos de pulso.

El sistema integra módulos de autenticación, panel principal, configuración musical, guardado de preferencias, conexión con base de datos y pruebas básicas.

## Tecnologías utilizadas

- HTML5
- CSS3
- JavaScript
- PHP
- MySQL / MariaDB
- XAMPP
- Git y GitHub

## Módulos del sistema

1. Registro de usuarios.
2. Inicio de sesión.
3. Panel principal del usuario.
4. Metrónomo configurable.
5. Guardado de configuración musical.
6. Cierre de sesión.
7. Conexión a base de datos.
8. Pruebas básicas.

## Requisitos

- XAMPP instalado.
- PHP 8 o superior.
- MySQL / MariaDB.
- Navegador web actualizado.
- Visual Studio Code.

## Instalación local

1. Descargar o clonar este repositorio.
2. Copiar la carpeta del proyecto dentro de `C:\xampp\htdocs`.
3. Abrir XAMPP y activar **Apache** y **MySQL**.
4. Abrir phpMyAdmin.
5. Importar el archivo `database/metronomo_online.sql`.
6. Abrir en el navegador:

```txt
http://localhost/metronomo-online/
```

Si la carpeta se llama `Proyecto_Metronomo_Online`, abrir:

```txt
http://localhost/Proyecto_Metronomo_Online/
```

## Base de datos

La base de datos se encuentra en:

```txt
database/metronomo_online.sql
```

Incluye las tablas:

- `usuarios`
- `configuraciones`

## Autor

Andrés Felipe Cediel Barrera  
Programa: Análisis y Desarrollo de Software
