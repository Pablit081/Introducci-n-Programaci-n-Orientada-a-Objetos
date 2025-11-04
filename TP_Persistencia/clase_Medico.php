<?php

use Medoo\Medoo;

class Medico
{
    private $bd;
    private $id;
    private $nombre;
    private $apellido;
    private $dni;
    private $especialidad;

    public function __construct(Medoo $bd, $id, $nombre, $apellido, $dni, $especialidad)
    {
        $this->bd = $bd;
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->especialidad = $especialidad;
    }

    public function guardar()
    {
        $this->bd->insert('medicos', [
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'especialidad' => $this->especialidad
        ]);
    }
}
