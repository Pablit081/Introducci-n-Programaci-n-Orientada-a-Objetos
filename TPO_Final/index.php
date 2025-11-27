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

// 1. Instanciar el Refugio
$refugio = new Refugio();

// Función auxiliar para limpiar la pantalla (opcional)
function limpiar() 
{
    echo "\n-------------------------------------------------\n";
}

// Bucle infinito del menú
while (true)
{
    mostrarMenu();

    echo "Ingrese una opción: ";
    $opcion = trim(fgets(STDIN)); // Leemos lo que escribe el usuario

    switch ($opcion) {
        case '1': // AGREGAR ANIMAL
            agregar_Animal($refugio);
            break;

        case '2': // AGREGAR PERSONA
            agregarPersona($refugio);
            break;

        case '3': // LISTAR TODOS ANIMALES
            listarTodosLosAnimales($refugio);
            break;
        
        case '4': // LISTAR TODAS LAS PERSONAS
            listarTodasLasPersonas($refugio);
            break;

        /*case '5': // REGISTRAR ADOPCIÓN
            echo "\n--- NUEVA ADOPCIÓN ---\n";
            echo "Ingrese el ID del Animal a adoptar: ";
            $idAnimal = trim(fgets(STDIN));
            echo "Ingrese el ID de la Persona adoptante: ";
            $idPersona = trim(fgets(STDIN));

            // 1. Recuperamos los objetos desde la BD (Hidratación)
            $objAnimal = $refugio->buscarAnimalPorId($idAnimal);
            $objPersona = $refugio->buscarPersonaPorId($idPersona);

            if ($objAnimal && $objPersona) {
                try {
                    // 2. Intentamos crear la adopción (Esto valida si es agresivo, etc.)
                    // Nota: Debemos asegurarnos que el animal tenga el ID seteado
                    // Como en el constructor de Adopcion usas getId(), tenemos que forzarlo en el objeto temporal
                    // (Esto es un detalle técnico avanzado, pero necesario).
                    // Para simplificar, asumimos que la validación pasa.
                    
                    // Importante: Seteamos manualmente el ID recuperado de la BD al objeto
                    // Para eso necesitamos un setId en clase_Animal (si no lo tenés, agregalo o hacelo public)
                    // $objAnimal->setId($idAnimal); <--- Asegurate de tener esto.

                    $adopcion = new Adopcion($objAnimal, $objPersona);
                    
                    // 3. Persistimos en BD
                    $refugio->registrarAdopcion($adopcion);
                    echo "🎉 ¡ADOPCIÓN EXITOSA! " . $objAnimal->getNombre() . " tiene un nuevo hogar.\n";

                } catch (Exception $e) {
                    echo "❌ ERROR EN LA ADOPCIÓN: " . $e->getMessage() . "\n";
                }
            } else {
                echo "❌ Error: Animal o Persona no encontrados.\n";
            }
            break;

        case '6': // LISTAR ADOPTADOS
            echo "\n--- ANIMALES YA ADOPTADOS ---\n";
            $lista = $refugio->listarAdoptados();
            foreach ($lista as $a) {
                echo "🐶 " . $a['nombre'] . " (" . $a['tipo'] . ")\n";
            }
            break;

        case '7': // LISTAR DISPONIBLES
            echo "\n--- ANIMALES DISPONIBLES PARA ADOPTAR ---\n";
            $lista = $refugio->listarDisponibles();
            foreach ($lista as $a) {
                echo "🟢 [ID: " . $a['id_animal'] . "] " . $a['nombre'] . " (" . $a['tipo'] . ")\n";
            }
            break;

        case '8': // VER POR DNI
            echo "Ingrese el DNI de la persona: ";
            $dni = trim(fgets(STDIN));
            $nombres = $refugio->listarAnimalesPorPersona($dni);
            echo "Animales adoptados por DNI $dni:\n";
            foreach($nombres as $fila) {
                echo "- " . $fila . "\n"; // Medoo devuelve directo el string si pedimos una sola columna
            }
            break;

        case '9': // QUIEN ADOPTÓ A...
            echo "Ingrese el ID del animal: ";
            $idA = trim(fgets(STDIN));
            echo "El adoptante es: " . $refugio->obtenerAdoptanteDeAnimal($idA) . "\n";
            break;

        case '10': // TOTALES POR TIPO
            echo "\n--- ESTADÍSTICAS DEL REFUGIO ---\n";
            $datos = $refugio->totalPorTipo();
            foreach($datos as $fila) {
                echo $fila['tipo'] . ": " . $fila['cantidad'] . "\n";
            }
            break;
*/
        case '0':
            echo "¡Hasta luego! 👋\n";
            exit;
            
        default:
            echo "Opción no válida.\n";
            break;
    }
    
    echo "\n(Presione ENTER para continuar...)";
    fgets(STDIN);
}
?>