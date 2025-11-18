<?php

use Medoo\Medoo;

abstract class Animal //Definimos la clase padre abstracta Animal
{
    protected $id;
    protected $nombre;
    protected $edad;
    protected $tipoAnimal;

public function __construct($nombre, $edad, $tipoAnimal) //Definimos el constructor de la clase Animal
{
    $this->nombre = $nombre;
    $this->edad = $edad;
    $this->tipoAnimal = $tipoAnimal;
}

public function getNombre() //Definimos el metodo getter
{
    return $this->nombre;
}

public function getEdad() //Definimos el método getEdad
{
    return $this->edad;
}

public function getTipoAnimal() //Definimos el método getTipoAnimal
{
    return $this->tipoAnimal;
}

abstract public function getCaracteristicasEspecificas(): string; //Definimos el método getCaracteristicasEspecificas

public function esAdoptable(): bool //Definimos el método esAdotable
{
    return true;

}

}