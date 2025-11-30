<?php

abstract class Animal //Definimos la clase padre abstracta Animal
{
    protected $idAnimal;
    protected $nombre;
    protected $edad;
    protected $tipoAnimal;
    protected $estado;

    public function __construct($nombre, $edad, $tipoAnimal) //Definimos el constructor de la clase Animal
{
    $this->nombre = $nombre;
    $this->edad = $edad;
    $this->tipoAnimal = $tipoAnimal;
}

public function getId() {return $this->idAnimal;} //Definimos el método getId
public function setId($idAnimal) {$this->idAnimal = $idAnimal;} //Definimos el método setId
public function getNombre() {return $this->nombre;} //Definimos el metodo getNombre


public function getEdad() {return $this->edad;} //Definimos el método getEdad


public function getTipoAnimal() {return $this->tipoAnimal;} //Definimos el método getTipoAnimal


abstract public function getCaracteristicasEspecificas(): string; //Definimos el método getCaracteristicasEspecificas

public function esAdoptable(): bool {return true;} //Definimos el método esAdotable (siempre devuelve true)

public function setEstado($estado) {$this->estado = $estado;} //Definimos el método setEstado
public function getEstado() {return $this->estado;} //Definimos el método getEstado

}