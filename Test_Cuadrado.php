<?php

include 'clase_cuadrado.php';
echo "=========================================\n";
echo "       Prueba de la Clase Cuadrado\n";
echo "=========================================\n\n";

// 1. Definimos los 4 vértices para un cuadrado de lado 5.
$puntoA = ['x' => 0, 'y' => 0];
$puntoB = ['x' => 5, 'y' => 0];
$puntoC = ['x' => 5, 'y' => 5];
$puntoD = ['x' => 0, 'y' => 5];

// 2. Creamos la instancia del Cuadrado.
$miCuadrado = new Cuadrado($puntoA, $puntoB, $puntoC, $puntoD);

// 3. Mostramos el estado inicial usando __toString().
echo "--- Estado Inicial ---\n";
echo $miCuadrado . "\n\n";

// 4. Probamos el método area().
echo "--- Cálculo de Área ---\n";
echo "El área del cuadrado es: " . $miCuadrado->area() . " unidades cuadradas.\n\n";

// 5. Probamos el método desplazar().
echo "--- Prueba de Desplazamiento ---\n";
$desplazamiento = ['x' => 10, 'y' => -2];
echo "Desplazando el cuadrado por (dx: " . $desplazamiento['x'] . ", dy: " . $desplazamiento['y'] . ")...\n";
$miCuadrado->desplazar($desplazamiento);
echo "Nuevas coordenadas:\n";
echo $miCuadrado . "\n\n";

// 6. Probamos el método aumentarTamaño().
echo "--- Prueba de Aumento de Tamaño ---\n";
$aumento = 3;
echo "Aumentando el tamaño del lado en " . $aumento . " unidades...\n";
$miCuadrado->aumentarTamaño($aumento);
echo "Nuevas coordenadas:\n";
echo $miCuadrado . "\n\n";

// 7. Verificamos el área final para confirmar que el tamaño aumentó correctamente.
echo "--- Verificación del Área Final ---\n";
echo "El área del nuevo cuadrado es: " . $miCuadrado->area() . " unidades cuadradas.\n\n";

echo "\n¡Prueba finalizada con éxito!\n";
