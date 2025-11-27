<?php

require_once 'clase_Animal.php'; // Incluimos la clase Animal (clase padre) para usarla en la colección

class Perro extends Animal //Definimos la clase hija Perro que hereda de la clase padre Animal
{
    private $raza;
    private $sabeObediencia; //Booleano que indica si el perro sabe obediencia
    private $antecedentesAgresion; //Booleano que indica si el perro tiene antecedentes de agresión

    public function __construct($nombre, $edad, $raza, $sabeObediencia, $antecedentesAgresion) //Definimos el constructor de la clase Perro
    {
        parent::__construct($nombre, $edad, 'Perro'); //Llamamos al constructor de la clase padre Animal
        $this->raza = $raza;
        $this->sabeObediencia = $sabeObediencia;
        $this->antecedentesAgresion = $antecedentesAgresion;
    }

    public function getCaracteristicasEspecificas():string //Definimos el método getCaracteristicasEspecificas
    {
        $obediencia = $this->sabeObediencia ? 'Sí' : 'No';
        return "Raza: {$this->raza}, Sabe obediencia: {$obediencia}";
    }

    public function esAdoptable():bool //Definimos el metodo esAdoptable
    {
        if ($this->antecedentesAgresion == true) {
            return false;
        }
        else {
            return true;
        }
    }

    public function getRaza() { return $this->raza; }
    public function getSabeObediencia() { return $this->sabeObediencia; }
    public function getAntecedentesAgresion() { return $this->antecedentesAgresion; }
}
