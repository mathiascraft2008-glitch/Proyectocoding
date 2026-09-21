<?php
class Ronda {
    private ?int $id;
    private int $numero;
    private int $idTorneo;
    private ?string $fechaInicio;

    public function __construct(?int $id, int $numero, int $idTorneo, ?string $fechaInicio) {
        $this->id = $id;
        $this->numero = $numero;
        $this->idTorneo = $idTorneo;
        $this->fechaInicio = $fechaInicio;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNumero(): int {
        return $this->numero;
    }

    public function getIdTorneo(): int {
        return $this->idTorneo;
    }
    public function getFechaInicio(): ?string {
        return $this->fechaInicio;
    }
}
?>