<?php
class Alumno {
    protected int $id;
    protected string $nombre;
    protected string $apellido;
    protected int $edad;
    protected int $idEscuela;

    public function __construct(int $id, string $nombre, string $apellido, int $edad, int $idEscuela) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->idEscuela = $idEscuela;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getApellido(): string {
        return $this->apellido;
    }

    public function getEdad(): int {
        return $this->edad;
    }

    public function getIdEscuela(): int {
        return $this->idEscuela;
    }
}
?>