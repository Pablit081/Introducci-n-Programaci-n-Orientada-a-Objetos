<?php
/* El usuario intenta crear una new Adopcion($miPerro, $miPersona).

El Constructor de Adopcion pregunta: ¿$miPerro->esAdoptable?.

Si el perro mordió a alguien (devuelve false), la adopción falla y tira error.

Si es true:

Guarda los IDs.

Llama a $miPerro->setEstado('adoptado').

Llama a $miPersona->adoptarAnimal($miPerro) (que suma +1 al contador).
*/

require_once 'clase_Animal.php'; // Incluimos la clase Animal para usarla en la colección
require_once 'clase_Persona.php'; // Incluimos la clase  para usarla en la colección


class Adopcion {

    private $idAdopcion;
    private $idAnimal;
    private $idPersona;
    private $fechaAdopcion;

    // Recibe los OBJETOS completos para poder validar las reglas y modificar sus estados.
    public function __construct(Animal $animal, Persona $persona)
    {
    
    // Validación del construct
    // Solo se construye si esAdoptable()... devuelve true.
        if ($animal ->esAdoptable() === false) 
        {
            //Si no es adoptable, cortamos la ejecución lanzando un error y capturando la excepción.
            throw new Exception("El animal ".  $animal->getNombre() . " no es adoptable.");
        }

        $this->idAnimal = $animal->getId();
        $this->idPersona = $persona->getId();
        $this->fechaAdopcion = date('Y-m-d'); //Fecha actual en formato YYYY-MM-DD
    
        $animal-> setEstado("Adoptado"); // Cambiamos el estado del animal a "Adoptado"
        $persona-> adoptarAnimal($animal); // Agregamos el animal a la colección de animales adoptados (array) por la persona
    
    }
// Getters y Setters
    public function getIdAdopcion() { return $this->idAdopcion; }
    public function setIdAdopcion($idAdopcion) { $this->idAdopcion = $idAdopcion; }

    public function getIdAnimal() { return $this->idAnimal; }
    public function setIdAnimal($idAnimal) { $this->idAnimal = $idAnimal; }
}