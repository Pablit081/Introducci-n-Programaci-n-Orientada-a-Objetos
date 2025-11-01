<?php

trait Volador {
    public function volar() {
        return "Estoy volando!";
    }
}

trait Nadador {
    public function nadar() {
        return "Estoy nadando!";
    }
}

class Pato implements Volador, Nadador {
    public function quack() {
        return "Quack! Quack!";
    }
    public function volar() {
        return Volador::volar();
    }
    public function nadar() {
        return Nadador::nadar();
    
}

}
?>