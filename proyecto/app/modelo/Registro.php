<?php
class Registro {

    private ?int $id;
    private string $accion;
    private int $idUsuario;
    private ?string $fecha;

    public function __construct(?int $id,string $accion,int $idUsuario,?string $fecha) {
        $this->id = $id;
        $this->accion = $accion;
        $this->idUsuario = $idUsuario;
        $this->fecha = $fecha;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getAccion(): string {
        return $this->accion;
    }

    public function getFecha(): ?string {
        return $this->fecha;
    }

    public function getIdUsuario(): int {
        return $this->idUsuario;
    }
}
?>
