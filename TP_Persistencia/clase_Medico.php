<?php
// Inciso 3_Definición de la clase_Medico.php

use Medoo\Medoo;

class Medico
{
    private $bd;
    private $id;
    private $nombre;
    private $apellido;
    private $matricula;
    private $especialidad;

// 1. El constructor es el "proceso de bienvenida" de un nuevo objeto Medico.
// El primer parámetro "$bd" OBLIGA a que quien cree un Medico, le pase un traductor Medoo.
    public function __construct($bd, $id, $nombre, $apellido, $matricula, $especialidad)
    {
        $this->bd = $bd;
// 2. El objeto Medico toma el traductor que le pasaron ($bd) y lo guarda en su "bolsillo"
// para usarlo cuando lo necesite. Ese bolsillo es la propiedad "$this->bd".
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->matricula = $matricula;
        $this->especialidad = $especialidad;
    }

    public function guardar()
    {   // 1. El objeto Medico saca al traductor de su bolsillo: "$this->bd".
        // 2. Le da una orden clara usando el método "insert()": "¡Inserta datos!".
        // 3. El primer parámetro, 'medicos', le dice al traductor: "La tabla se llama 'medicos'".
        // 4. El segundo parámetro es un array. Es el mensaje en español que el traductor debe convertir a SQL:
        $this->bd->insert('medicos', [
// "Quiero que en la columna 'nombre' de la BD, pongas el valor de mi propiedad $this->nombre".
            'nombre' => $this->nombre,
// "Quiero que en la columna 'apellido' de la BD, pongas el valor de mi propiedad $this->apellido".
            'apellido' => $this->apellido,
// "Quiero que en la columna 'matricula' de la BD, pongas el valor de mi propiedad $this->matricula".
            'matricula' => $this->matricula,
// "Quiero que en la columna 'especialidad' de la BD, pongas el valor de mi propiedad $this->especialidad".
            'especialidad' => $this->especialidad
        ]);
    }
}
