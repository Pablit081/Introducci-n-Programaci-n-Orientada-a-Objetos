<?php

require_once 'funciones.php';

function registrar_Adopcion($refugio) {
    echo textoH1("\n--- ❤️  REGISTRAR NUEVA ADOPCIÓN ❤️ ---\n\n");

    listarAnimales($refugio);
    // 1. BUSCAR ANIMAL
    echo textoResaltado("Ingrese el ID del Animal a adoptar: ");
    $idAnimal = trim(fgets(STDIN));
    
    // Usamos el método del refugio que busca en BD y devuelve un Objeto
    $animal = $refugio->buscarAnimalPorId($idAnimal);

    if (!$animal) {
        echo textoError("❌ Error: No existe un animal con ID $idAnimal.\n");
        return;
    }

    // Validamos visualmente antes de seguir
    echo textoH1("\n   -> Seleccionado: " . $animal->getNombre() . " (" . $animal->getTipoAnimal() . ") ✅ Disponible.\n");
    
    if ($animal->getEstado() === 'Adoptado') {
        echo textoError("\n⛔ ERROR: " . $animal->getNombre() . " ya tiene hogar. No se puede adoptar.\n");
        return;
    }

    // 2. BUSCAR PERSONA
    listarTodasLasPersonas($refugio);
    echo textoResaltado("\nIngrese el ID de la Persona que adoptará: \n");
    $idPersona = trim(fgets(STDIN));
    $persona = $refugio->buscarPersonaPorId($idPersona);

    if (!$persona) {
        echo textoError("❌ Error: No existe una persona con ID $idPersona.\n");
        return;
    }
    echo textoH1("   -> Seleccionado: " . $persona->getNombrePersona() . " " . $persona->getApellidoPersona() . "\n");


    // 3. CONFIRMAR E INTENTAR
    echo "\n";
    if (pedirConfirmacion("¿Confirma que desea adoptar a " . $animal->getNombre() . "?")) {
        try {
            // 1. Se crea la Adopción.
            // 2. El constructor de Adopcion verifica $animal->esAdoptable().
            // 3. Si el perro es agresivo, lanza Exception y salta al 'catch'.
            $adopcion = new Adopcion($animal, $persona);

            // 4. Si pasó la validación, guardamos en la Base de Datos.
            $refugio->registrarAdopcion($adopcion);
            
            echo textoH1("\n🎉 ¡FELICITACIONES! Adopción registrada correctamente.\n\n");
            echo textoH1("   " . $animal->getNombre() . " ahora es parte de la familia de " . $persona->getNombrePersona() . ".\n");

        } catch (Exception $e) {
            // Si el animal era agresivo o hubo otro problema lógico:
            echo textoError("\n⛔ BLOQUEO DEL SISTEMA: " . $e->getMessage() . "\n");
        }
    } else {
        echo textoError("Operación cancelada.\n");  
    }
}
?>