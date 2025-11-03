<?php

include_once 'clase_Persona.php';

/**
 * Clase que representa un Libro con sus datos principales.
 */
class Libro
{
    private string $isbn;
    private string $titulo;
    private int $anioEdicion;
    private string $editorial;
    private Persona $autor; // Referencia a un objeto Persona
    private int $cantidadPaginas;
    private string $sinopsis;

    /**
     * Método constructor que recibe como parámetros los valores iniciales para los atributos de la clase.
     */
    public function __construct(string $isbn, string $titulo, int $anioEdicion, string $editorial, Persona $autor, int $cantidadPaginas, string $sinopsis)
    {
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->anioEdicion = $anioEdicion;
        $this->editorial = $editorial;
        $this->autor = $autor;
        $this->cantidadPaginas = $cantidadPaginas;
        $this->sinopsis = $sinopsis;
    }

    // --- Métodos de acceso (Getters) ---

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getAnioEdicion(): int
    {
        return $this->anioEdicion;
    }

    public function getEditorial(): string
    {
        return $this->editorial;
    }

    public function getAutor(): Persona
    {
        return $this->autor;
    }

    public function getCantidadPaginas(): int
    {
        return $this->cantidadPaginas;
    }

    public function getSinopsis(): string
    {
        return $this->sinopsis;
    }

    /**
     * Método toString() que retorna la información de los atributos de la clase.
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "Título: %s\nAutor: %s, %s\nEditorial: %s\nAño: %d\nPáginas: %d\nISBN: %s\nSinopsis: %s",
            $this->getTitulo(),
            $this->getAutor()->getApellido(),
            $this->getAutor()->getNombre(),
            $this->getEditorial(),
            $this->getAnioEdicion(),
            $this->getCantidadPaginas(),
            $this->getIsbn(),
            $this->getSinopsis()
        );
    }

    /**
     * Indica si el libro pertenece a una editorial dada.
     * @param string $peditorial La editorial a verificar.
     * @return bool Verdadero si pertenece, falso en caso contrario.
     */
    public function perteneceEditorial(string $peditorial): bool
    {
        return $this->getEditorial() === $peditorial;
    }

    /**
     * Retorna los años que han pasado desde que el libro fue editado.
     * @return int
     */
    public function aniosdesdeEdicion(): int
    {
        $anioActual = date('Y'); // Obtiene el año actual
        return $anioActual - $this->getAnioEdicion();
    }
}
