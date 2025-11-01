<?php

require_once 'Clase_Barco.php';

/**
 * Clase que representa una Embarcación Deportiva a motor.
 */
class Deportivo extends Barco
{
    private float $potenciaCV;

    public function __construct(string $matricula, float $eslora, int $anioFabricacion, float $potenciaCV)
    {
        parent::__construct($matricula, $eslora, $anioFabricacion);
        $this->potenciaCV = $potenciaCV;
    }

    /**
     * {@inheritdoc}
     * El módulo es (eslora * 10) + potencia en CV.
     */
    public function calcularModulo(): float
    {
        return ($this->eslora * 10) + $this->potenciaCV;
    }

    public function __toString(): string
    {
        return "Deportivo -> " . parent::__toString() . ", Potencia: " . $this->potenciaCV . " CV";
    }
}
