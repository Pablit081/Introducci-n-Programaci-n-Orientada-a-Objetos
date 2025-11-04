<?php

use Medoo\Medoo;

class Paciente
{
    private $bd;
    private $id;
    private $nombre;
    private $apellido;
    private $dni;
    private $obra_social;

    public function __construct(Medoo $bd, $id, $nombre, $apellido, $dni, $obra_social)
    {
        $this->bd = $bd;
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->obra_social = $obra_social;
    }

    public function guardar()
    {
        $this->bd->insert('pacientes', [
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'obrasocial' => $this->obra_social
        ]);
    }
}