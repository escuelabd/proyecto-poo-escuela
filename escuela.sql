CREATE DATABASE IF NOT EXISTS gestion_escolar;

USE gestion_escolar;

CREATE TABLE IF NOT EXISTS Escuela (
    idEscuela INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS Profesor (
    idProfesor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    especialidad VARCHAR(100),
    idEscuela INT,
    FOREIGN KEY (idEscuela) REFERENCES Escuela(idEscuela) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Alumno (
    idAlumno INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    edad INT,
    idEscuela INT,
    FOREIGN KEY (idEscuela) REFERENCES Escuela(idEscuela) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Clase (
    idClase INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    idProfesor INT,
    idEscuela INT,
    FOREIGN KEY (idProfesor) REFERENCES Profesor(idProfesor) ON DELETE SET NULL,
    FOREIGN KEY (idEscuela) REFERENCES Escuela(idEscuela) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Asignacion (
    idAsignacion INT AUTO_INCREMENT PRIMARY KEY,
    idAlumno INT,
    idClase INT,
    FOREIGN KEY (idAlumno) REFERENCES Alumno(idAlumno) ON DELETE CASCADE,
    FOREIGN KEY (idClase) REFERENCES Clase(idClase) ON DELETE CASCADE,
    UNIQUE (idAlumno, idClase)
);