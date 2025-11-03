<?php

/**
 * Clase que modela una Cafetera.
 */
class Cafetera
{
    /** @var float La cantidad máxima de café que puede contener (en ml). */
    private $capacidadMaxima;
    /** @var float La cantidad actual de café que hay (en ml). */
    private $cantidadActual;

    /**
     * a) Método constructor que recibe como parámetros los valores iniciales.
     *
     * @param float $capacidadMaxima La capacidad total de la cafetera.
     * @param float $cantidadActual La cantidad inicial de café (opcional, por defecto 0).
     */
    public function __construct(float $capacidadMaxima, float $cantidadActual = 0)
    {
        $this->capacidadMaxima = $capacidadMaxima;
        // Se asegura que la cantidad actual no supere la máxima al construir el objeto.
        $this->cantidadActual = min($capacidadMaxima, $cantidadActual);
    }

    // --- b) Métodos de Acceso (Getters y Setters) ---

    public function getCapacidadMaxima(): float
    {
        return $this->capacidadMaxima;
    }

    public function setCapacidadMaxima(float $capacidadMaxima): void
    {
        $this->capacidadMaxima = $capacidadMaxima;
        // Si la nueva capacidad es menor que la cantidad actual, se ajusta la cantidad actual.
        if ($this->cantidadActual > $this->capacidadMaxima) {
            $this->cantidadActual = $this->capacidadMaxima;
        }
    }

    public function getCantidadActual(): float
    {
        return $this->cantidadActual;
    }

    public function setCantidadActual(float $cantidadActual): void
    {
        // Limita la cantidad actual a la capacidad máxima.
        $this->cantidadActual = min($this->capacidadMaxima, $cantidadActual);
    }

    /**
     * c) Pone la cantidad actual de café al máximo de su capacidad.
     */
    public function llenarCafetera(): void
    {
        $this->cantidadActual = $this->capacidadMaxima;
    }

    /**
     * d) Simula la acción de servir una taza.
     *
     * @param float $cantidad La cantidad de café a servir.
     */
    public function servirTaza(float $cantidad): void
    {
        if ($this->cantidadActual >= $cantidad) {
            // Hay suficiente café, se sirve la taza completa.
            $this->cantidadActual -= $cantidad;
            echo "Se ha servido una taza de " . $cantidad . "ml.\n";
        } else {
            // No hay suficiente café, se sirve lo que queda.
            $servido = $this->cantidadActual;
            $this->vaciarCafetera(); // o $this->cantidadActual = 0;
            echo "No había suficiente café. Se sirvió lo que quedaba: " . $servido . "ml.\n";
        }
    }

    /**
     * e) Pone la cantidad de café actual en cero.
     */
    public function vaciarCafetera(): void
    {
        $this->cantidadActual = 0;
    }

    /**
     * f) Añade a la cafetera la cantidad de café indicada.
     *
     * @param float $cantidad La cantidad de café a agregar.
     */
    public function agregarCafe(float $cantidad): void
    {
        $this->cantidadActual += $cantidad;
        // Si se supera la capacidad máxima, la cantidad actual se ajusta al máximo.
        if ($this->cantidadActual > $this->capacidadMaxima) {
            $this->cantidadActual = $this->capacidadMaxima;
            echo "Se llenó la cafetera y el resto se derramó.\n";
        } else {
            echo "Se agregaron " . $cantidad . "ml de café.\n";
        }
    }

    /**
     * g) Redefinición del método __toString para mostrar la información de la cafetera.
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "Cafetera con capacidad para %.2f ml, actualmente con %.2f ml.",
            $this->capacidadMaxima,
            $this->cantidadActual
        );
    }
}
