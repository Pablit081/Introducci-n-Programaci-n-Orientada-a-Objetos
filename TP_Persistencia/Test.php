<?php

// 1. "Traigan al traductor". Se ejecuta config.php y se crea el objeto $database.
require_once 'config.php';
// 2. "Traigan el plano para construir empleados de tipo Médico". Se incluye la definición de la clase.
require_once 'clase_Medico.php';

// 3. "Creen un nuevo empleado Médico". Se crea el objeto $medico1.
// - Se le pasan sus datos: null, "Maria", "Ardizzone", "Cardiologia".
// - Crucial: Se le pasa el traductor ($database) como primer argumento. El objeto lo guarda en su bolsillo.
$medico1 = new Medico($database, null, "Maria", "Ardizzone", "Cardiologia");

// 4. "¡Empleado, haga su trabajo!". Se llama al método guardar().
// El objeto $medico1 usa el traductor que tiene en su bolsillo para insertar sus propios datos en la BD.
$medico1->guardar();
