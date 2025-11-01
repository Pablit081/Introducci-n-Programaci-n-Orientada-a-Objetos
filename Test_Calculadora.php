<?php
// 1. Incluimos la clase Calculadora, como siempre.
include 'clase_calculadora.php';

// 2. Creamos nuestro objeto Calculadora una sola vez.
$miCalculadora = new Calculadora();
echo "\033c";
echo "\033[1;31;42m ============================================== \033[0m\n";
echo "\033[1;31;42m Bienvenido a la Calculadora Interactiva en PHP \033[0m\n";
echo "\033[1;31;42m ============================================== \033[0m\n";

// 3. Iniciamos un bucle infinito que solo se romperá cuando el usuario elija salir.
while (true) {
    // Mostramos el menú de opciones
    echo "\n\033[1mQué operación deseas realizar?\033[0m\n";
    echo "\033[1m  1 - \033[4mSumar\033[0m\n";
    echo "\033[1m  2 - \033[4mRestar\033[0m\n";
    echo "\033[1m  3 - \033[4mMultiplicar\033[0m\n";
    echo "\033[1m  4 - \033[4mDividir\033[0m\n";
    echo "\033[1m  5 - \033[4mSalir\033[0m\n";

    // 4. Usamos readline() para capturar la elección del usuario.
    $opcion = readline("Elige una opción: ");

    // 5. Verificamos si el usuario quiere salir del programa.
    if ($opcion == '5') {
        echo "¡Hasta luego!\n";
        usleep(250000);
        echo".";
        usleep(250000);
        echo".";
        usleep(250000);
        echo".";
        usleep(1000000);
        echo "\033c";
        break; // 'break' rompe el bucle 'while' y termina el script.
    }

    // Si la opción no es válida, avisamos y volvemos al inicio del bucle.
    if ($opcion < '1' || $opcion > '4') {
        echo "\033[1;41mOpción no válida. Por favor, elige un número del 1 al 5.\033[0m\n";
        continue; // 'continue' salta al siguiente ciclo del bucle.
    }

    // 6. Pedimos los números. readline() devuelve texto, así que lo convertimos a número con (float).
    $num1 = (float)readline("\033[1mIngresa el primer número: \033[0m");
    $num2 = (float)readline("\033[1mIngresa el segundo número: \033[0m");

    $resultado = 0;

    // 7. Usamos una estructura 'switch' para decidir qué método llamar.
    switch ($opcion) {
        case '1':
            $resultado = $miCalculadora->sumar($num1, $num2);
            break;
        case '2':
            $resultado = $miCalculadora->restar($num1, $num2);
            break;
        case '3':
            $resultado = $miCalculadora->multiplicar($num1, $num2);
            break;
        case '4':
            $resultado = $miCalculadora->dividir($num1, $num2);
            break;
    }

    // 8. Mostramos el resultado al usuario.
    echo "\033[92;40m----------------------\033[0m\n";
    echo "\033[92;40m✅ El resultado es: " . $resultado . "\033[0m\n";
    echo "\033[92;40m----------------------\033[0m\n";
}