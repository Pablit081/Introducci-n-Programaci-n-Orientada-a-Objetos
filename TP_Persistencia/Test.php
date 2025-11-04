<?php

require_once 'config.php';
require_once 'clase_Medico.php';

$medico1 = new Medico($database, null, "Maria", "Ardizzone", "12345678", "Cardiologia");
$medico1->guardar();
