<?php

// 1. "Traigan al traductor". Se ejecuta config.php y se crea el objeto $database.
require_once 'config.php';
// 2. "Traigan el plano para construir empleados de tipo Médico". Se incluye la definición de la clase.
require_once 'clase_Medico.php';

// 3. "Creen un nuevo empleado Médico". Se crea el objeto $medico1.
// - Se le pasan sus datos: null, "Maria", "Ardizzone", "MP-0001-0001","Cardiologia".
// - Crucial: Se le pasa el traductor ($database) como primer argumento. El objeto lo guarda en su bolsillo.
//$medico1 = new Medico($database, null, "Juan", "Mendez", 3,"Pediatra");

// 4. "¡Empleado, haga su trabajo!". Se llama al método guardar().
// El objeto $medico1 usa el traductor que tiene en su bolsillo para insertar sus propios datos en la BD.
//$medico1->guardar();

// 4 Creamos un nuevo paciente y lo guardamos en la BD
require_once 'clase_Paciente.php';

//$paciente1 = new Paciente($database, null, "Juan", "Perez", "12345678", "OSDE");

// llamamos a la funcion guardar
//$paciente1->guardar();

$pacienteactualizado = new Paciente($database, null, "Juan", "Gomez", "12345678", "OSDE");
$pacienteactualizado->actualizar(1);

