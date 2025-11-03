<?php

include 'clase_Cliente.php';

echo "=========================================\n";
echo "     Sistema de Alta de Clientes\n";
echo "=========================================\n";

$clientesCreados = [];

do {
    echo "\n¿Desea agregar un nuevo cliente? (s/n): ";
    $respuesta = strtolower(trim(fgets(STDIN)));

    if ($respuesta === 's') {
        echo "Ingrese el DNI del cliente: ";
        $dni = trim(fgets(STDIN));

        // --- INICIO DE LA VALIDACIÓN ---
        $dniExiste = false;
        foreach ($clientesCreados as $clienteExistente) {
            if ($clienteExistente->getDni() === $dni) {
                $dniExiste = true;
                break; // Si lo encontramos, no hace falta seguir buscando.
            }
        }

        if ($dniExiste) {
            echo "\n\033[1;31mError: Ya existe un cliente con el DNI " . $dni . ". No se puede agregar.\033[0m\n";
            continue; // Saltamos al siguiente ciclo del bucle do-while.
        }
        // --- FIN DE LA VALIDACIÓN ---

        echo "Ingrese el Nombre del cliente: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el Apellido del cliente: ";
        $apellido = trim(fgets(STDIN));

        // Creamos la instancia. Nota que no pasamos el número de cliente.
        $nuevoCliente = new Cliente($dni, $nombre, $apellido);
        $clientesCreados[] = $nuevoCliente;

        echo "\n\033[1;32m¡Cliente creado exitosamente!\033[0m\n";
        echo $nuevoCliente . "\n";
        echo "---------------------------\n";
    }
} while ($respuesta === 's');

echo "\nPrograma finalizado. Se crearon " . count($clientesCreados) . " clientes.\n";
echo "Gracias por usar el sistema.\n";
echo "=========================================\n";
