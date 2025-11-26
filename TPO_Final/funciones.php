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

    } while (!ctype_digit($telefono) || strlen($telefono) !== 10);

    return $telefono; // Devuelve el string limpio y validado
}





?>