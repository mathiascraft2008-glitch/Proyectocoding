<?php

class Usuario {

    private ?int $id;
    private string $nombre;
    private string $mail;
    private string $contrasena;
    private string $rol;
    private bool $activo;

    public function __construct(?int $id,string $nombre,string $mail,string $contrasena,string $rol,bool $activo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->contrasena = $contrasena;
        $this->rol = $rol;
        $this->activo = $activo;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getMail(): string {
        return $this->mail;
    }

    public function getContrasena(): string {
        return $this->contrasena;
    }

    public function getRol(): string {
        return $this->rol;
    }

    public function getActivo(): bool {
        return $this->activo;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setMail(string $mail): void {
        $this->mail = $mail;
    }

    public function setContrasena(string $contrasena): void {
        $this->contrasena = $contrasena;
    }

}