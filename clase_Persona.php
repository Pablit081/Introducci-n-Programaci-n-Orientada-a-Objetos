<?php

// Una persona puede leer libros, por lo que incluimos la definición de la clase Libro.
include_once 'clase_Libro.php';

/**
 * Clase que representa a una Persona con sus datos de identificación y lecturas.
 */
class Persona
{
    private string $nombre;
    private string $apellido;
    private string $tipoDocumento;
    private string $numeroDocumento;
    /** @var Libro[] Almacena los libros que la persona ha leído. */
    private array $librosLeidos;

    /**
     * Método constructor que recibe como parámetros los valores iniciales para los atributos de la clase.
     */
    public function __construct(string $nombre, string $apellido, string $tipoDocumento, string $numeroDocumento)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->tipoDocumento = $tipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
        $this->librosLeidos = []; // Se inicializa como un array vacío.
    }

    // --- Métodos de acceso (Getters) ---

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getTipoDocumento(): string
    {
        return $this->tipoDocumento;
    }

    public function getNumeroDocumento(): string
    {
        return $this->numeroDocumento;
    }

    public function getLibrosLeidos(): array
    {
        return $this->librosLeidos;
    }

    // --- Métodos de la clase ---

    /**
     * Agrega un libro a la colección de libros leídos por la persona.
     * @param Libro $libro
     */
    public function agregarLibroLeido(Libro $libro): void
    {
        $this->librosLeidos[] = $libro;
    }

    /**
     * Retorna true si el libro cuyo título recibido por parámetro se encuentra dentro del conjunto de libros leídos.
     * @param string $titulo El título del libro a buscar.
     * @return bool
     */
    public function libroLeido(string $titulo): bool
    {
        $encontrado = false;
        foreach ($this->librosLeidos as $libro) {
            if (strtolower($libro->getTitulo()) === strtolower($titulo)) {
                $encontrado = true;
                break; // Si lo encontramos, no es necesario seguir buscando.
            }
        }
        return $encontrado;
    }

    /**
     * Retorna la sinopsis del libro cuyo título se recibe por parámetro.
     * @param string $titulo El título del libro a buscar.
     * @return string La sinopsis o un mensaje si no se encuentra.
     */
    public function darSinopsis(string $titulo): string
    {
        $sinopsis = "El libro '" . $titulo . "' no ha sido leído por esta persona.";
        foreach ($this->librosLeidos as $libro) {
            if (strtolower($libro->getTitulo()) === strtolower($titulo)) {
                $sinopsis = $libro->getSinopsis();
                break;
            }
        }
        return $sinopsis;
    }

    /**
     * Retorna todos aquellos libros que fueron leídos y su año de edición es un año X.
     * @param int $x El año de edición a buscar.
     * @return Libro[] Un array con los libros que coinciden.
     */
    public function leidosAnioEdicion(int $x): array
    {
        $librosDelAnio = [];
        foreach ($this->librosLeidos as $libro) {
            if ($libro->getAnioEdicion() === $x) {
                $librosDelAnio[] = $libro;
            }
        }
        return $librosDelAnio;
    }

    /**
     * Retorna todos aquellos libros leídos cuyo autor coincide con el nombre y apellido recibidos.
     * @param string $nombreAutor El nombre del autor.
     * @param string $apellidoAutor El apellido del autor.
     * @return Libro[] Un array con los libros que coinciden.
     */
    public function darLibrosPorAutor(string $nombreAutor, string $apellidoAutor): array
    {
        $librosDelAutor = [];
        foreach ($this->librosLeidos as $libro) {
            if ($libro->getAutor()->getNombre() === $nombreAutor && $libro->getAutor()->getApellido() === $apellidoAutor) {
                $librosDelAutor[] = $libro;
            }
        }
        return $librosDelAutor;
    }

    /**
     * Redefinir el método __toString() para que retorne la información de los atributos de la clase.
     * @return string
     */
    public function __toString(): string
    {
        $info = "Nombre Completo: " . $this->getNombre() . " " . $this->getApellido() . "\n";
        $info .= "Documento: " . $this->getTipoDocumento() . " " . $this->getNumeroDocumento() . "\n";
        $info .= "Libros Leídos: " . count($this->librosLeidos);
        return $info;
    }
}
