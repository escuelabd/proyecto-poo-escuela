<?php
class Clase {
    protected int $id;
    protected string $nombre;
    protected string $descripcion;
    protected int $idProfesor;
    protected int $idEscuela;

    public function __construct(int $id, string $nombre, string $descripcion, int $idProfesor, int $idEscuela) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->idProfesor = $idProfesor;
        $this->idEscuela = $idEscuela;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getIdProfesor(): int {
        return $this->idProfesor;
    }

    public function getIdEscuela(): int {
        return $this->idEscuela;
    }
}
?>