<?php

require_once 'clase_Animal.php'; // Incluimos la clase Animal para usarla en la colección

class Persona 
{
    private $idPersona;
    private $nombrePersona;
    private $apellidoPersona;
    private $dniPersona;
    private $telefono;
    private $cantidadAnimalesAdoptados;
    
    // --- Constructor ---
    // Inicializamos los datos básicos y forzamos que la cantidad arranque en 0
    public function __construct($nombrePersona, $apellidoPersona, $dniPersona, $telefono) {
        $this->nombrePersona = $nombrePersona;
        $this->apellidoPersona = $apellidoPersona;
        $this->dniPersona = $dniPersona;
        $this->telefono = $telefono;
        $this->cantidadAnimalesAdoptados = 0; 
    }

    // --- Getters y Setters ---
    
    public function getId() { return $this->idPersona; }
    public function setId($idPersona) { $this->idPersona = $idPersona; }

    public function getNombrePersona() { return $this->nombrePersona; }
    public function setNombrePersona($nombrePersona) { $this->nombrePersona = $nombrePersona; }

    public function getApellidoPersona() { return $this->apellidoPersona; }
    public function setApellidoPersona($apellidoPersona) { $this->apellidoPersona = $apellidoPersona; }

    public function getDniPersona() { return $this->dniPersona; }
    public function setDniPersona($dniPersona) { $this->dniPersona = $dniPersona; }

    public function getTelefono() { return $this->telefono; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }

    public function getCantidadAnimalesAdoptados() { return $this->cantidadAnimalesAdoptados; }

}
?>