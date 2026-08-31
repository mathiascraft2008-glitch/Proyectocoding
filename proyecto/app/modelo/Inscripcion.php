<?php

class Inscripcion {

    private ?int $id;
    private int $idParticipante;
    private int $idTorneo;
    private ?int $idEquipo;

    public function __construct(?int $id,int $idParticipante,int $idTorneo,?int $idEquipo){
        $this->id = $id;
        $this->idParticipante = $idParticipante;
        $this->idTorneo = $idTorneo;
        $this->idEquipo = $idEquipo;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getIdParticipante(): int {
        return $this->idParticipante;
    }

    public function getIdTorneo(): int {
        return $this->idTorneo;
    }

    public function getIdEquipo(): ?int {
        return $this->idEquipo;
    }

    public function setIdEquipo(?int $idEquipo): void {
        $this->idEquipo = $idEquipo;
    }
}
?>
