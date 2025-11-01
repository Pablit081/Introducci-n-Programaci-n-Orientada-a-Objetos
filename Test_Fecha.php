<?php
include 'clase_fecha.php';

// Creamos una fecha inicial con la fecha del sistema
$fechaHoy = new Fecha(date('d'), date('m'), date('Y'));

echo "\033[1;4m## Pruebas de Formato ##\033[0m\n";
echo "Fecha de hoy (Abreviada): " . $fechaHoy->toStringAbreviado() . "\n";
echo "Fecha de hoy (Extendida): " . $fechaHoy->toStringExtendido() . "\n";
echo "-----------------------------------------------\n";

echo "\033[1;4m\n## Pruebas de Incremento ##\033[0m\n";

// 1. Prueba simple: sumar 5 días
$fechaFutura1 = $fechaHoy->incremento(5);
echo "Hoy (" . $fechaHoy->toStringAbreviado() . ") + 5 días = " . $fechaFutura1->toStringAbreviado() . "\n";

// 2. Prueba de cambio de mes
$fechaCasiFinDeMes = new Fecha(30, 11, 2025);
$fechaFutura2 = $fechaCasiFinDeMes->incremento(2);
echo "El " . $fechaCasiFinDeMes->toStringAbreviado() . " + 2 días = " . $fechaFutura2->toStringAbreviado() . "\n";

// 3. Prueba de cambio de año
$fechaFinDeAnio = new Fecha(30, 12, 2025);
$fechaFutura3 = $fechaFinDeAnio->incremento(3);
echo "El " . $fechaFinDeAnio->toStringAbreviado() . " + 3 días = " . $fechaFutura3->toStringAbreviado() . "\n";

// 4. Prueba de año bisiesto
echo "\n-- Prueba de año bisiesto (día a día) --\n";
$fechaBisiesta = new Fecha(25, 2, 2000); // 2024 es bisiesto.
echo "Fecha inicial: " . $fechaBisiesta->toStringAbreviado() . "\n";
for ($i = 0; $i <= 6; $i++) {
    echo $fechaBisiesta->toStringAbreviado() . " + {$i} = " . $fechaBisiesta->toStringExtendido() . "\n";
    $fechaBisiesta->incrementaUnDia();
}
echo "----------------------------------------\n";

// 5. Verificamos que la fecha original no cambió
echo "\n" . "\033[1;31;42mLa fecha original sigue siendo: " . $fechaHoy->toStringAbreviado() . "\033[0m" . "\n";
