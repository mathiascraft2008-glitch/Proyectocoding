<?php
class Formato {
    private string $nombre;
    private bool $activo;

    public function __construct(string $nombre,bool $activo){
        $this->nombre = $nombre;
        $this->activo = $activo;
    }

    public function getNombre(): string {
        return $this->nombre;
    }
    public function getActivo(): bool {
        return $this->activo;
    }
    public function setActivo(bool $activo): void {
        $this->activo=$activo;
    }
}
?>