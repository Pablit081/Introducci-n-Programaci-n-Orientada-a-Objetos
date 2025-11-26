<?php
// agregar_Persona.php

require_once 'clase_Persona.php';
require_once 'funciones.php'; 

function agregarPersona($refugio) {
    echo "\n--- REGISTRAR NUEVA PERSONA ---\n";
    
    // Validar DNI (Formato y Existencia)
    $dni = pedirDni(); // Función que valida números y largo 8

    // Ya existe DNI?
    if ($refugio->verificarDNI($dni)) //funcion de la clase Refugio que verifica si el DNI ya existe
    {
        echo "⛔ ERROR: El DNI $dni ya está registrado en el sistema.\n";
        echo "   No se puede duplicar la persona.\n";
        return; // Cortamos la función acá. No pedimos ni nombre ni teléfono.
    }

    // Si el DNI está libre, seguimos pidiendo datos...
    echo "Nombre: "; 
    $nom = trim(fgets(STDIN));
    
    echo "Apellido: "; 
    $ape = trim(fgets(STDIN));
    
    echo "Teléfono: "; 
    $tel = trim(fgets(STDIN));
    
    try 
    {
        $nuevaPersona = new Persona($nom, $ape, $dni, $tel);
        $refugio->agregarPersona($nuevaPersona);
        echo "✅ ¡Persona registrada con éxito!\n";
    } 
    catch (Exception $e)
    {
        echo "❌ Error al guardar: " . $e->getMessage() . "\n";
    }
}
?>