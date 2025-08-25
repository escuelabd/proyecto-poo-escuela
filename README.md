# Gestor Escolar PHP

Un sistema de gestión escolar simple y funcional desarrollado con **PHP** y **Programación Orientada a Objetos (POO)**.

## Integrantes del Equipo
- **Julián Ledesma**
- **Sebastián Aguirre**

## Descripción del Proyecto
Este proyecto es una aplicación web para la administración de entidades educativas (escuelas, profesores, alumnos y clases). Permite a los administradores registrar, vincular y visualizar los datos de manera centralizada a través de una interfaz de usuario limpia y moderna.

El sistema se basa en un enfoque de Programación Orientada a Objetos para garantizar un código modular, mantenible y escalable. La base de datos, diseñada con un **Diagrama Entidad-Relación (DER)**, proporciona un soporte robusto para la información.

## Tecnologías Utilizadas
- **Backend:** PHP 8.1
- **Base de Datos:** MySQL
- **Frontend:** HTML5, CSS3
- **Librerías:** Font Awesome (para íconos)

## Estructura del Proyecto
- `index.php`: Contiene el dashboard principal y los formularios de registro para cada entidad.
- `tablas.php`: Muestra todas las tablas de la base de datos con un diseño profesional.
- `estilo.css`: Hoja de estilos para el diseño y la interfaz de usuario.
- `clases/`: Carpeta que almacena las clases PHP (`Alumno.php`, `Profesor.php`, etc.), siguiendo los principios de la POO.
- `utils/`: Carpeta que contiene la clase de conexión a la base de datos (`Database.php`).
- `escuela.sql`: Script de la base de datos para crear las tablas necesarias.

## Instalación y Ejecución
Sigue estos pasos para poner en marcha el proyecto en tu entorno local:

1.  **Clonar el Repositorio:**
    Abre tu terminal y ejecuta el siguiente comando para clonar el proyecto:
    ```bash
    git clone [https://docs.github.com/es/repositories/creating-and-managing-repositories/quickstart-for-repositories](https://docs.github.com/es/repositories/creating-and-managing-repositories/quickstart-for-repositories)
    ```

2.  **Configurar la Base de Datos:**
    -   Inicia tu servidor MySQL (p. ej., con **XAMPP** o **WAMP**).
    -   Crea una nueva base de datos con el nombre `gestion_escolar`.
    -   Importa el archivo `escuela.sql` para crear la estructura de las tablas.

3.  **Configurar el Servidor Web:**
    -   Copia todos los archivos del repositorio en la carpeta raíz de tu servidor web (`htdocs` en XAMPP, `www` en WAMP).

4.  **Ejecutar el Proyecto:**
    -   Abre tu navegador web y navega a `http://localhost/` o a la URL donde hayas alojado el proyecto.

¡Ya estás listo para empezar a usar el gestor escolar!
