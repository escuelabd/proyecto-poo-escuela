<?php
class Profesor {
    protected int $id;
    protected string $nombre;
    protected string $apellido;
    protected string $especialidad;
    protected int $idEscuela;

    public function __construct(int $id, string $nombre, string $apellido, string $especialidad, int $idEscuela) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->especialidad = $especialidad;
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

    public function getEspecialidad(): string {
        return $this->especialidad;
    }

    public function getIdEscuela(): int {
        return $this->idEscuela;
    }
}
?>