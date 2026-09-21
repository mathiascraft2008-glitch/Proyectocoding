<?php
class Partidos {
    private ?int $id;
    private int $numero;
    private ?int $competidor1;
    private ?int $competidor2;
    private int $idRonda;
    private ?int $idGanador; 
    private ?bool $empate;

    public function __construct(?int $id, int $numero,  int $idRonda, ?int $competidor1, ?int $competidor2, ?int $idGanador,?bool $empate=null) {
        $this->id = $id;
        $this->numero = $numero;
        $this->competidor1 = $competidor1;
        $this->competidor2 = $competidor2;
        $this->idRonda = $idRonda;
        $this->idGanador = $idGanador;
        $this->empate = $empate;
    }


    public function getId(): ?int {
        return $this->id;
    }

    public function getNumero(): int {
        return $this->numero;
    }

    public function getCompetidor1(): ?int {
        return $this->competidor1;
    }

    public function getCompetidor2(): ?int {
        return $this->competidor2;
    }

    public function getIdRonda(): int {
        return $this->idRonda;
    }

    public function getIdGanador(): ?int {
        return $this->idGanador;
    }

    public function getEmpate(): ?bool {
        return $this->empate;
    }
}
?>