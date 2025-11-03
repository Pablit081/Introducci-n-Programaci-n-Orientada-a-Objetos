<?php

include_once 'clase_Funcion.php';

/**
 * Clase que modela un Teatro.
 * Un teatro tiene un nombre, una dirección y 4 funciones diarias.
 */
class Teatro
{
    private string $nombre;
    private string $direccion;
    /** @var Funcion[] Colección de objetos Funcion. */
    private array $funciones = [];

    /**
     * Constructor de la clase Teatro.
     */
    public function __construct(string $nombre, string $direccion)
    {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
    }

    // --- Métodos de Acceso (Getters) ---
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function getFunciones(): array
    {
        return $this->funciones;
    }

    // --- Métodos para cambiar los datos del Teatro (Setters) ---

    /**
     * Cambia el nombre del teatro.
     * @param string $nuevoNombre
     */
    public function setNombre(string $nuevoNombre): void
    {
        $this->nombre = $nuevoNombre;
    }

    /**
     * Cambia la dirección del teatro.
     * @param string $nuevaDireccion
     */
    public function setDireccion(string $nuevaDireccion): void
    {
        $this->direccion = $nuevaDireccion;
    }

    // --- Métodos para cambiar los datos de las Funciones ---

    /**
     * Agrega una nueva función a la colección del teatro, verificando que no haya solapamiento de horarios.
     * @param Funcion $nuevaFuncion El objeto Funcion a agregar.
     * @return bool True si se agregó con éxito, false si hay solapamiento.
     */
    public function agregarFuncion(Funcion $nuevaFuncion): bool
    {
        $seSolapa = false;
        $inicioNueva = $nuevaFuncion->getHorarioInicio();
        $finNueva = $nuevaFuncion->getHorarioFin();

        foreach ($this->funciones as $funcionExistente) {
            $inicioExistente = $funcionExistente->getHorarioInicio();
            $finExistente = $funcionExistente->getHorarioFin();

            // La condición de solapamiento es: (InicioA < FinB) y (FinA > InicioB)
            if ($inicioNueva < $finExistente && $finNueva > $inicioExistente) {
                $seSolapa = true;
                break;
            }
        }

        if (!$seSolapa) {
            $this->funciones[] = $nuevaFuncion;
            // Opcional: ordenar las funciones por horario
            usort($this->funciones, function ($a, $b) {
                return $a->getHorarioInicio() <=> $b->getHorarioInicio();
            });
            return true;
        }

        return false;
    }

    /**
     * Cambia el nombre de una función específica.
     * @param int $numeroFuncion El número de la función en la lista (desde 1).
     * @param string $nuevoNombre El nuevo nombre para la función.
     * @return bool Devuelve true si el cambio fue exitoso, false si el número de función no es válido.
     */
    public function cambiarNombreFuncion(int $numeroFuncion, string $nuevoNombre): bool
    {
        $indice = $numeroFuncion - 1;
        if (isset($this->funciones[$indice])) {
            $this->funciones[$indice]->setNombre($nuevoNombre);
            return true;
        }
        return false;
    }

    /**
     * Cambia el precio de una función específica.
     * @param int $numeroFuncion El número de la función en la lista (desde 1).
     * @param float $nuevoPrecio El nuevo precio para la función.
     * @return bool Devuelve true si el cambio fue exitoso, false si el número de función no es válido.
     */
    public function cambiarPrecioFuncion(int $numeroFuncion, float $nuevoPrecio): bool
    {
        $indice = $numeroFuncion - 1;
        if (isset($this->funciones[$indice])) {
            $this->funciones[$indice]->setPrecio($nuevoPrecio);
            return true;
        }
        return false;
    }

    /**
     * Devuelve una representación en cadena de los datos del teatro y sus funciones.
     */
    public function __toString(): string
    {
        $info = "--- Teatro: " . $this->getNombre() . " ---\n";
        $info .= "Dirección: " . $this->getDireccion() . "\n";
        $info .= "--- Funciones del Día ---\n";

        if (empty($this->funciones)) {
            $info .= "No hay funciones cargadas.\n";
        } else {
            // Recorremos el array de funciones para mostrarlas
            foreach ($this->getFunciones() as $index => $funcion) {
                $num = $index + 1;
                $info .= $num . ". " . $funcion . "\n";
            }
        }
        return $info;
    }
}
