<?php

include 'ejemploHerenciaMultiple.php';

$pato = new Pato();
echo $pato->quack() . "\n"; // Salida: Quack!
echo $pato->volar() . "\n"; // Salida: Estoy volando!
echo $pato->nadar() . "\n"; // Salida: Estoy nadando!
?>
