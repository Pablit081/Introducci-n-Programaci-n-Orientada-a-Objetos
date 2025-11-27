<?php
require_once 'funciones.php';

function agregar_Animal($refugio) 
{
    echo "\n--- Seleccione la especie ---\n";
    echo "1 = Perro 🐶\n";
    echo "2 = Gato 🐱\n";
    echo "3 = Ave 🐦\n";
    $tipo = pedirOpcion("¿Qué tipo de animal?", ['1', '2', '3']);

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
        echo "\n--- Seleccione el tamaño ---\n";
        echo "P = Pequeño\n";
        echo "M = Mediano\n";
        echo "G = Grande\n";
        $tam = pedirOpcion("Tamaño", ['P', 'M', 'G']);
        
        $nuevoAnimal = new Ave($nom, $edad, $vuela, $tam);
        $refugio->agregarAnimal($nuevoAnimal);
        echo "✅ ¡Ave agregada con éxito!\n";
    }
}
?>