<?php

/**
 * Clase que modela un Cuadrado a través de sus cuatro vértices.
 * Cada vértice es un arreglo asociativo con claves 'x' e 'y'.
 */
class Cuadrado
{
    /** @var array Vértice 1 del cuadrado, ej: ['x' => 0, 'y' => 0] */
    private $vertice1;
    /** @var array Vértice 2 del cuadrado */
    private $vertice2;
    /** @var array Vértice 3 del cuadrado */
    private $vertice3;
    /** @var array Vértice 4 del cuadrado */
    private $vertice4;

    /**
     * a) Método constructor que recibe como parámetros las coordenadas de los puntos.
     * @param array $v1 Coordenadas del primer vértice.
     * @param array $v2 Coordenadas del segundo vértice.
     * @param array $v3 Coordenadas del tercer vértice.
     * @param array $v4 Coordenadas del cuarto vértice.
     */
    public function __construct(array $v1, array $v2, array $v3, array $v4)
    {
        $this->vertice1 = $v1;
        $this->vertice2 = $v2;
        $this->vertice3 = $v3;
        $this->vertice4 = $v4;
    }

    /**
     * b) Métodos de acceso (getters) para cada uno de los atributos de la clase.
     */

    /** @return array */
    public function getVertice1(): array
    {
        return $this->vertice1;
    }

    /** @return array */
    public function getVertice2(): array
    {
        return $this->vertice2;
    }

    /** @return array */
    public function getVertice3(): array
    {
        return $this->vertice3;
    }

    /** @return array */
    public function getVertice4(): array
    {
        return $this->vertice4;
    }

    /**
     * c) Calcula el área del cuadrado.
     * Se asume que los vértices 1 y 2 definen un lado.
     * @return float
     */
    public function area(): float
    {
        // Distancia al cuadrado entre vertice1 y vertice2.
        // pow(x2-x1, 2) + pow(y2-y1, 2)
        $ladoAlCuadrado = pow($this->vertice2['x'] - $this->vertice1['x'], 2) + pow($this->vertice2['y'] - $this->vertice1['y'], 2);
        return $ladoAlCuadrado;
    }

    /**
     * d) Desplaza el cuadrado en el plano.
     * @param array $d Un punto asociativo ['x' => dx, 'y' => dy] que indica el desplazamiento.
     */
    public function desplazar(array $d)
    {
        // Suma el desplazamiento a cada coordenada de cada vértice.
        $this->vertice1['x'] += $d['x'];
        $this->vertice1['y'] += $d['y'];

        $this->vertice2['x'] += $d['x'];
        $this->vertice2['y'] += $d['y'];

        $this->vertice3['x'] += $d['x'];
        $this->vertice3['y'] += $d['y'];

        $this->vertice4['x'] += $d['x'];
        $this->vertice4['y'] += $d['y'];
    }

    /**
     * e) Aumenta el tamaño del cuadrado.
     * Se asume que el cuadrado está alineado con los ejes y que el vértice 1 es el inferior izquierdo.
     * @param float $t El tamaño que debe aumentar el lado.
     */
    public function aumentarTamaño(float $t)
    {
        // Mantenemos el vértice 1 (inferior-izquierdo) fijo.
        // Aumentamos las coordenadas de los otros vértices en 't'.

        // Vértice 2 (inferior-derecho) se mueve a la derecha.
        $this->vertice2['x'] += $t;

        // Vértice 3 (superior-derecho) se mueve a la derecha y hacia arriba.
        $this->vertice3['x'] += $t;
        $this->vertice3['y'] += $t;

        // Vértice 4 (superior-izquierdo) se mueve hacia arriba.
        $this->vertice4['y'] += $t;
    }

    /**
     * f) Redefinición del método __toString para mostrar la información del cuadrado.
     * @return string
     */
    public function __toString(): string
    {
        // Usamos sprintf para formatear la salida de manera ordenada.
        return sprintf(
            "Cuadrado con vértices:\n" .
            "  V1: (X: %s, Y: %s)\n" .
            "  V2: (X: %s, Y: %s)\n" .
            "  V3: (X: %s, Y: %s)\n" .
            "  V4: (X: %s, Y: %s)",
            $this->vertice1['x'], $this->vertice1['y'], $this->vertice2['x'], $this->vertice2['y'], $this->vertice3['x'], $this->vertice3['y'], $this->vertice4['x'], $this->vertice4['y']
        );
    }
}
