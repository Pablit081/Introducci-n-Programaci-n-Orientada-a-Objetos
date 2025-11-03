<?php

include_once 'clase_Persona.php';

/**
 * Clase que representa una Disquera con su horario de atención y dueño.
 */
class Disquera
{
    private int $hora_desde;
    private int $hora_hasta;
    private string $estado; // 'abierta' o 'cerrada'
    private string $direccion;
    private Persona $dueño;

    /**
     * Método constructor que recibe como parámetros los valores iniciales para los atributos de la clase.
     * La disquera siempre se crea en estado 'cerrada'.
     */
    public function __construct(int $hora_desde, int $hora_hasta, string $direccion, Persona $dueño)
    {
        $this->hora_desde = $hora_desde;
        $this->hora_hasta = $hora_hasta;
        $this->estado = 'cerrada';
        $this->direccion = $direccion;
        $this->dueño = $dueño;
    }

    // --- Métodos de acceso (Getters) ---

    public function getHoraDesde(): int
    {
        return $this->hora_desde;
    }

    public function getHoraHasta(): int
    {
        return $this->hora_hasta;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function getDueño(): Persona
    {
        return $this->dueño;
    }

    /**
     * Dada una hora y minutos, retorna true si la tienda debe encontrarse abierta.
     * @param int $hora
     * @param int $minutos
     * @return bool
     */
    public function dentroHorarioAtencion(int $hora, int $minutos): bool
    {
        return $hora >= $this->hora_desde && $hora < $this->hora_hasta;
    }

    /**
     * Cambia el estado de la disquera a 'abierta' solo si es un horario válido.
     * @param int $hora
     * @param int $minutos
     */
    public function abrirDisquera(int $hora, int $minutos): void
    {
        if ($this->dentroHorarioAtencion($hora, $minutos)) {
            $this->estado = 'abierta';
        }
    }

    /**
     * Cambia el estado de la disquera a 'cerrada' solo si es un horario válido para su cierre.
     * @param int $hora
     * @param int $minutos
     */
    public function cerrarDisquera(int $hora, int $minutos): void
    {
        if (!$this->dentroHorarioAtencion($hora, $minutos)) {
            $this->estado = 'cerrada';
        }
    }

    /**
     * Redefinir el método __toString() para que retorne la información de los atributos de la clase.
     * @return string
     */
    public function __toString(): string
    {
        $dueño = $this->getDueño();
        return sprintf(
            "Disquera en %s\nDueño: %s %s\nHorario: de %d:00 a %d:00\nEstado: %s",
            $this->getDireccion(),
            $dueño->getNombre(),
            $dueño->getApellido(),
            $this->getHoraDesde(),
            $this->getHoraHasta(),
            strtoupper($this->getEstado())
        );
    }
}
