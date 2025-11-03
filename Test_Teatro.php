<?php

include_once 'clase_Teatro.php';

echo "=========================================\n";
echo "     Sistema de Gestión de Teatros\n";
echo "=========================================\n\n";

// 1. Creamos una instancia de la clase Teatro.
$teatroGranRex = new Teatro("Gran Rex", "Av. Corrientes 857, CABA");

// 2. Precargamos algunas funciones para el ejemplo.
$teatroGranRex->agregarFuncion(new Funcion("El Rey León", "18:00", 150, 5000));
$teatroGranRex->agregarFuncion(new Funcion("Drácula, el musical", "21:00", 180, 7500));

do {
    echo "\n--- MENÚ TEATRO: " . $teatroGranRex->getNombre() . " ---\n";
    echo "1. Ver funciones programadas\n";
    echo "2. Cargar nueva función\n";
    echo "3. Modificar nombre de una función\n";
    echo "4. Modificar precio de una función\n";
    echo "0. Salir\n";
    echo "Elija una opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case '1':
            echo "\n" . $teatroGranRex;
            break;

        case '2':
            echo "\n--- Cargar Nueva Función ---\n";
            echo "Nombre de la función: ";
            $nombre = trim(fgets(STDIN));
            echo "Horario de inicio (HH:MM): ";
            $horario = trim(fgets(STDIN));
            echo "Duración en minutos: ";
            $duracion = (int)trim(fgets(STDIN));
            echo "Precio: $";
            $precio = (float)trim(fgets(STDIN));

            if (!empty($nombre) && !empty($horario) && $duracion > 0 && $precio >= 0) {
                $nuevaFuncion = new Funcion($nombre, $horario, $duracion, $precio);
                if ($teatroGranRex->agregarFuncion($nuevaFuncion)) {
                    echo "\n\033[1;32m¡Función agregada con éxito!\033[0m\n";
                } else {
                    echo "\n\033[1;31mError: El horario de la nueva función se solapa con una existente.\033[0m\n";
                }
            } else {
                echo "\n\033[1;31mError: Todos los campos son obligatorios y los valores deben ser válidos.\033[0m\n";
            }
            break;

        case '3':
            echo "\n" . $teatroGranRex;
            if (count($teatroGranRex->getFunciones()) > 0) {
                echo "Número de la función a modificar: ";
                $num = (int)trim(fgets(STDIN));
                echo "Nuevo nombre: ";
                $nombre = trim(fgets(STDIN));
                if ($teatroGranRex->cambiarNombreFuncion($num, $nombre)) {
                    echo "\n\033[1;32m¡Nombre modificado con éxito!\033[0m\n";
                } else {
                    echo "\n\033[1;31mError: Número de función no válido.\033[0m\n";
                }
            }
            break;

        case '4':
            echo "\n" . $teatroGranRex;
            if (count($teatroGranRex->getFunciones()) > 0) {
                echo "Número de la función a modificar: ";
                $num = (int)trim(fgets(STDIN));
                echo "Nuevo precio: $";
                $precio = (float)trim(fgets(STDIN));
                if ($teatroGranRex->cambiarPrecioFuncion($num, $precio)) {
                    echo "\n\033[1;32m¡Precio modificado con éxito!\033[0m\n";
                } else {
                    echo "\n\033[1;31mError: Número de función no válido.\033[0m\n";
                }
            }
            break;

        case '0':
            echo "\nGracias por usar el sistema. ¡Hasta luego!\n";
            break;

        default:
            echo "\n\033[1;31mOpción no válida. Por favor, intente de nuevo.\033[0m\n";
            break;
    }

    if ($opcion != '0') {
        echo "\nPresione Enter para continuar...";
        fgets(STDIN);
    }
} while ($opcion != '0');
