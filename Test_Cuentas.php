<?php

include 'clase_Cliente.php';
include 'clase_Cuenta.php';

// Almacenes de datos en memoria
$clientesCreados = [];
$cuentasCreadas = [];
$siguienteNumeroCuenta = 1; // Contador para los números de cuenta

/**
 * Función auxiliar para solicitar un número positivo al usuario.
 * @param string $mensaje
 * @return float
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

/**
 * Muestra una lista de clientes y permite al usuario seleccionar uno.
 * @param array $clientes
 * @return Cliente|null
 */
function seleccionarCliente(array $clientes): ?Cliente
{
    if (count($clientes) === 0) {
        echo "\n\033[1;33mNo hay clientes creados. Por favor, cree un cliente primero.\033[0m\n";
        return null;
    }
    echo "\nSeleccione un cliente:\n";
    foreach ($clientes as $indice => $cliente) {
        echo ($indice + 1) . ". " . $cliente->getNombre() . " " . $cliente->getApellido() . " (DNI: " . $cliente->getDni() . ")\n";
    }
    $opcion = (int)trim(fgets(STDIN)) - 1;
    if (isset($clientes[$opcion])) {
        return $clientes[$opcion];
    }
    echo "\n\033[1;31mOpción no válida.\033[0m\n";
    return null;
}

/**
 * Muestra una lista de cuentas y permite al usuario seleccionar una.
 * @param array $cuentas
 * @return Cuenta|null
 */
function seleccionarCuenta(array $cuentas): ?Cuenta
{
    if (count($cuentas) === 0) {
        echo "\n\033[1;33mNo hay cuentas creadas. Por favor, cree una cuenta primero.\033[0m\n";
        return null;
    }
    echo "\nSeleccione una cuenta:\n";
    foreach ($cuentas as $indice => $cuenta) {
        $tipo = $cuenta instanceof CajaDeAhorro ? "Caja de Ahorro" : "Cuenta Corriente";
        echo ($indice + 1) . ". " . $tipo . " de " . $cuenta->getCliente()->getNombre() . " " . $cuenta->getCliente()->getApellido() . " (Saldo: $" . number_format($cuenta->saldoCuenta(), 2) . ")\n";
    }
    $opcion = (int)trim(fgets(STDIN)) - 1;
    if (isset($cuentas[$opcion])) {
        return $cuentas[$opcion];
    }
    echo "\n\033[1;31mOpción no válida.\033[0m\n";
    return null;
}


echo "=========================================\n";
echo "     Sistema de Gestión Bancaria\n";
echo "=========================================\n";

