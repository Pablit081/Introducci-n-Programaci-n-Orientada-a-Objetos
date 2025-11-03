<?php

/**
 * Clase que representa una función específica en un teatro.
 */
class Funcion
{
    private string $nombre;
    private DateTime $horarioInicio;
    private int $duracionObra; // en minutos
    private float $precio;

    public function __construct(string $nombre, string $horarioInicio, int $duracionObra, float $precio)
    {
        $this->nombre = $nombre;
        $this->horarioInicio = new DateTime($horarioInicio);
        $this->duracionObra = $duracionObra;
        $this->precio = $precio;
    }

    // --- Métodos de acceso ---

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getHorarioInicio(): DateTime
    {
        return $this->horarioInicio;
    }

    public function getDuracionObra(): int
    {
        return $this->duracionObra;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): void
    {
        if ($precio >= 0) {
            $this->precio = $precio;
        }
    }

    /**
     * Calcula y devuelve la hora de finalización de la función.
     * @return DateTime
     */
    public function getHorarioFin(): DateTime
    {
        // Clonamos el objeto de inicio para no modificarlo
        $horarioFin = clone $this->horarioInicio;
        $horarioFin->add(new DateInterval('PT' . $this->duracionObra . 'M'));
        return $horarioFin;
    }

    public function __toString(): string
    {
        return sprintf(
            "'%s' - Inicio: %s - Duración: %d min - Precio: $%s",
            $this->getNombre(),
            $this->getHorarioInicio()->format('H:i'),
            $this->getDuracionObra(),
            number_format($this->getPrecio(), 2, ',', '.')
        );
    }
}
