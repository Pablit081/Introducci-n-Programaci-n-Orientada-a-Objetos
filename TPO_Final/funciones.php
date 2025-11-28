<?php  

// Función que pregunta, valida y convierte a Booleano.
// Devuelve el valor elegido (Boolean).

function pedirConfirmacion($pregunta) {
    // Definimos el array de afirmativos
    $afirmativos = ['yes', 'y', 'si', 's'];
    // Definimos el array de negativos
    $negativos = ['no', 'n'];
    // Unimos ambos arrays para saber qué es válido en general
    $validos = array_merge($afirmativos, $negativos);
    
    $input = "";
    
    // Preguntar hasta que responda algo válido
    do {
        echo $pregunta . " (s/n): ";
        // Normalizamos la entrada (minúsculas y sin espacios)
        $input = strtolower(trim(fgets(STDIN))); 
        // Verificamos si lo que escribió coincide con alguna opción (ignorando mayúsculas)
        if (!in_array($input, $validos)) {
            echo "⚠️  Por favor, responda 'si/yes' o 'no' (o 's'/'n' o 'y'/'n').\n";
        }
    } while (!in_array($input, $validos)); // El bucle se repite MIENTRAS no encontramos la opción.

    // Si está en la lista de afirmativos devuelve TRUE, sino FALSE
    return in_array($input, $afirmativos);
}

// Función que obliga al usuario a elegir una opción de la lista.
// Devuelve el valor elegido (String).

function pedirOpcion($pregunta, $opcionesValidas)
{
    $input = "";
    $encontrado = false;

    // Armamos un string para mostrar las opciones
    $opcionesTexto = implode("/", $opcionesValidas);

    do
    {
        echo $pregunta . " (" . $opcionesTexto . "): ";
        $input = trim(fgets(STDIN));
        
        // Verificamos si lo que escribió coincide con alguna opción (ignorando mayúsculas)
        foreach ($opcionesValidas as $opcion)
        {
            if (strcasecmp($input, $opcion) === 0)
            {
                $input = $opcion; // Normalizamos (si escribió "pequeño", guardamos "Pequeño")
                $encontrado = true;
                break;
            }
        }
        if (!$encontrado) // Si no encontramos la opción
        {
            echo "⚠️  Por favor, responda una de las opciones válidas " . $opcionesTexto .".\n";
        }
    } while (!$encontrado); // El bucle se repite MIENTRAS no encontramos la opción.
    
    return $input;
}

// Función que obliga al usuario a ingresar un DNI válido.
// Aseguramos que sea un número de 8 dígitos.

function pedirDNI()
{
    $dni = "";
    do
    {
        echo "DNI (8 números, sin puntos ni espacios): ";
        $dni = trim(fgets(STDIN));

        // 1. Validar que NO esté vacío y que sean SOLO NÚMEROS
        // ctype_digit devuelve true solo si todos los caracteres son dígitos (0-9)
        if (!ctype_digit($dni)) {
            echo "⚠️  Error: Ingrese solo números (sin puntos ni letras).\n";
            continue; // Fuerza a preguntar de nuevo sin evaluar la longitud todavía
        }

        // 2. Validar LONGITUD EXACTA
        if (strlen($dni) !== 8) {
            echo "⚠️  Error: El DNI debe tener exactamente 8 dígitos.\n";
        }

    } while (!ctype_digit($dni) || strlen($dni) !== 8);

    return $dni; // Devuelve el string limpio y validado
}

// Función que obliga al usuario a ingresar un teléfono válido.
// Aseguramos que sea un número de 10 dígitos.

function pedirTelefono()
{
    $telefono = "";
    do
    {
        echo "Teléfono (10 números, sin puntos, sin guiones ni espacios): ";
        $telefono = trim(fgets(STDIN));

        // 1. Validar que NO esté vacío y que sean SOLO NÚMEROS
        // ctype_digit devuelve true solo si todos los caracteres son dígitos (0-9)
        if (!ctype_digit($telefono)) {
            echo "⚠️  Error: Ingrese solo números.";
            continue; // Fuerza a preguntar de nuevo sin evaluar la longitud todavía
        }

        // 2. Validar LONGITUD EXACTA
        if (strlen($telefono) !== 10) {
            echo "⚠️  Error: El teléfono debe tener exactamente 10 dígitos.";
        }

    } while (!ctype_digit($telefono) || strlen($telefono) !== 10); //

    return $telefono; // Devuelve el string limpio y validado
}

