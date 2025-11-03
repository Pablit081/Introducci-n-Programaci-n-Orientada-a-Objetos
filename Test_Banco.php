<?php

include_once 'clase_Banco.php';
include_once 'clase_ClienteBanco.php';

echo "=========================================\n";
echo "       Simulador de Atención Bancaria\n";
echo "=========================================\n\n";

// 1. Creamos los mostradores del banco.
$mostrador1 = new Mostrador(['deposito', 'extraccion'], 5);
$mostrador2 = new Mostrador(['prestamo', 'consulta'], 3);
$mostrador3 = new Mostrador(['deposito', 'consulta'], 4);

// 2. Creamos el banco con sus mostradores.
$banco = new Banco([$mostrador1, $mostrador2, $mostrador3]);

echo "--- Estado Inicial del Banco ---\n";
foreach ($banco->getMostradores() as $i => $mostrador) {
    echo "  " . ($i + 1) . ". " . $mostrador . "\n";
}
echo "--------------------------------\n\n";

// 3. Probamos mostradoresQueAtienden()
echo "--- Probando mostradoresQueAtienden() ---\n";
$tramiteConsulta = new Tramite('consulta', new ClienteBanco("Cliente Fantasma")); // Cliente temporal para la prueba
$mostradoresParaConsulta = $banco->mostradoresQueAtienden($tramiteConsulta);
echo "Mostradores que atienden 'consulta': " . count($mostradoresParaConsulta) . "\n";
foreach ($mostradoresParaConsulta as $mostrador) {
    echo "  - " . $mostrador . "\n";
}
echo "-----------------------------------------\n\n";

// 4. Probamos mejorMostradorPara()
echo "--- Probando mejorMostradorPara() ---\n";
$tramiteDeposito = new Tramite('deposito', new ClienteBanco("Cliente Fantasma 2")); // Cliente temporal para la prueba
$mejor = $banco->mejorMostradorPara($tramiteDeposito);
echo "El mejor mostrador para 'deposito' es:\n";
echo "  " . $mejor . "\n";
echo "-------------------------------------\n\n";

// 5. Simulamos la llegada de clientes con el método atender()
echo "--- Simulando llegada de clientes ---\n";
// Primero creamos los clientes
$clienteA = new ClienteBanco("Juan Pérez");
$clienteB = new ClienteBanco("Ana García");
$clienteC = new ClienteBanco("Luis Soto");
$clienteD = new ClienteBanco("Maria Lopez");
$clienteE = new ClienteBanco("Carlos Ruiz");
$clienteF = new ClienteBanco("Laura Pausini");
$clienteG = new ClienteBanco("Ricardo Arjona"); // Este no debería entrar

// Luego, creamos los trámites para cada cliente y los enviamos al banco
$tramiteA = new Tramite('deposito', $clienteA);
$tramiteB = new Tramite('deposito', $clienteB);
$tramiteC = new Tramite('prestamo', $clienteC);
$tramiteD = new Tramite('deposito', $clienteD);
$tramiteE = new Tramite('deposito', $clienteE);
$tramiteF = new Tramite('deposito', $clienteF);
$tramiteG = new Tramite('deposito', $clienteG);

echo $banco->atender($tramiteA) . "\n";
echo $banco->atender($tramiteB) . "\n";
echo $banco->atender($tramiteC) . "\n";
echo $banco->atender($tramiteD) . "\n";
echo $banco->atender($tramiteE) . "\n";
echo $banco->atender($tramiteF) . "\n";
echo "\n" . $banco->atender($tramiteG) . "\n"; // Mensaje de espera
echo "-------------------------------------\n\n";


// 6. Mostramos el estado final del banco.
echo "--- Estado Final del Banco ---\n";
foreach ($banco->getMostradores() as $i => $mostrador) {
    echo "  " . ($i + 1) . ". " . $mostrador . "\n";
}
echo "------------------------------\n\n";

// 7. Simulamos el cierre de algunos trámites
echo "--- Cerrando algunos trámites ---\n";
$mostrador1->cerrarTramite($tramiteA);
echo "Trámite de " . $clienteA->getNombre() . " cerrado.\n";

$mostrador2->cerrarTramite($tramiteC);
echo "Trámite de " . $clienteC->getNombre() . " cerrado.\n";
echo "---------------------------------\n\n";

// 8. Probamos los nuevos métodos de estadísticas
echo "--- Métricas y Estadísticas ---\n";
echo "Porcentaje de trámites resueltos en Mostrador 1: " . number_format($mostrador1->porcentajeTramitesResuelto(), 2) . "%\n";
echo "Porcentaje de trámites resueltos en Mostrador 2: " . number_format($mostrador2->porcentajeTramitesResuelto(), 2) . "%\n";
echo "El mostrador que más resuelve es: \n  " . $banco->mostradorResuelveMasTramites() . "\n";
echo "-------------------------------\n\n";

echo "¡Simulación finalizada!\n";
