<?php
class Escuela {
    protected int $id;
    protected string $nombre;
    protected string $direccion;
    protected string $telefono;

    public function __construct(int $id, string $nombre, string $direccion, string $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getDireccion(): string {
        return $this->direccion;
    }

    public function getTelefono(): string {
        return $this->telefono;
    }
}
?>