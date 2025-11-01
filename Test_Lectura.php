<?php

include_once 'clase_Lectura.php';
// Como Lectura usa Libro, y Libro usa Persona, necesitamos incluir todo.
include_once 'clase_Libro.php';
include_once 'clase_Persona.php';

echo "=========================================\n";
echo "       Prueba de la Clase Lectura\n";
echo "=========================================\n\n";

// 1. Creamos los objetos necesarios (Autor y Libro).
$autor = new Persona("J.R.R.", "Tolkien", "Pasaporte", "UK-123");
$libro = new Libro(
    "978-0345391803",
    "El Hobbit",
    1937,
    "Minotauro",
    $autor,
    310,
    "Un hobbit se embarca en una aventura inesperada."
);

// 2. Creamos el objeto Lectura, iniciando en la página 50.
$miLectura = new Lectura($libro, 50);

// 3. Mostramos el estado inicial con __toString().
echo "--- Estado Inicial ---\n";
echo $miLectura . "\n";
echo "----------------------\n\n";

// 4. Probamos el método siguientePagina().
echo "--- Avanzando una página ---\n";
$nuevaPagina = $miLectura->siguientePagina();
echo "Ahora estás en la página: " . $nuevaPagina . "\n";
echo $miLectura . "\n";
echo "---------------------------\n\n";

// 5. Probamos el método retrocederPagina().
echo "--- Retrocediendo una página ---\n";
$nuevaPagina = $miLectura->retrocederPagina();
echo "Ahora estás en la página: " . $nuevaPagina . "\n";
echo $miLectura . "\n";
echo "------------------------------\n\n";

// 6. Probamos el método irPagina(x).
$paginaDestino = 125;
echo "--- Saltando a la página " . $paginaDestino . " ---\n";
$paginaAnterior = $miLectura->irPagina($paginaDestino);
echo "Estabas en la página " . $paginaAnterior . ".\n";
echo "Ahora estás en la página: " . $miLectura->getPaginaActual() . "\n";
echo $miLectura . "\n";
echo "--------------------------------\n\n";

echo "¡Pruebas finalizadas!\n";
