<?php

include 'clase_Persona.php';

echo "=========================================\n";
echo "        Prueba de la Clase Persona\n";
echo "=========================================\n\n";

// 1. Creamos un objeto Persona usando el constructor.
$unaPersona = new Persona("Juan", "Pérez", "DNI", "12.345.678");

echo "--- Prueba del método __toString() ---\n";
// 2. Invocamos el método __toString() implícitamente al usar 'echo' con el objeto.
echo $unaPersona;
echo "\n-------------------------------------\n\n";

echo "--- Prueba de los métodos de acceso (getters) ---\n";
// 3. Invocamos cada uno de los métodos 'get' y mostramos su valor.
echo "Nombre: " . $unaPersona->getNombre() . "\n";
echo "Apellido: " . $unaPersona->getApellido() . "\n";
echo "Tipo de Documento: " . $unaPersona->getTipoDocumento() . "\n";
echo "Número de Documento: " . $unaPersona->getNumeroDocumento() . "\n";
echo "------------------------------------------------\n\n";

echo "¡Pruebas finalizadas!\n";
