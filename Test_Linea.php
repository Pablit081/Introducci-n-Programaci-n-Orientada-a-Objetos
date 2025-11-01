<?php

include 'clase_linea.php';

echo "=========================================\n";
echo "        Prueba de la Clase Linea\n";
echo "=========================================\n\n";

// 1. Definimos los puntos iniciales para la línea.
$puntoInicialA = ['x' => 10, 'y' => 20];
$puntoInicialB = ['x' => 30, 'y' => 40];

// 2. Creamos una instancia de la clase Linea.
$miLinea = new Linea($puntoInicialA, $puntoInicialB);

// 3. Mostramos el estado inicial de la línea usando __toString().
echo "--- Estado Inicial ---\n";
echo $miLinea . "\n\n";

// 4. Probamos el método mueveDerecha().
$distancia = 5;
echo "--- Moviendo a la derecha por " . $distancia . " unidades ---\n";
$miLinea->mueveDerecha($distancia);
echo $miLinea . "\n\n";

// 5. Probamos el método mueveIzquierda().
$distancia = 7;
echo "--- Moviendo a la izquierda por " . $distancia . " unidades ---\n";
$miLinea->mueveIzquierda($distancia);
echo $miLinea . "\n\n";

// 6. Probamos el método mueveArriba().
$distancia = 10;
echo "--- Moviendo hacia arriba por " . $distancia . " unidades ---\n";
$miLinea->mueveArriba($distancia);
echo $miLinea . "\n\n";

// 7. Probamos el método mueveAbajo().
$distancia = 4;
echo "--- Moviendo hacia abajo por " . $distancia . " unidades ---\n";
$miLinea->mueveAbajo($distancia);
echo $miLinea . "\n\n";

echo "¡Prueba de movimientos finalizada con éxito!\n";
