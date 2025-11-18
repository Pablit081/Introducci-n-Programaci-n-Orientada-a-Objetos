<?php

require_once 'clase_Animal.php';

class Ave extends Animal //Definimos la clase hija Ave que hereda de la clase padre Animal
{
    private $puedeVolar; //Booleano que indica si el ave es vuel
    private $tamanio; //Tamaño del ave (Pequeño, Mediano, Grande)

    public function __construct($nombre, $edad, $puedeVolar, $tamanio) //Definimos el constructor de la clase Ave
    {
        parent::__construct($nombre, $edad, 'Ave'); //Llamamos al constructor de la clase padre Animal
        $this->puedeVolar = $puedeVolar;
        $this->tamanio = $tamanio;
    }

    public function getCaracteristicasEspecificas():string //Definimos el método getCaracteristicasEspecificas
    {
        $puedeVolar = $this->puedeVolar ? 'Sí' : 'No';
        return "Puede volar: {$puedeVolar}, Tamaño: {$this->tamanio}";
    }

    public function esAdoptable():bool //Definimos el metodo esAdoptable
    {
        return false; //Ningun ave es adoptable
    }
}