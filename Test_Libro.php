<?php

include 'clase_Libro.php';
// La clase Libro ahora necesita la clase Persona, así que la incluimos también.
include_once 'clase_Persona.php';

echo "=========================================\n";
echo "     Prueba de la Clase Libro (v2)\n";
echo "=========================================\n\n";

// 1. Creamos un objeto Persona para que sea el autor.
$autor = new Persona("George", "Orwell", "Pasaporte", "GBR-12345");

// 2. Creamos el objeto Libro, pasándole el objeto Persona como autor.
$libro = new Libro(
    "978-9875666593",
    "1984",
    1949,
    "Debolsillo",
    $autor,
    328,
    "Una novela distópica sobre un futuro totalitario."
);

echo "--- Prueba del método __toString() ---\n";
// 3. Invocamos el método __toString() implícitamente.
echo $libro . "\n";
echo "-------------------------------------\n\n";

echo "--- Prueba de los métodos de acceso (getters) ---\n";
// 4. Invocamos cada uno de los métodos 'get'.
echo "ISBN: " . $libro->getIsbn() . "\n";
echo "Título: " . $libro->getTitulo() . "\n";
echo "Año: " . $libro->getAnioEdicion() . "\n";
echo "Editorial: " . $libro->getEditorial() . "\n";
echo "Páginas: " . $libro->getCantidadPaginas() . "\n";
echo "Sinopsis: '" . $libro->getSinopsis() . "'\n";
echo "Autor (Nombre Completo): " . $libro->getAutor()->getNombre() . " " . $libro->getAutor()->getApellido() . "\n";
echo "------------------------------------------------\n\n";

echo "¡Pruebas finalizadas!\n";
