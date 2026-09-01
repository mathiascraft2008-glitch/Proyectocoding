<?php
class Equipo {
    private ?int $id;
    private string $nombre;
    private int $idTorneo;

    public function __construct(?int $id,string $nombre,int $idTorneo){
        $this->nombre = $nombre;
        $this->id = $id;
        $this->idTorneo = $idTorneo;
    }

    public function getNombre(): string {
        return $this->nombre;
    }
    public function getId(): ?int {
        return $this->id;
    }
    public function getIdTorneo(): int {
        return $this->idTorneo;
    }
}
?>