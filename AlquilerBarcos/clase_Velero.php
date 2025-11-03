<?php

require_once 'Clase_Barco.php';

/**
 * Clase que representa un Velero.
 */
class Velero extends Barco
{
    private int $numeroMastiles;

    public function __construct(string $matricula, float $eslora, int $anioFabricacion, int $numeroMastiles)
    {
        parent::__construct($matricula, $eslora, $anioFabricacion);
        $this->numeroMastiles = $numeroMastiles;
    }

    /**
     * {@inheritdoc}
     * El módulo es (eslora * 10) + número de mástiles.
     */
    public function calcularModulo(): float
    {
        return ($this->eslora * 10) + $this->numeroMastiles;
    }

    public function __toString(): string
    {
        return "Velero -> " . parent::__toString() . ", Mástiles: " . $this->numeroMastiles;
    }
}
