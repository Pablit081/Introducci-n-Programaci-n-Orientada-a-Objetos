<?php

include 'clase_Disquera.php';

echo "=========================================\n";
echo "       Prueba de la Clase Disquera\n";
echo "=========================================\n\n";

// 1. Creamos el objeto Persona que será el dueño.
$dueño = new Persona("Carlos", "Santana", "DNI", "10.987.654");

// 2. Creamos el objeto Disquera. Horario de 9 a 20hs.
$disquera = new Disquera(9, 20, "Av. Siempreviva 742", $dueño);

// 3. Mostramos el estado inicial con __toString().
echo "--- Estado Inicial de la Disquera ---\n";
echo $disquera . "\n";
echo "-------------------------------------\n\n";

// 4. Probamos el método dentroHorarioAtencion().
echo "--- Probando dentroHorarioAtencion() ---\n";
$horaValida = 15;
$horaInvalida = 22;
echo "¿Las " . $horaValida . ":00 están dentro del horario de atención? ";
echo $disquera->dentroHorarioAtencion($horaValida, 0) ? "Sí" : "No";
echo "\n";

echo "¿Las " . $horaInvalida . ":00 están dentro del horario de atención? ";
echo $disquera->dentroHorarioAtencion($horaInvalida, 0) ? "Sí" : "No";
echo "\n----------------------------------------\n\n";

// 5. Probamos el método abrirDisquera().
echo "--- Probando abrirDisquera() ---\n";
echo "Intentando abrir a las " . $horaInvalida . ":00 (horario inválido)...\n";
$disquera->abrirDisquera($horaInvalida, 0);
echo "Estado actual: " . $disquera->getEstado() . "\n\n";

echo "Intentando abrir a las " . $horaValida . ":00 (horario válido)...\n";
$disquera->abrirDisquera($horaValida, 0);
echo "Estado actual: " . $disquera->getEstado() . "\n";
echo "--------------------------------\n\n";

// 6. Probamos el método cerrarDisquera().
echo "--- Probando cerrarDisquera() ---\n";
echo "Intentando cerrar a las " . $horaValida . ":00 (horario inválido para cerrar)...\n";
$disquera->cerrarDisquera($horaValida, 0);
echo "Estado actual: " . $disquera->getEstado() . "\n\n";

echo "Intentando cerrar a las " . $horaInvalida . ":00 (horario válido para cerrar)...\n";
$disquera->cerrarDisquera($horaInvalida, 0);
echo "Estado actual: " . $disquera->getEstado() . "\n";
echo "---------------------------------\n\n";

// 7. Mostramos el estado final.
echo "--- Estado Final de la Disquera ---\n";
echo $disquera . "\n";
echo "-----------------------------------\n\n";

echo "¡Pruebas finalizadas!\n";
