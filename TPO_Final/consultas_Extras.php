<?php

require_once 'funciones.php';

// Vemos qué animales adoptó una persona con DNI xxx
function verAnimalesPorPersona($refugio) {
    echo textoH1("\n--- 🔍 BUSCAR HISTORIAL POR PERSONA ---\n");
    
    listarTodasLasPersonas($refugio);
    // Usamos la función que validamos el DNI
    $dni = pedirDNI();
    
    // Llamamos al método del refugio que hace un JOIN SQL
    $resultados = $refugio->listarAnimalesPorPersona($dni);
    
    if (empty($resultados))
    {
        echo textoError("📂 El DNI $dni no tiene adopciones registradas.\n");
    }
    else
    {
        echo textoH1("\n👤 El usuario con DNI $dni ha adoptado:\n");
        foreach ($resultados as $fila) {
            // Medoo devuelve un array, accedemos al nombre del animal
            echo textoH1("   🐾 " . $fila . "\n");
        }
    }
    echo "-------------------------------------------------\n";
}

// Vemos quien adoptó un animal segun su ID
function verAdoptanteDeAnimal($refugio)
{
    echo textoH1("\n--- 🔍 BUSCAR ADOPTANTE DE UN ANIMAL ---\n");
    listarAnimales($refugio, 'Todos');
    echo textoResaltado("\nIngrese el ID del Animal: ");
    $id = trim(fgets(STDIN));
    
    $resultado = $refugio->obtenerAdoptanteDeAnimal($id);
    
    // Si es un array, es que encontró a la persona
    if (is_array($resultado)) {
        echo textoH1("\n✅ El animal " . $resultado['nombre_animal'] . " [ID: $id] fue adoptado por: " . $resultado['nombre'] . " " . $resultado['apellido'] . "\n");
    }
    else
    {
        // Si es un string, es el mensaje de error ("No está adoptado", etc.)
        echo textoError("ℹ️  Estado: " . $resultado . "\n");
    }
    echo "-------------------------------------------------\n";
}

// Estadísticas
function verTotalesPorTipo($refugio) {
    echo textoH1("\n--- 📊 CANTIDAD DE ANIMALES POR TIPO ---\n\n");
    
    // Esto hace un COUNT GROUP BY en la base de datos
    $datos = $refugio->totalPorTipo();
    
    if (empty($datos)) {
        echo textoError("No hay datos suficientes.\n");
        return;
    }

    foreach($datos as $fila) {
        // str_pad ayuda a que los números queden alineados
        // Ejemplo: "Perro:    5"
        echo "   " . str_pad($fila['tipo'] . ":", 10) . textoH1($fila['cantidad']) . "\n";
    }
    echo "-------------------------------------------------\n";
}
?>