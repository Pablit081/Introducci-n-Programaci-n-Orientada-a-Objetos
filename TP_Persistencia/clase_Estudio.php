<?php

use Medoo\Medoo;

class Estudio
{
    private $bd;
    private $id;
    private $nombre_estudio;
    private $observaciones;
    private $id_medico;
    private $id_paciente;

    public function __construct($bd, $id, $nombre_estudio, $observaciones, $id_medico, $id_paciente)
    {
        $this->bd = $bd;
        $this->id = $id;
        $this->nombre_estudio = $nombre_estudio;
        $this->observaciones = $observaciones;
        $this->id_medico = $id_medico;
        $this->id_paciente = $id_paciente;
    }

    public function guardar()
    {
        $this->bd->insert('estudios', [
            'nombreestudio' => $this->nombre_estudio,
            'observaciones' => $this->observaciones,
            'id_medico' => $this->id_medico,
            'id_paciente' => $this->id_paciente
        ]);
    }
}