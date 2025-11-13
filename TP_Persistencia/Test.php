<?php

// "Traigan al traductor". Se ejecuta config.php y se crea el objeto $database.
require_once 'config.php';

// Inciso 4_Creamos un nuevo paciente y lo guardamos en la BD.
// "Traigan el plano para construir empleados de tipo Médico". Se incluye la definición de la clase.
require_once 'clase_Paciente.php';

//$paciente1 = new Paciente($database, null, "Juan", "Perez", "12345678", "OSDE");

// llamamos a la funcion guardar
//$paciente1->guardar();

// Inciso 5_Actualizamos un paciente a travez de su id y lo guardamos en la BD.
//$pacienteactualizado = new Paciente($database, null, "Juan", "Gomez", "12345678", "OSDE");
//$pacienteactualizado->actualizar(1);

// Inciso 6_Eliminamos un paciente a travez de su id de la BD, siempre y cuando no tenga estudios asociados.
//$database->delete('pacientes', [
 //   'idpaciente' => 2
//]);


// Inciso 7_Creamos un nuevo medico y lo guardamos en la BD.
// "Traigan el plano para construir empleados de tipo Médico". Se incluye la definición de la clase.
require_once 'clase_Medico.php';

// "Creen un nuevo empleado Médico". Se crea el objeto $medico1.
// - Se le pasan sus datos: null, "Maria", "Ardizzone", "MP-0001-0001","Cardiologia".
// - Se le pasa el traductor ($database) como primer argumento. El objeto lo guarda en su bolsillo.

//$medico1 = new Medico($database, null, "Maria", "Ardizzone", "MP-0001-0001","Cardiologia");

// "¡Empleado, haga su trabajo!". Se llama al método guardar().
// El objeto $medico1 usa el traductor que tiene en su bolsillo para insertar sus propios datos en la BD.

//$medico1->guardar();