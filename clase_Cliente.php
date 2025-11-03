<?php

/**
 * Clase base abstracta que representa a una Persona.
 * Contiene información fundamental como DNI, nombre y apellido.
 */
abstract class Persona
{
    protected $dni;
    protected $nombre;
    protected $apellido;

    /**
     * Constructor de la clase Persona.
     * @param string $dni
     * @param string $nombre
     * @param string $apellido
     */
    public function __construct($dni, $nombre, $apellido)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    // Métodos de acceso (getters)
    public function getDni()
    {
        return $this->dni;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Devuelve una representación en cadena de los datos de la persona.
     * @return string
     */
    public function __toString()
    {
        return "Nombre: " . $this->nombre . " " . $this->apellido . "\n" .
            "DNI: " . $this->dni;
    }
}

/**
 * Clase Cliente que hereda de Persona.
 * Añade información específica de un cliente, como su número de cliente.
 */
class Cliente extends Persona
{
    // Propiedad estática para llevar la cuenta del siguiente número de cliente.
    private static $siguienteNroCliente = 1;
    private $nroCliente;

    public function __construct($dni, $nombre, $apellido)
    {
        // 1. Llama al constructor de la clase padre (Persona) para inicializar sus atributos.
        parent::__construct($dni, $nombre, $apellido);
        // 2. Asigna el número de cliente actual y luego lo incrementa para el próximo.
        $this->nroCliente = self::$siguienteNroCliente++;
    }

    public function getNroCliente()
    {
        return $this->nroCliente;
    }

    public function __toString()
    {
        // Reutiliza el __toString() del padre y le añade la información del cliente.
        return "--- Ficha del Cliente ---\n" .
            "Nro. Cliente: " . $this->nroCliente . "\n" .
            parent::__toString();
    }
}
