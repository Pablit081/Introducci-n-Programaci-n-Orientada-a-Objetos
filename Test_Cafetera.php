<?php

include 'clase_cafetera.php';

echo "=========================================\n";
echo "      Prueba de la Clase Cafetera\n";
echo "=========================================\n\n";

// 1. Creamos una cafetera con capacidad de 1000ml y 250ml iniciales.
// Se invoca al constructor __construct()
$miCafetera = new Cafetera(1000, 250);

// 2. Mostramos el estado inicial usando __toString().
echo "--- Estado Inicial ---\n";
echo $miCafetera . "\n\n";

// 3. Probamos el método servirTaza() con suficiente café.
echo "--- Sirviendo una taza de 150ml ---\n";
$miCafetera->servirTaza(150);
echo "Estado actual: " . $miCafetera . "\n\n";

// 4. Probamos el método agregarCafe().
echo "--- Agregando 500ml de café ---\n";
$miCafetera->agregarCafe(500);
echo "Estado actual: " . $miCafetera . "\n\n";

// 5. Probamos agregar más café del que cabe.
echo "--- Intentando agregar 500ml más (debería derramarse) ---\n";
$miCafetera->agregarCafe(500);
echo "Estado actual: " . $miCafetera . "\n\n";

// 6. Probamos el método llenarCafetera().
echo "--- Llenando la cafetera al máximo ---\n";
$miCafetera->llenarCafetera(); // Primero la vaciamos un poco para ver el efecto
$miCafetera->servirTaza(300);
$miCafetera->llenarCafetera();
echo "Estado actual: " . $miCafetera . "\n\n";

// 7. Probamos servirTaza() sin suficiente café.
echo "--- Intentando servir una taza de 1200ml (solo queda 1000ml) ---\n";
$miCafetera->servirTaza(1200);
echo "Estado actual: " . $miCafetera . "\n\n";

// 8. Probamos el método vaciarCafetera().
echo "--- Vaciando la cafetera ---\n";
$miCafetera->vaciarCafetera();
echo "Estado final: " . $miCafetera . "\n\n";

echo "¡Prueba finalizada con éxito!\n";

?>
