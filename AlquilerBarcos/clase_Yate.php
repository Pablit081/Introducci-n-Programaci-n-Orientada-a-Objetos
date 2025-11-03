<?php

require_once 'Clase_Barco.php';

/**
 * Clase que representa un Yate de lujo.
 */
class Yate extends Barco
{
    private float $potenciaCV;
    private int $numeroCamarotes;

    public function __construct(string $matricula, float $eslora, int $anioFabricacion, float $potenciaCV, int $numeroCamarotes)
    {
        parent::__construct($matricula, $eslora, $anioFabricacion);
        $this->potenciaCV = $potenciaCV;
        $this->numeroCamarotes = $numeroCamarotes;
    }

    /**
     * {@inheritdoc}
     * El módulo es (eslora * 10) + potencia en CV + número de camarotes.
     */
    public function calcularModulo(): float
    {
        return ($this->eslora * 10) + $this->potenciaCV + $this->numeroCamarotes;
    }

    public function __toString(): string
    {
        return "Yate -> " . parent::__toString() . ", Potencia: " . $this->potenciaCV . " CV, Camarotes: " . $this->numeroCamarotes;
    }
}
