<?php

require_once 'clase_Persona.php';
require_once 'funciones.php'; 

function agregarPersona($refugio) {
    echo textoH1("\n--- REGISTRAR NUEVA PERSONA ---\n\n");
    
    // Validamos DNI (Formato y Existencia)
    $dni = pedirDni(); // Función que valida números y largo 8

    // Ya existe DNI?
    if ($refugio->verificarDNI($dni)) //funcion de la clase Refugio que verifica si el DNI ya existe
    {
        echo textoError("⛔ ERROR: El DNI $dni ya está registrado en el sistema.\n");
        echo textoError("   No se puede duplicar la persona.\n");
        return; // Cortamos la función acá. No pedimos ni nombre ni teléfono.
    }

    // Si el DNI está libre, seguimos pidiendo datos...
    echo "Nombre: "; 
    $nom = trim(fgets(STDIN));
    
    echo "Apellido: "; 
    $ape = trim(fgets(STDIN));
    
    $tel = pedirTelefono(); 
    
    try 
    {
        $nuevaPersona = new Persona($nom, $ape, $dni, $tel);
        $refugio->agregarPersona($nuevaPersona);
        echo textoH1("\n✅ ¡Persona registrada con éxito!\n");
    } 
    catch (Exception $e)
    {
        echo textoError("❌ Error al guardar: " . $e->getMessage() . "\n");
    }
}
?>