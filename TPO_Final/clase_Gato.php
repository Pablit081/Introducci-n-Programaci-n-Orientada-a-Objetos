<?php

require_once 'clase_Animal.php'; //incluye a la clase padre Animal

class Gato extends Animal //Definimos la clase hija Gato que hereda de la clase padre Animal
{
    private $colorPelo;
    private $requiereMedicacion; //Booleano que indica si el gato está castrado

    public function __construct($nombre, $edad, $colorPelo, $requiereMedicacion) //Definimos el constructor de la clase Gato
    {
        parent::__construct($nombre, $edad, 'Gato'); //Llamamos al constructor de la clase padre Animal
        $this->colorPelo = $colorPelo;
        $this->requiereMedicacion = $requiereMedicacion;
    }

    public function getCaracteristicasEspecificas():string //Definimos el método getCaracteristicasEspecificas
    {
        $medic = $this->requiereMedicacion ? 'Sí' : 'No';
        return "Color de pelo: {$this->colorPelo}, Requiere medicación: {$medic}";
    }

    public function esAdoptable():bool //Definimos el metodo esAdoptable
    {
        return true; //Todos los gatos son adoptables
    }
}