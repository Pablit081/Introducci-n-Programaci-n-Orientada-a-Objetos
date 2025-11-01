<?php

include_once 'clase_Libro.php';

/**
 * Clase que almacena información sobre la lectura de un determinado libro.
 */
class Lectura
{
    /** @var Libro El libro que se está leyendo. */
    private Libro $libro;
    /** @var int El número de la página actual. */
    private int $paginaActual;

    /**
     * Método constructor que recibe como parámetros los valores iniciales para los atributos de la clase.
     * @param Libro $libro El objeto Libro.
     * @param int $paginaInicial La página donde se inicia la lectura (por defecto 1).
     */
    public function __construct(Libro $libro, int $paginaInicial = 1)
    {
        $this->libro = $libro;
        // Valida que la página inicial esté dentro de los límites del libro.
        if ($paginaInicial > 0 && $paginaInicial <= $libro->getCantidadPaginas()) {
            $this->paginaActual = $paginaInicial;
        } else {
            $this->paginaActual = 1; // Si no es válida, se empieza por la 1.
        }
    }

    // --- Métodos de acceso (Getters) ---

    public function getLibro(): Libro
    {
        return $this->libro;
    }

    public function getPaginaActual(): int
    {
        return $this->paginaActual;
    }

    /**
     * Avanza a la siguiente página del libro y actualiza la variable.
     * @return int El nuevo número de página.
     */
    public function siguientePagina(): int
    {
        if ($this->paginaActual < $this->libro->getCantidadPaginas()) {
            $this->paginaActual++;
        }
        return $this->paginaActual;
    }

    /**
     * Retrocede a la página anterior del libro y actualiza la variable.
     * @return int El nuevo número de página.
     */
    public function retrocederPagina(): int
    {
        if ($this->paginaActual > 1) {
            $this->paginaActual--;
        }
        return $this->paginaActual;
    }

    /**
     * Va a una página específica y retorna la página en la que se estaba.
     * @param int $x La página a la que se quiere ir.
     * @return int La página actual antes del cambio.
     */
    public function irPagina(int $x): int
    {
        $paginaAnterior = $this->paginaActual;
        if ($x > 0 && $x <= $this->libro->getCantidadPaginas()) {
            $this->paginaActual = $x;
        }
        return $paginaAnterior;
    }

    public function __toString(): string
    {
        return sprintf(
            "Estás leyendo '%s'.\nActualmente en la página %d de %d.",
            $this->getLibro()->getTitulo(),
            $this->getPaginaActual(),
            $this->getLibro()->getCantidadPaginas()
        );
    }
}