do {
    echo "\n--- MENÚ PRINCIPAL ---\n";
    echo "1. Crear Cliente\n";
    echo "2. Crear Cuenta Bancaria\n";
    echo "3. Realizar Depósito\n";
    echo "4. Realizar Retiro\n";
    echo "5. Ver Resumen de Cuentas\n";
    echo "0. Salir\n";
    echo "Elija una opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case '1': // Crear Cliente
            echo "\n--- Crear Nuevo Cliente ---\n";
            echo "Ingrese el DNI del cliente: ";
            $dni = trim(fgets(STDIN));

            $dniExiste = false;
            foreach ($clientesCreados as $clienteExistente) {
                if ($clienteExistente->getDni() === $dni) {
                    $dniExiste = true;
                    break;
                }
            }

            if ($dniExiste) {
                echo "\n\033[1;31mError: Ya existe un cliente con el DNI " . $dni . ".\033[0m\n";
            } else {
                echo "Ingrese el Nombre del cliente: ";
                $nombre = trim(fgets(STDIN));
                echo "Ingrese el Apellido del cliente: ";
                $apellido = trim(fgets(STDIN));

                $nuevoCliente = new Cliente($dni, $nombre, $apellido);
                $clientesCreados[] = $nuevoCliente;

                echo "\n\033[1;32m¡Cliente creado exitosamente!\033[0m\n";
                echo $nuevoCliente . "\n";
            }
            break;

        case '2': // Crear Cuenta Bancaria
            echo "\n--- Crear Nueva Cuenta Bancaria ---\n";
            $clienteSeleccionado = seleccionarCliente($clientesCreados);

            if ($clienteSeleccionado) {
                echo "\n¿Qué tipo de cuenta desea crear para " . $clienteSeleccionado->getNombre() . "?\n";
                echo "1. Caja de Ahorro\n";
                echo "2. Cuenta Corriente\n";
                echo "Elija una opción: ";
                $tipoCuenta = trim(fgets(STDIN));

                $saldoInicial = solicitarNumeroPositivo("Ingrese el saldo inicial: $");

                if ($tipoCuenta === '1') {
                    $nuevaCuenta = new CajaDeAhorro($clienteSeleccionado, $saldoInicial, $siguienteNumeroCuenta);
                    $siguienteNumeroCuenta++; // Incrementamos el contador para la próxima cuenta
                    $cuentasCreadas[] = $nuevaCuenta;
                    echo "\n\033[1;32m¡Caja de Ahorro creada exitosamente!\033[0m\n";
                    echo $nuevaCuenta . "\n";
                } elseif ($tipoCuenta === '2') {
                    $montoDescubierto = solicitarNumeroPositivo("Ingrese el monto de descubierto permitido: $");
                    $nuevaCuenta = new CuentaCorriente($clienteSeleccionado, $saldoInicial, $siguienteNumeroCuenta, $montoDescubierto);
                    $siguienteNumeroCuenta++; // Incrementamos el contador para la próxima cuenta
                    $cuentasCreadas[] = $nuevaCuenta;
                    echo "\n\033[1;32m¡Cuenta Corriente creada exitosamente!\033[0m\n";
                    echo $nuevaCuenta . "\n";
                } else {
                    echo "\n\033[1;31mTipo de cuenta no válido.\033[0m\n";
                }
            }
            break;

        case '3': // Realizar Depósito
            echo "\n--- Realizar Depósito ---\n";
            $cuentaSeleccionada = seleccionarCuenta($cuentasCreadas);

            if ($cuentaSeleccionada) {
                $monto = solicitarNumeroPositivo("Ingrese el monto a depositar: $");
                if ($cuentaSeleccionada->realizarDeposito($monto)) {
                    echo "\n\033[1;32m¡Depósito realizado con éxito!\033[0m\n";
                    echo "Nuevo Saldo: $" . number_format($cuentaSeleccionada->saldoCuenta(), 2) . "\n";
                } else {
                    // Este caso es poco probable con la lógica actual, pero es buena práctica tenerlo.
                    echo "\n\033[1;31mError al realizar el depósito.\033[0m\n";
                }
            }
            break;

        case '4': // Realizar Retiro
            echo "\n--- Realizar Retiro ---\n";
            $cuentaSeleccionada = seleccionarCuenta($cuentasCreadas);

            if ($cuentaSeleccionada) {
                $monto = solicitarNumeroPositivo("Ingrese el monto a retirar: $");
                if ($cuentaSeleccionada->realizarRetiro($monto)) {
                    echo "\n\033[1;32m¡Retiro realizado con éxito!\033[0m\n";
                    echo "Nuevo Saldo: $" . number_format($cuentaSeleccionada->saldoCuenta(), 2) . "\n";
                } else {
                    echo "\n\033[1;31mFondos insuficientes. No se pudo realizar el retiro.\033[0m\n";
                }
            }
            break;

        case '5': // Ver Resumen de Cuentas
            echo "\n--- Resumen de Todas las Cuentas ---\n";
            if (count($cuentasCreadas) > 0) {
                foreach ($cuentasCreadas as $cuenta) {
                    echo $cuenta . "\n";
                    echo "-------------------------------------\n";
                }
            } else {
                echo "\n\033[1;33mNo hay cuentas para mostrar.\033[0m\n";
            }
            break;

        case '0': // Salir
            echo "\nGracias por usar el Sistema de Gestión Bancaria. ¡Hasta luego!\n";
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
