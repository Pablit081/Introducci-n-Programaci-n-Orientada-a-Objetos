<?php
//*14.g. Crear un script Test_CuentaBancaria que cree un objeto CuentaBancaria e invoque a cada
//*uno de los métodos implementados.

include_once 'clase_cuentaBancaria.php';
// Necesitamos incluir también la clase Persona, ya que ahora la usamos.
include_once 'clase_Persona.php';

// --- Creación inicial de la cuenta ---
echo "Bienvenido al Simulador de Cuenta Bancaria\n";
echo "-------------------------------------------\n";

// 1. Creamos el objeto Persona que será el dueño de la cuenta.
$duenio = new Persona("Ana", "García", "DNI", "12.345.678");
// 2. Creamos la cuenta y le pasamos el objeto Persona completo.
$cuenta = new CuentaBancaria("12345-67890", $duenio, 10000, 5); // 5% de interés anual
echo "Se ha creado una cuenta de prueba.\n\n";

// --- Bucle principal del menú ---
do {
    // Mostrar menú de opciones
    echo "\nElija una operación a realizar:\n";
    echo "1. Ver datos de la cuenta\n";
    echo "2. Ver saldo actual\n";
    echo "3. Depositar dinero\n";
    echo "4. Retirar dinero\n";
    echo "5. Actualizar saldo por interés diario\n";
    echo "0. Salir\n";
    echo "-------------------------------------------\n";

    // Leer la opción del usuario
    $opcion = trim(fgets(STDIN));

    // Procesar la opción con un switch
    switch ($opcion) {
        case '1': // Ver datos de la cuenta
            echo "\n--- Datos de la Cuenta ---\n";
            echo $cuenta; // Usa el método __toString()
            echo "\n--------------------------\n";
            break;

        case '2': // Ver saldo actual
            echo "\n--- Saldo Actual ---\n";
            echo "Su saldo es: $" . number_format($cuenta->getSaldoActual(), 2);
            echo "\n--------------------\n";
            break;

        case '3': // Depositar dinero
            echo "Ingrese la cantidad a depositar: ";
            $monto = (float)trim(fgets(STDIN));
            try {
                $cuenta->depositar($monto);
                echo "\n¡Depósito exitoso!\n";
                echo "Nuevo saldo: $" . number_format($cuenta->getSaldoActual(), 2) . "\n";
            } catch (Exception $e) {
                echo "\nError: " . $e->getMessage() . "\n";
            }
            break;

        case '4': // Retirar dinero
            echo "Ingrese la cantidad a retirar: ";
            $monto = (float)trim(fgets(STDIN));
            try {
                $cuenta->retirar($monto);
                echo "\n¡Retiro exitoso!\n";
                echo "Nuevo saldo: $" . number_format($cuenta->getSaldoActual(), 2) . "\n";
            } catch (Exception $e) {
                echo "\nError: " . $e->getMessage() . "\n";
            }
            break;

        case '5': // Actualizar saldo por interés
            $saldoAnterior = $cuenta->getSaldoActual();
            $cuenta->actualizarSaldo();
            $ganancia = $cuenta->getSaldoActual() - $saldoAnterior;
            echo "\nSe aplicó el interés diario.\n";
            echo "Ganancia por interés: $" . number_format($ganancia, 2) . "\n";
            echo "Nuevo saldo: $" . number_format($cuenta->getSaldoActual(), 2) . "\n";
            break;

        case '0': // Salir
            echo "Gracias por usar el simulador. ¡Hasta luego!\n";
            break;

        default:
            echo "\nOpción no válida. Por favor, intente de nuevo.\n";
            break;
    }

    // Pequeña pausa para que el usuario pueda leer la salida antes de volver a mostrar el menú
    if ($opcion != '0') {
        echo "Presione Enter para continuar...";
        fgets(STDIN);
    }
} while ($opcion != '0');

/**
 * Notas sobre el código:
 * - STDIN: Es una constante predefinida en PHP que representa el flujo de entrada estándar,
 *   generalmente el teclado.
 * - fgets(STDIN): Lee una línea de texto desde la entrada estándar (lo que el usuario escribe).
 * - trim(): Elimina espacios en blanco (y otros caracteres como saltos de línea) del inicio
 *   y final de una cadena. Es útil para limpiar la entrada del usuario.
 * - (float): Convierte la cadena de texto leída a un número de punto flotante para poder
 *   usarlo en operaciones matemáticas.
 */
