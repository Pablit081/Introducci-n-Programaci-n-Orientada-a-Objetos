<?php

require_once 'funciones.php'; // Necesitamos la función traducirBooleano

// Agregamos un segundo parámetro opcional: $filtro
function listarAnimales($refugio, $filtro = 'Todos')
{

    $lista = [];

    // DECIDIMOS QUÉ LISTA TRAER SEGÚN EL FILTRO
    if ($filtro === 'Disponible')
    {
        echo "\n--- 🟢 LISTADO DE ANIMALES DISPONIBLES ---\n";
        $lista = $refugio->listarDisponibles();
    } 
    elseif ($filtro === 'Adoptado')
    {
        echo "\n--- 🏠 LISTADO DE ANIMALES ADOPTADOS ---\n";
        $lista = $refugio->listarAdoptados();
    } 
    else
    {
        // Si no es ni uno ni el otro, trae TODO
        echo "\n--- 📋 LISTADO COMPLETO DE ANIMALES ---\n";
        $lista = $refugio->listarAnimales();
    }
    
    // VALIDACIÓN SI ESTÁ VACÍA
    if (empty($lista))
    {
        echo "📂 No se encontraron animales en esta categoría.\n";
        return;
    }

    // MOSTRAMOS LOS RESULTADOS (Esto es igual para todos)
    foreach ($lista as $a)
    {
        echo "-------------------------------------------------\n";
        echo "[ID: " . $a['id_animal'] . "] " . $a['nombre'] . " (" . $a['tipo'] . ")\n";
        echo "   Estado: " . $a['estado'] . " | Edad: " . $a['edad'] . " años\n";

        // Detectamos tipo para mostrar detalles específicos
        if ($a['tipo'] == 'Perro')
        {
            echo "   🐶 Detalles: Raza " . $a['raza'] . 
                 " | Obediente: " . traducirBooleano($a['sabe_obediencia']) . 
                 " | Agresivo: " . traducirBooleano($a['antecedentes_agresion']) . "\n";
        
        }
        elseif ($a['tipo'] == 'Gato')
        {
            echo "   🐱 Detalles: Color " . $a['color_pelo'] . 
                 " | Medicación: " . traducirBooleano($a['requiere_medicacion']) . "\n";
        
        }
        elseif ($a['tipo'] == 'Ave')
        {
            echo "   🐦 Detalles: Tamaño " . $a['tamanio'] . 
                 " | Vuela: " . traducirBooleano($a['puede_volar']) . "\n";
        }
    }
    echo "-------------------------------------------------\n";
}
?>