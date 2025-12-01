<?php

require_once 'funciones.php'; // Usamos traducirBooleano

function listarTodasLasPersonas($refugio)
{
    echo textoH1("\n--- 📋 LISTADO COMPLETO DE PERSONAS ---\n\n");
    
    // Pedimos los datos
    $lista = $refugio->listarPersonas();
    
    // Si la lista está vacía, avisamos
    if (empty($lista))
    {
        echo textoError("📂 No hay personas registradas en el sistema.\n");
        return;
    }

    // Iteramos y mostramos bonito
    foreach ($lista as $p)
    {
        echo "--------------------------------------------------------\n";
        echo "[ID: " . $p['id_persona'] . "] " . textoH1($p['nombre']) ." " . textoH1($p['apellido']) ." (DNI: " . $p['dni'] . ")\n";
        echo "  📞 Tel:" . $p['telefono'] . " | 🐾 Adoptados:" . $p['cantidad_animales_adoptados'] . "\n";
    }
    echo "--------------------------------------------------------\n";
}