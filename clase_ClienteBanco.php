<?php

/**
 * Clase que representa a un Cliente del banco.
 */
class ClienteBanco
{
    private string $nombre;

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    // --- Métodos de acceso ---
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function __toString(): string
    {
        return "Cliente: " . $this->nombre;
    }
}
