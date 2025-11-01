<?php

include_once 'clase_Persona.php';
include_once 'clase_Libro.php';

echo "=========================================\n";
echo "   Prueba de Persona y Libros Leídos\n";
echo "=========================================\n\n";

// 1. Creamos una persona.
$lector = new Persona("Ana", "García", "DNI", "28.123.456");

// 2. Creamos los autores y los libros.
$autorTolkien = new Persona("J.R.R.", "Tolkien", "Pasaporte", "UK-111");
$autorOrwell = new Persona("George", "Orwell", "Pasaporte", "UK-222");

$libro1 = new Libro("978-8445070432", "El Señor de los Anillos", 1954, "Minotauro", $autorTolkien, 1392, "La Comunidad del Anillo debe destruir el Anillo Único.");
$libro2 = new Libro("978-9875666593", "1984", 1949, "Debolsillo", $autorOrwell, 328, "Una novela distópica sobre un futuro totalitario.");
$libro3 = new Libro("978-0345391803", "El Hobbit", 1937, "Minotauro", $autorTolkien, 310, "Un hobbit se embarca en una aventura inesperada.");
$libro4 = new Libro("978-0141182704", "Rebelión en la granja", 1949, "Debolsillo", $autorOrwell, 144, "Una sátira sobre la corrupción del poder.");

// 3. La persona "lee" dos de los libros.
echo "--- Registrando libros leídos ---\n";
$lector->agregarLibroLeido($libro1);
$lector->agregarLibroLeido($libro2);
$lector->agregarLibroLeido($libro4);
echo "Se han registrado 2 libros como leídos para " . $lector->getNombre() . ".\n\n";

// 4. Mostramos la información de la persona (con el __toString() actualizado).
echo "--- Información del Lector ---\n";
echo $lector . "\n";
echo "----------------------------\n\n";

// 5. Probamos el método libroLeido().
echo "--- Verificando lecturas ---\n";

// Prueba 1: Un libro que sí ha leído.
$tituloBuscado1 = "1984";
echo "¿" . $lector->getNombre() . " ha leído '" . $tituloBuscado1 . "'? ";
if ($lector->libroLeido($tituloBuscado1)) {
    echo "Sí.\n";
} else {
    echo "No.\n";
}

// Prueba 2: Un libro que no ha leído.
$tituloBuscado2 = "El Hobbit";
echo "¿" . $lector->getNombre() . " ha leído '" . $tituloBuscado2 . "'? ";
if ($lector->libroLeido($tituloBuscado2)) {
    echo "Sí.\n";
} else {
    echo "No.\n";
}
echo "---------------------------\n\n";

// 6. Probamos el método darSinopsis().
echo "--- Probando darSinopsis() ---\n";
$tituloSinopsis = "1984";
echo "Sinopsis de '" . $tituloSinopsis . "':\n" . $lector->darSinopsis($tituloSinopsis) . "\n\n";

// 7. Probamos el método leidosAnioEdicion().
echo "--- Probando leidosAnioEdicion() ---\n";
$anioBuscado = 1949;
echo "Buscando libros leídos del año " . $anioBuscado . ":\n";
$librosPorAnio = $lector->leidosAnioEdicion($anioBuscado);
if (count($librosPorAnio) > 0) {
    print_r($librosPorAnio);
} else {
    echo "No se encontraron libros de ese año.\n";
}
echo "-----------------------------------\n\n";

// 8. Probamos el método darLibrosPorAutor().
echo "--- Probando darLibrosPorAutor() ---\n";
echo "Buscando libros leídos de George Orwell:\n";
$librosPorAutor = $lector->darLibrosPorAutor("George", "Orwell");
if (count($librosPorAutor) > 0) {
    print_r($librosPorAutor);
} else {
    echo "No se encontraron libros de ese autor.\n";
}
echo "------------------------------------\n\n";

echo "¡Pruebas finalizadas!\n";
