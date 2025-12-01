<?php
// index.php - Programa Principal

require_once 'clase_Refugio.php';
require_once 'clase_Perro.php';
require_once 'clase_Gato.php';
require_once 'clase_Ave.php';
require_once 'clase_Persona.php';
require_once 'clase_Adopcion.php';
require_once 'funciones.php';
require_once 'agregar_Animal.php';
require_once 'agregar_Persona.php';
require_once 'listar_Animales.php';
require_once 'listar_Personas.php';
require_once 'registrar_Adopcion.php';
require_once 'consultas_Extras.php';

// 1. Instanciar el Refugio
$refugio = new Refugio();

mensajeBienvenida();

// Bucle infinito del menú
while (true)
{
    mostrarMenu();

    echo textoResaltado("Ingrese una opción: ");
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case '1': // AGREGAR ANIMAL
            agregar_Animal($refugio);
            break;

        case '2': // AGREGAR PERSONA
            agregarPersona($refugio);
            break;

        case '3': // LISTAR TODOS ANIMALES
            listarAnimales($refugio, 'Todos');
            break;
        
        case '4': // LISTAR TODAS LAS PERSONAS
            listarTodasLasPersonas($refugio);
            break;

        case '5': // REGISTRAR ADOPCIÓN
            registrar_Adopcion($refugio);
            break;

        case '6': // LISTAR ADOPTADOS
            listarAnimales($refugio, 'Adoptado');
            break;

        case '7': // LISTAR DISPONIBLES
            listarAnimales($refugio, 'Disponible');
            break;

        case '8': // Vemos qué animales adoptó una persona con DNI xxx
            verAnimalesPorPersona($refugio);
            break;

        case '9': // Vemos qué persona adoptó un animal segun su ID
            verAdoptanteDeAnimal($refugio);
            break;

        case '10': // ESTADISTICAS
            verTotalesPorTipo($refugio);
            break;

        case '0':
            salirPrograma();
            exit;
            
        default:
            echo "Opción no válida.\n";
            break;
    }
    
    echo "\n(Presione ENTER para continuar...)";
    fgets(STDIN);
}
?>