<?php
require_once 'funciones.php';

function agregar_Animal($refugio) {

    $tipo = pedirOpcion("¿Qué tipo de animal?", ['1 = Perro', '2 = Gato', '3 = Ave']);

    // Atributos comunes a todos los animales
    echo "Nombre: "; $nom = trim(fgets(STDIN));
    echo "Edad: "; $edad = trim(fgets(STDIN));

    // Atributos específicos según el tipo de animal
    if ($tipo == '1') { // Perro
        echo "Raza: "; $raza = trim(fgets(STDIN));
        $obe = pedirConfirmacion("¿Sabe obediencia?");
        $agr = pedirConfirmacion("¿Es agresivo?");
        
        $nuevoAnimal = new Perro($nom, $edad, $raza, $obe, $agr);
        $refugio->agregarAnimal($nuevoAnimal);
        echo "✅ ¡Perro agregado con éxito!\n";

    } elseif ($tipo == '2') { // Gato
        echo "Color de Pelo: "; $color = trim(fgets(STDIN));
        $med = pedirConfirmacion("¿Requiere medicación?");
        
        $nuevoAnimal = new Gato($nom, $edad, $color, $med);
        $refugio->agregarAnimal($nuevoAnimal);
        echo "✅ ¡Gato agregado con éxito!\n";
    
    } elseif ($tipo == '3') { // Ave
        $vuela = pedirConfirmacion("¿Puede volar?");
        $tam = pedirOpcion("Tamaño (Pequeño/Mediano/Grande)", ['Pequeño', 'Mediano', 'Grande']);
        
        $nuevoAnimal = new Ave($nom, $edad, $vuela, $tam);
        $refugio->agregarAnimal($nuevoAnimal);
        echo "✅ ¡Ave agregada con éxito!\n";
    }
}
?>