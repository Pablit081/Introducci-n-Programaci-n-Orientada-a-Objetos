<?php

require_once 'funciones.php'; // Usamos traducirBooleano

function listarTodosLosAnimales($refugio)
{
    echo "\n--- LISTADO COMPLETO DE ANIMALES ---\n";
    
    // Pedimos los datos
    $lista = $refugio->listarAnimales();
    
    // Si la lista está vacía, avisamos
    if (empty($lista))
    {
        echo "📂 No hay animales registrados en el sistema.\n";
        return;
    }

    // Iteramos y mostramos bonito
    foreach ($lista as $a)
    {
        echo "-------------------------------------------------\n";
        echo "[ID: " . $a['id_animal'] . "] " . $a['nombre'] . " (" . $a['tipo'] . ")\n";
        echo "   Estado: " . $a['estado'] . " | Edad: " . $a['edad'] . " años\n";

        // Lógica de visualización específica
        if ($a['tipo'] == 'Perro')
        {
            echo "   🐶 Detalles: Raza " . $a['raza'] . " | Obediente: " . traducirBooleano($a['sabe_obediencia']) . " | Agresivo: " . traducirBooleano($a['antecedentes_agresion']) . "\n";
        }
        elseif ($a['tipo'] == 'Gato')
        {
            echo "   🐱 Detalles: Color " . $a['color_pelo'] . " | Medicación: " . traducirBooleano($a['requiere_medicacion']) . "\n";
        }
        elseif ($a['tipo'] == 'Ave')
        {
            echo "   🐦 Detalles: Tamaño " . $a['tamanio'] . " | Vuela: " . traducirBooleano($a['puede_volar']) . "\n";
        }
    }
    echo "-------------------------------------------------\n";
}
?>