// Traduce el 1 y 0 de la base de datos a "Sí" y "No" visualmente.
function traducirBooleano($valor) {
    // Si el valor es 1 (true), devuelve "Sí". Si es 0 (false), devuelve "No".
    return ($valor == 1) ? "Sí" : "No";
}

// Función que limpia la pantalla.
function limpiarPantalla() 
{
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
    {
        system('cls'); // Función para limpiar pantalla en windows.
    }
    else
    {
        system('clear'); // Función para limpiar pantalla en linux/mac.
    }
}

// Función que muestra el encabezado y el menu principal.
function mostrarMenu() 
{
    limpiarPantalla();
    echo "\n";
    echo "*********************************************************\n";
    echo "*                                                       *\n";
    echo "*   🐾 SISTEMA DE GESTIÓN: REFUGIO PATITAS FELICES 🐾   *\n";
    echo "*                                                       *\n";
    echo "*********************************************************\n\n";
    echo "1. Agregar Animal ➕ (🐶 Perro - 🐱 Gato - 🐦 Ave)\n";
    echo "2. Agregar Persona ➕ 👤\n";
    echo "3. Listar TODOS los animales 📋🐶🐱🐦\n";
    echo "4. Listar TODAS las personas 📋👥\n";
    echo "5. Registrar una ADOPCIÓN ❤️\n";
    echo "6. Mostrar Animales ADOPTADOS 🏠\n";
    echo "7. Mostrar Animales DISPONIBLES 🟢\n";
    echo "8. Ver animales adoptados por una persona (DNI) 🔍\n";
    echo "9. Ver quién adoptó a un animal (ID Animal) 🔍\n";
    echo "10. Ver Totales por Tipo de Animal 📊\n";
    echo "0. Salir 👋\n";
    echo "--------------------------------------------------------\n";
}

function salirPrograma (): void 
{ // Mostramos un mensaje "Saliendo...", seguido de un contador, luego llamamos a la función mensajeFinal() y finalmente limpiamos la pantalla.

    echo "Saliendo";
    usleep(250000);
    echo".";
    usleep(250000);
    echo".";
    usleep(250000);
    echo".";
    usleep(500000);
    echo "\033c";
    mensajeFinal();
    echo "\033c";
}

function mensajeFinal(): void 
{
// Desvanecimiento cambiando los colores gradualmente del mensaje "¡Hasta luego! 👋"
    $colores = // Array de colores
    [
    "\033[1;37m", // blanco negrita
    "\033[97m",   // blanco brillante
    "\033[37m",   // blanco
    "\033[2;97m", // Blanco brillante atenuado
    "\033[2;37m", // Blanco atenuado
    "\033[30m",   // negro 
    "\033[2;90m", // gris oscuro atenuado
    ];

// Desvanecimiento gradual
    foreach ($colores as $color) 
    {
        echo "\r     \r";
        echo $color . "¡Hasta luego! 👋\033[0m";
        usleep(300000); // Pausa antes de cambiar de color
    }
}

function mensajeBienvenida(): void 
{
    limpiarPantalla(); // Usamos tu función para arrancar limpio
    
    echo "\n\n";
    
    // 1. DIBUJO DEL LOGO/TITULO
    // Usamos Cyan Brillante (\033[1;36m)
    echo "\033[1;36m"; 
    echo "       /\\_/\\  \n";
    echo "      ( o.o ) \n";
    echo "       > ^ <  \n";
    echo "\033[0m"; // Reset
    
    echo "\n";

    // 2. EFECTO DE ESCRITURA PARA EL TÍTULO
    $titulo = "   BIENVENIDO AL SISTEMA PATITAS FELICES v1.0";
    echo "\033[1;37m"; // Blanco negrita
    
    // Recorremos el string letra por letra
    $letras = str_split($titulo);
    foreach ($letras as $letra) {
        echo $letra;
        usleep(80000); // 80ms de pausa entre letras (efecto typing)
    }
    echo "\033[0m\n\n";

    // 3. SIMULACIÓN DE CARGA DE SISTEMA
    $tareas = [
        "Cargando módulos de animales...",
        "Despertando a los animales...",
        "Cargando módulos de personas...",
        "Conectando con la Base de Datos...",
        "Cargando módulos de adopción...",
        "¡Sistema Listo!"
    ];

    foreach ($tareas as $tarea) {
        // Imprimimos la tarea en verde tenue
        echo "   \033[0;32m[OK]\033[0m " . $tarea . "\n";
        usleep(3000000); // Pausa de 3 segundos por tarea
    }
    
    sleep(1); // Una pausa final de 1 segundo para leer "Sistema Listo"
    limpiarPantalla(); // Limpiamos todo para mostrar el menú
}
?>


