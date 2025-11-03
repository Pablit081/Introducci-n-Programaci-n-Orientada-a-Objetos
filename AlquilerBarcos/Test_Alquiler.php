<?php

// Incluimos todas las clases que vamos a necesitar.
// El orden no es estrictamente necesario gracias a require_once,
// pero es buena práctica incluir las dependencias primero.
require_once 'Clase_Barco.php'; // La clase base debe ir antes que sus derivadas
require_once 'Clase_Velero.php';
require_once 'Clase_Deportivo.php';
require_once 'Clase_Yate.php';
require_once 'Clase_Cliente.php';
require_once 'Clase_Alquiler.php';

echo "----------------------------------- \n";
echo " Simulación de Alquiler de Amarres \n";
echo "----------------------------------- \n";

// 1. Creamos instancias de los diferentes tipos de barcos.
$miVelero = new Velero("VEL-001", 12.5, 2010, 2);
$miDeportivo = new Deportivo("DEP-002", 8.0, 2022, 300);
$miYate = new Yate("YAT-003", 25.0, 2021, 1200, 4);

// 2. Creamos instancias de los clientes.
$clienteJuan = new Cliente("Juan Pérez", "12.345.678");
$clienteAna = new Cliente("Ana García", "23.456.789");
$clienteCarlos = new Cliente("Carlos Soto", "34.567.890");

// 3. Creamos un alquiler para cada barco, pasando el objeto Cliente.
$alquiler1 = new Alquiler($clienteJuan, 5, "A-01", $miVelero);
$alquiler2 = new Alquiler($clienteAna, 10, "B-05", $miDeportivo);
$alquiler3 = new Alquiler($clienteCarlos, 3, "C-12", $miYate);

// 4. Mostramos la información de cada alquiler.
// El método __toString() de Alquiler se encarga de todo.
echo $alquiler1;
echo $alquiler2;
echo $alquiler3;
