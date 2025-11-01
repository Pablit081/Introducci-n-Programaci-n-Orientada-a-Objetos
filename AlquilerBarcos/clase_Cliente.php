<?php

/**
 * Clase que representa a un Cliente con su nombre y DNI.
 */
class Cliente
{
    private string $nombre;
    private string $dni;

    public function __construct(string $nombre, string $dni)
    {
        $this->nombre = $nombre;
        $this->dni = $dni;
    }

    // --- Getters ---
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    // --- Setters (opcionales, si se permite modificar el nombre/DNI después de la creación) ---
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setDni(string $dni): void
    {
        $this->dni = $dni;
    }

    public function __toString(): string
    {
        return $this->nombre . " (DNI: " . $this->dni . ")";
    }
}
