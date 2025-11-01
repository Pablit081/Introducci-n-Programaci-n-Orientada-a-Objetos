<?php

include 'clase_reloj.php';

// Creamos una instancia de nuestro Reloj
$cronometro = new Reloj();
echo "⌚ Cronómetro iniciado: " . $cronometro . "\n\n";

// Simulamos el paso del tiempo para ver el incremento
echo "Iniciando una cuenta de 23 segundos...\n";
for ($i = 0; $i < 23; $i++) {
    $cronometro->incremento();
    echo $cronometro . "\n";
    sleep(1); // Pausa de 1 segundo
}

// Probamos el reinicio con puestaACero()
$cronometro->puestaACero();
echo "\nCronómetro reseteado a: " . $cronometro . "\n";

// Prueba del borde: de 23:57:07 hasta después de la medianoche
echo "\nProbando el reinicio automático de las 24 horas desde las 23:57:07...\n";

// 1. Creamos un nuevo reloj para la prueba.
$relojDePrueba = new Reloj();

// 2. Calculamos los segundos totales para llegar a 23:57:07
$segundosHastaElInicio = (23 * 3600) + (57 * 60) + 7;

echo "Adelantando el reloj a la hora deseada (esto es rápido)...\n";

// 3. Hacemos los incrementos de golpe, sin pausas.
for ($i = 0; $i < $segundosHastaElInicio; $i++) {
    $relojDePrueba->incremento();
}

echo "¡Listo! Iniciando la cuenta desde: " . $relojDePrueba . "\n\n";

// 4. Ahora simulamos el paso del tiempo segundo a segundo para ver el reinicio.
// Haremos un bucle de 3 minutos (180 segundos) para ver claramente el cambio.
for ($i = 0; $i < 180; $i++) {
    echo $relojDePrueba . "\n";
    sleep(1);
    $relojDePrueba->incremento();
}

echo "\n¡Prueba finalizada!\n";
