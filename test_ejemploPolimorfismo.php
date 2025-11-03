<?php
include 'ejemploPolimorfismo.php';

/**
 * Función auxiliar para mostrar los resultados de una figura.
 * @param figura $figura El objeto de la figura a mostrar.
 */
function mostrarResultados(figura $figura)
{
    echo "\n--- Resultados ---\n";
    echo $figura->toString() . "\n";
    echo "Área: " . number_format($figura->calcularArea(), 2) . "\n";
    echo "Perímetro: " . number_format($figura->calcularPerimetro(), 2) . "\n";
    echo "------------------\n\n";
    echo "Presione Enter para continuar...";
    fgets(STDIN);
}

/**
 * Función auxiliar para solicitar un número no negativo al usuario.
 * @param string $mensaje El mensaje a mostrar para solicitar el número.
 * @return float El número validado.
 */
function solicitarNumeroPositivo(string $mensaje): float
{
    do {
        echo $mensaje;
        $valor = (float)trim(fgets(STDIN));
        if ($valor < 0) {
            echo "\n\033[1;31mError: El valor no puede ser negativo. Intente de nuevo.\033[0m\n";
        }
    } while ($valor < 0);
    return $valor;
}

echo "=========================================\n";
echo " Creador de Figuras Geométricas (v1)\n";
echo "=========================================\n";

do {
    echo "\nElija la figura que desea crear:\n";
    echo "1. Círculo\n";
    echo "2. Cuadrado\n";
    echo "3. Triángulo\n";
    echo "0. Salir\n";
    $opcion = trim(fgets(STDIN));

    if ($opcion >= '1' && $opcion <= '3') {
        $x = solicitarNumeroPositivo("Ingrese la coordenada X del centro: ");
        $y = solicitarNumeroPositivo("Ingrese la coordenada Y del centro: ");
    }

    switch ($opcion) {
        case '1':
            $radio = solicitarNumeroPositivo("Ingrese el radio del círculo: ");
            $figura = new Circulo($x, $y, $radio);
            mostrarResultados($figura);
            break;
        case '2':
            $lado = solicitarNumeroPositivo("Ingrese el lado del cuadrado: ");
            $figura = new Cuadrado($x, $y, $lado);
            mostrarResultados($figura);
            break;
        case '3':
            $base = solicitarNumeroPositivo("Ingrese la base del triángulo: ");
            $altura = solicitarNumeroPositivo("Ingrese la altura del triángulo: ");
            $figura = new Triangulo($x, $y, $base, $altura);
            mostrarResultados($figura);
            break;
        case '0':
            echo "¡Hasta luego!\n";
            break;
        default:
            echo "\nOpción no válida. Por favor, intente de nuevo.\n";
            break;
    }
} while ($opcion != '0');
