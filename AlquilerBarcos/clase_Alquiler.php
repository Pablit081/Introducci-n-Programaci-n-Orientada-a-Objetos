<?php

require_once 'clase_Barco.php';
require_once 'clase_Cliente.php'; // Incluimos la nueva clase Cliente

/**
 * Clase que representa el alquiler de un amarre para un barco.
 */
class Alquiler
{
    private Cliente $cliente; // Ahora es un objeto Cliente
    private int $diasOcupacion;
    private string $posicionAmarre;
    private Barco $barco; // ¡Importante! El tipo es la clase base Barco
    private float $valorFijo = 8000.0;

    public function __construct(Cliente $cliente, int $diasOcupacion, string $posicionAmarre, Barco $barco)
    {
        $this->cliente = $cliente;
        $this->diasOcupacion = $diasOcupacion;
        $this->posicionAmarre = $posicionAmarre;
        $this->barco = $barco;
    }

    /**
     * Calcula el precio final del alquiler.
     * La fórmula es: dias * modulo_del_barco * valor_fijo
     * @return float
     */
    public function calcularPrecioAlquiler(): float
    {
        $modulo = $this->barco->calcularModulo();
        return $this->diasOcupacion * $modulo * $this->valorFijo;
    }

    public function __toString(): string
    {
        $precioFinal = $this->calcularPrecioAlquiler();
        $info = "--- Ficha de Alquiler ---\n";
        $info .= "Cliente: " . $this->cliente . "\n"; // Usa el __toString() de la clase Cliente
        $info .= "Posición de Amarre: " . $this->posicionAmarre . "\n";
        $info .= "Días de Ocupación: " . $this->diasOcupacion . "\n";
        $info .= "Barco: " . $this->barco . "\n"; // Llama al __toString() del barco específico
        $info .= "Módulo del Barco: " . $this->barco->calcularModulo() . "\n";
        $info .= "PRECIO FINAL: $" . number_format($precioFinal, 2, ',', '.') . "\n";
        $info .= "---------------------------\n";
        return $info;
    }
}
