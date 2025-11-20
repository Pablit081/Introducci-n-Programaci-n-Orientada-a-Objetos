<?php

use Exception; //Capturamos la clase Exception

class Adopcion {

    private $idAdopcion;
    private $idAnimal;
    private $idPersona;
    private $fechaAdopcion;

    public function __construct(Animal $animal, Persona $persona) {
    
        if ($animal ->esAdoptable() == false) {
            throw new Exception("El animal ".  $animal->getNombre() . " no es adoptable.");
        }

        $this->idAnimal = $animal->getId();
        $this->idPersona = $persona->getId();
        $this->fechaAdopcion = date('Y-m-d'); //Fecha actual en formato YYYY-MM-DD
    
    $animal-> setEstado("Adoptado"); // Cambiamos el estado del animal a "Adoptado"
    $persona-> adoptarAnimal($animal); // Agregamos el animal a la colección de animales adoptados por la persona
    
    }
}