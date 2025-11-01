<?php

/**
 * Clase que modela una Línea en un plano 2D.
 * Una línea se define por dos puntos distintos, puntoA y puntoB.
 * Cada punto es un arreglo asociativo con claves 'x' e 'y'.
 */
class Linea
{
    /** @var array Punto de inicio de la línea. Ej: ['x' => 1, 'y' => 2] */
    private $puntoA;
    /** @var array Punto final de la línea. Ej: ['x' => 3, 'y' => 4] */
    private $puntoB;

    /**
     * Método constructor que recibe como parámetros las coordenadas de los dos puntos.
     *
     * @param array $pA Coordenadas del primer punto (x, y).
     * @param array $pB Coordenadas del segundo punto (x, y).
     */
    public function __construct(array $pA, array $pB)
    {
        $this->puntoA = $pA;
        $this->puntoB = $pB;
    }

    // --- Métodos de Acceso (Getters y Setters) ---

    /** @return array */
    public function getPuntoA(): array
    {
        return $this->puntoA;
    }

    /** @param array $puntoA */
    public function setPuntoA(array $puntoA): void
    {
        $this->puntoA = $puntoA;
    }

    /** @return array */
    public function getPuntoB(): array
    {
        return $this->puntoB;
    }

    /** @param array $puntoB */
    public function setPuntoB(array $puntoB): void
    {
        $this->puntoB = $puntoB;
    }

    /**
     * Redefinición del método __toString para mostrar la información de la línea.
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "Línea definida por los puntos: A(X: %s, Y: %s) y B(X: %s, Y: %s)",
            $this->puntoA['x'],
            $this->puntoA['y'],
            $this->puntoB['x'],
            $this->puntoB['y']
        );
    }

    /**
     * Desplaza la línea a la derecha de la distancia indicada.
     *
     * @param float $d Distancia a desplazar.
     */
    public function mueveDerecha(float $d): void
    {
        $this->puntoA['x'] += $d;
        $this->puntoB['x'] += $d;
    }

    /**
     * Desplaza la línea a la izquierda de la distancia indicada.
     *
     * @param float $d Distancia a desplazar.
     */
    public function mueveIzquierda(float $d): void
    {
        $this->puntoA['x'] -= $d;
        $this->puntoB['x'] -= $d;
    }

    /**
     * Desplaza la línea hacia arriba de la distancia indicada.
     *
     * @param float $d Distancia a desplazar.
     */
    public function mueveArriba(float $d): void
    {
        $this->puntoA['y'] += $d;
        $this->puntoB['y'] += $d;
    }

    /**
     * Desplaza la línea hacia abajo de la distancia indicada.
     *
     * @param float $d Distancia a desplazar.
     */
    public function mueveAbajo(float $d): void
    {
        $this->puntoA['y'] -= $d;
        $this->puntoB['y'] -= $d;
    }
}
