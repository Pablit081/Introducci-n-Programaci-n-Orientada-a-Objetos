<?php

include_once 'clase_ClienteBanco.php';

/**
 * Clase que representa un trámite a realizar.
 */
class Tramite
{
    private ClienteBanco $cliente;
    private string $tipo;
    private DateTime $fechaIngreso;
    private ?DateTime $fechaCierre;
    private string $estado; // 'abierto', 'cerrado'

    public function __construct(string $tipo, ClienteBanco $cliente)
    {
        $this->tipo = $tipo;
        $this->cliente = $cliente;
        $this->fechaIngreso = new DateTime(); // Se crea con la fecha y hora actual
        $this->fechaCierre = null;
        $this->estado = 'abierto';
    }

    // --- Métodos de acceso ---
    public function getCliente(): ClienteBanco
    {
        return $this->cliente;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getFechaIngreso(): DateTime
    {
        return $this->fechaIngreso;
    }

    public function getFechaCierre(): ?DateTime
    {
        return $this->fechaCierre;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    /**
     * Cierra el trámite, registrando la fecha y cambiando el estado.
     */
    public function cerrar(): void
    {
        if ($this->estado === 'abierto') {
            $this->fechaCierre = new DateTime();
            $this->estado = 'cerrado';
        }
    }

    public function __toString(): string
    {
        return sprintf(
            "Trámite de tipo '%s' para %s (Ingreso: %s)",
            $this->tipo,
            $this->cliente->getNombre(),
            $this->fechaIngreso->format('H:i:s')
        );
    }
}
