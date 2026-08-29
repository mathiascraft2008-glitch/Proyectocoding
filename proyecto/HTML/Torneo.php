<?php

class Torneo {
    //id puede ser null porque en la bdd es auto increment
    private ?int $id;
    private int $idOrganizador;
    private string $nombre;
    private string $fecha;
    private string $formato;
    private string $disciplina;
    private string $lugar;
    private string $participacion;
    private string $contrasena;

    public function __construct(?int $id,int $idOrganizador,string $nombre,string $fecha,string $formato,string $disciplina,string $lugar,string $participacion,string $contrasena){
        $this->id = $id;
        $this->idOrganizador = $idOrganizador;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->formato = $formato;
        $this->disciplina = $disciplina;
        $this->lugar = $lugar;
        $this->participacion = $participacion;
        $this->contrasena = $contrasena;
    }
    public function getId(): ?int {
        return $this->id;
    }

    public function getIdOrganizador(): int {
        return $this->idOrganizador;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getFecha(): string {
        return $this->fecha;
    }

    public function getFormato(): string {
        return $this->formato;
    }

    public function getDisciplina(): string {
        return $this->disciplina;
    }

    public function getLugar(): string {
        return $this->lugar;
    }

    public function getParticipacion(): string {
        return $this->participacion;
    }

    public function getContrasena(): string {
        return $this->contrasena;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

}