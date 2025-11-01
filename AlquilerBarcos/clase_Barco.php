<?php

/**
 * Clase abstracta que representa un Barco genérico.
 * Contiene los atributos y métodos comunes a todos los tipos de barcos.
 */
abstract class Barco
{
    protected string $matricula;
    protected float $eslora;
    protected int $anioFabricacion;

    public function __construct(string $matricula, float $eslora, int $anioFabricacion)
    {
        $this->matricula = $matricula;
        $this->eslora = $eslora;
        $this->anioFabricacion = $anioFabricacion;
    }

    // --- Getters ---
    public function getMatricula(): string
    {
        return $this->matricula;
    }

    public function getEslora(): float
    {
        return $this->eslora;
    }

    public function getAnioFabricacion(): int
    {
        return $this->anioFabricacion;
    }

    /**
     * Método abstracto para calcular el módulo del barco.
     * Cada clase hija DEBE implementar este método con su propia fórmula.
     * @return float
     */
    abstract public function calcularModulo(): float;

    public function __toString(): string
    {
        return sprintf("Matrícula: %s, Eslora: %.2f mts, Año: %d", $this->matricula, $this->eslora, $this->anioFabricacion);
    }
}
