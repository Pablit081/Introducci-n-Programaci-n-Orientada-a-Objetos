<?php
// index.php - Programa Principal

require_once 'clase_Refugio.php';
require_once 'clase_Perro.php';
require_once 'clase_Gato.php';
require_once 'clase_Ave.php';
require_once 'clase_Persona.php';
require_once 'clase_Adopcion.php';

// 1. Instanciar el Refugio
$refugio = new Refugio();

// Función auxiliar para limpiar la pantalla (opcional)
function limpiar() {
    // system('clear'); // En Linux/Mac
    // system('cls'); // En Windows
    echo "\n-------------------------------------------------\n";
}

// Bucle infinito del menú
while (true) {
    limpiar();
    echo "=== 🐾 SISTEMA DE GESTIÓN: REFUGIO PATITAS FELICES 🐾 ===\n";
    echo "1. Agregar Animal (Perro, Gato o Ave)\n";
    echo "2. Agregar Persona\n";
    echo "3. Listar TODOS los animales\n";
    echo "4. Listar todas las personas\n";
    echo "5. Registrar una ADOPCIÓN ❤️\n";
    echo "6. Mostrar Animales ADOPTADOS\n";
    echo "7. Mostrar Animales DISPONIBLES\n";
    echo "8. Ver animales adoptados por una persona (DNI)\n";
    echo "9. Ver quién adoptó a un animal (ID Animal)\n";
    echo "10. Ver Totales por Tipo de Animal\n";
    echo "0. Salir\n";
    echo "-------------------------------------------------\n";
    echo "Ingrese una opción: ";
    
    $opcion = trim(fgets(STDIN)); // Leemos lo que escribe el usuario

    switch ($opcion) {
        case '1': // AGREGAR ANIMAL
            echo "\n¿Qué tipo de animal? (1-Perro, 2-Gato, 3-Ave): ";
            $tipo = trim(fgets(STDIN));
            echo "Nombre: "; $nom = trim(fgets(STDIN));
            echo "Edad: "; $edad = trim(fgets(STDIN));

            if ($tipo == '1') { // Perro
                echo "Raza: "; $raza = trim(fgets(STDIN));
                // Simplificamos booleanos con (s/n)
                echo "¿Sabe obediencia? (s/n): "; $obe = (trim(fgets(STDIN)) == 's');
                echo "¿Es agresivo? (s/n): "; $agr = (trim(fgets(STDIN)) == 's');
                
                $nuevoAnimal = new Perro($nom, $edad, $raza, $obe, $agr);
                $refugio->agregarAnimal($nuevoAnimal);
                echo "✅ ¡Perro agregado con éxito!\n";

            } elseif ($tipo == '2') { // Gato
                echo "Color de Pelo: "; $color = trim(fgets(STDIN));
                echo "¿Requiere medicación? (s/n): "; $med = (trim(fgets(STDIN)) == 's');
                
                $nuevoAnimal = new Gato($nom, $edad, $color, $med);
                $refugio->agregarAnimal($nuevoAnimal);
                echo "✅ ¡Gato agregado con éxito!\n";
            
            } elseif ($tipo == '3') { // Ave
                echo "¿Puede volar? (s/n): "; $vuela = (trim(fgets(STDIN)) == 's');
                echo "Tamaño (Pequeño/Grande): "; $tam = trim(fgets(STDIN));
                
                $nuevoAnimal = new Ave($nom, $edad, $vuela, $tam);
                $refugio->agregarAnimal($nuevoAnimal);
                echo "✅ ¡Ave agregada con éxito!\n";
            }
            break;

        case '2': // AGREGAR PERSONA
            echo "Nombre completo: "; $nom = trim(fgets(STDIN));
            echo "DNI: "; $dni = trim(fgets(STDIN));
            echo "Teléfono: "; $tel = trim(fgets(STDIN));
            
            $nuevaPersona = new Persona($nom, $dni, $tel);
            $refugio->agregarPersona($nuevaPersona);
            echo "✅ ¡Persona registrada con éxito!\n";
            break;

        case '3': // LISTAR TODOS ANIMALES
            echo "\n--- LISTADO COMPLETO DE ANIMALES ---\n";
            $lista = $refugio->listarAnimales();
            foreach ($lista as $a) {
                echo "[ID: " . $a['id_animal'] . "] " . $a['nombre'] . " (" . $a['tipo'] . ") - Estado: " . $a['estado'] . "\n";
            }
            break;

        case '4': // LISTAR PERSONAS
            echo "\n--- LISTADO DE PERSONAS ---\n";
            $lista = $refugio->listarPersonas();
            foreach ($lista as $p) {
                echo "[ID: " . $p['id_persona'] . "] " . $p['nombre'] . " (DNI: " . $p['dni'] . ")\n";
            }
            break;

        case '5': // REGISTRAR ADOPCIÓN
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