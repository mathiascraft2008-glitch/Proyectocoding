<?php
class Ronda {
    private ?int $id;
    private int $numero;
    private int $idTorneo;

    public function __construct(?int $id, int $numero, int $idTorneo) {
        $this->id = $id;
        $this->numero = $numero;
        $this->idTorneo = $idTorneo;
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
}
?>