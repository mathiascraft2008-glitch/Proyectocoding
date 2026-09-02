<?php
class Competidor {
    private ?int $id;
    private int $idTorneo;
    private string $tipo;
    private ?int $idInscripcion;
    private ?int $idEquipo;

    public function __construct(?int $id,int $idTorneo,string $tipo,?int $idInscripcion,?int $idEquipo){
        $this->id = $id;
        $this->idTorneo = $idTorneo;
        $this->idInscripcion = $idInscripcion;
        $this->idEquipo = $idEquipo;
        $this->tipo = $tipo;
    }

    public function getTipo(): string {
        return $this->tipo;
    }
    public function getId(): ?int {
        return $this->id;
    }
    public function getIdTorneo(): int {
        return $this->idTorneo;
    }
    public function getIdEquipo(): ?int {
        return $this->idEquipo;
    }
    public function getIdInscripcion(): ?int {
        return $this->idInscripcion;
    }
    
}
?>