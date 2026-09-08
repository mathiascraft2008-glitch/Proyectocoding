<?php

class DobleFactor {

    private ?int $id;
    private int $idUsuario;
    private string $codigo;
    private string $expiracion;
    private int $intentos;

    public function __construct(?int $id,int $idUsuario,string $codigo,string $expiracion,int $intentos){
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->codigo = $codigo;
        $this->expiracion = $expiracion;
        $this->intentos = $intentos;
    }
    public function getId(): ?int{
        return $this->id;
    }

    public function getIdUsuario(): int{
        return $this->idUsuario;
    }

    public function getCodigo(): string{
        return $this->codigo;
    }

    public function getExpiracion(): string{
        return $this->expiracion;
    }

    public function getIntentos(): int{
        return $this->intentos;
    }

    public function setIntentos($intentos){
        $this->intentos = $intentos;
    }
}