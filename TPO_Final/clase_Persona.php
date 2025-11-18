<?php

require_once 'clase_Animal.php'; // Incluimos la clase Animal para usarla en la colección

class Persona 
{
    private $id;
    private $nombrePersona;
    private $dniPersona;
    private $telefono;
    private $cantidadAnimalesAdoptados;
    //Atributo para guardar la "colección" que pide el método getAnimales()
    private $animales = []; 

    // --- Constructor ---
    // Inicializamos los datos básicos y forzamos que la cantidad arranque en 0
    public function __construct($nombrePersona, $dniPersona, $telefono) {
        $this->nombrePersona = $nombrePersona;
        $this->dniPersona = $dniPersona;
        $this->telefono = $telefono;
        $this->cantidadAnimalesAdoptados = 0; 
    }

    // --- Getters y Setters ---
    
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNombrePersona() { return $this->nombrePersona; }
    public function setNombrePersona($nombrePersona) { $this->nombrePersona = $nombrePersona; }

    public function getDniPersona() { return $this->dniPersona; }
    public function setDniPersona($dniPersona) { $this->dniPersona = $dniPersona; }

    public function getTelefono() { return $this->telefono; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }

    public function getCantidadAnimalesAdoptados() { return $this->cantidadAnimalesAdoptados; }

    // --- Métodos Específicos ---

    public function getAnimales(): array // Devuelve la colección (array) de objetos Animal que esta persona adoptó.
    {
        return $this->animales;
    }

// Método para agregar un animal a la colección y actualiza el contador automáticamente.
    public function adoptarAnimal(Animal $animal) // Método para agregar un animal a la colección y actualiza el contador automáticamente.
    {
        $this->animales[] = $animal; // Agrega al array
        $this->cantidadAnimalesAdoptados++; // Aumenta el contador
    }
}
?>