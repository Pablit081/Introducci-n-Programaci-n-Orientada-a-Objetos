<?php

include_once 'clase_Banco_v2.php';

echo "=========================================\n";
echo "     Sistema de Gestión Bancaria (v2)\n";
echo "=========================================\n\n";

// 1. Creamos una instancia del Banco.
$bancoNacion = new Banco();

// 2. Creamos algunos clientes.
$cliente1 = new Cliente("30.111.222", "Lionel", "Messi");
$cliente2 = new Cliente("35.333.444", "Ángel", "Di María");
$cliente3 = new Cliente("40.555.666", "Julián", "Álvarez");

// 3. Incorporamos los clientes al banco.
echo "--- Incorporando Clientes ---\n";
$bancoNacion->incorporarCliente($cliente1);
echo "Cliente " . $cliente1->getApellido() . " incorporado.\n";
$bancoNacion->incorporarCliente($cliente2);
echo "Cliente " . $cliente2->getApellido() . " incorporado.\n";
$bancoNacion->incorporarCliente($cliente3);
echo "Cliente " . $cliente3->getApellido() . " incorporado.\n\n";

// 4. Creamos cuentas para los clientes.
echo "--- Creando Cuentas ---\n";
// Una Caja de Ahorro para Messi (Nro. Cliente 1)
$bancoNacion->incorporarCajaAhorro($cliente1->getNroCliente());
echo "Caja de Ahorro creada para " . $cliente1->getApellido() . ".\n";

// Una Cuenta Corriente para Di María (Nro. Cliente 2)
$bancoNacion->incorporarCuentaCorriente($cliente2->getNroCliente(), 50000); // Con $50.000 de descubierto
echo "Cuenta Corriente creada para " . $cliente2->getApellido() . ".\n";

// Ambas cuentas para Julián Álvarez (Nro. Cliente 3)
$bancoNacion->incorporarCajaAhorro($cliente3->getNroCliente());
$bancoNacion->incorporarCuentaCorriente($cliente3->getNroCliente(), 10000);
echo "Caja de Ahorro y Cuenta Corriente creadas para " . $cliente3->getApellido() . ".\n\n";

// 5. Mostramos el resumen final del banco.
echo $bancoNacion;
echo "-----------------------------------------\n\n";

// 6. Realizamos operaciones de depósito y retiro.
echo "--- Realizando Operaciones ---\n";
$numCuentaMessi = 1;
$numCuentaDiMaria = 2;

$bancoNacion->realizarDeposito($numCuentaMessi, 100000);
echo "Depósito de $100.000 en la cuenta " . $numCuentaMessi . " (Messi).\n";

$bancoNacion->realizarRetiro($numCuentaDiMaria, 20000);
echo "Retiro de $20.000 de la cuenta " . $numCuentaDiMaria . " (Di María) usando descubierto.\n\n";

// 7. Mostramos el estado de las cuentas después de las operaciones.
echo "--- Estado Final de Cuentas ---\n";
foreach ($bancoNacion->getColeccionCajaAhorro() as $cuenta) {
    echo $cuenta . "\n\n";
}
foreach ($bancoNacion->getColeccionCuentaCorriente() as $cuenta) {
    echo $cuenta . "\n\n";
}
echo "=========================================\n";
