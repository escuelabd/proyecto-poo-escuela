<?php
class Asignacion {
    protected int $id;
    protected int $idAlumno;
    protected int $idClase;

    public function __construct(int $id, int $idAlumno, int $idClase) {
        $this->id = $id;
        $this->idAlumno = $idAlumno;
        $this->idClase = $idClase;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getIdAlumno(): int {
        return $this->idAlumno;
    }

    public function getIdClase(): int {
        return $this->idClase;
    }
}
?>