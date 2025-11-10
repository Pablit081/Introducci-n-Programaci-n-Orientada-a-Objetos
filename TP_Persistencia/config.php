<?php

//  1. Incluimos el "manual de instrucciones" de Medoo.
//  PHP necesita saber qué métodos y clases existen dentro de la librería.

require_once 'Medoo.php';

//  2. Declaramos que vamos a usar la clase "Medoo" de la librería.
//  Es como poner un acceso directo para no tener que escribir su nombre completo siempre.

use \Medoo\Medoo;

// 3. ¡Aquí ocurre la magia! Creamos el objeto Medoo.
$database = new \Medoo\Medoo([ // "new Medoo" es como decir "Contratar un nuevo traductor".
    'database_type' => 'mysql',
    'database_name' => 'bdclinica',
    'server' => 'localhost',
    'username' => 'pabloadmin',
    'password' => 'Mari@2025'
]); 
// Le pasamos sus "credenciales" para que sepa a qué base de datos conectarse.
?>
