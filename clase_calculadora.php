<?php

/**
 * Clase Calculadora
 * Provee métodos para realizar las cuatro operaciones matemáticas básicas.
 * No almacena ningún estado, solo realiza los cálculos.
 */
class Calculadora {

    /**
     * Suma dos números.
     * @param float $num1 El primer número.
     * @param float $num2 El segundo número.
     * @return float El resultado de la suma.
     */
    public function sumar($num1, $num2) {
        return $num1 + $num2;
    }

    /**
     * Resta dos números.
     * @param float $num1 El primer número.
     * @param float $num2 El segundo número.
     * @return float El resultado de la resta.
     */
    public function restar($num1, $num2) {
        return $num1 - $num2;
    }

    /**
     * Multiplica dos números.
     * @param float $num1 El primer número.
     * @param float $num2 El segundo número.
     * @return float El resultado de la multiplicación.
     */
    public function multiplicar($num1, $num2) {
        return $num1 * $num2;
    }

    /**
     * Divide dos números.
     * Incluye una validación para evitar la división por cero.
     * @param float $num1 El dividendo.
     * @param float $num2 El divisor.
     * @return float|string El resultado de la división o un mensaje de error.
     */
    public function dividir($num1, $num2) {
        $resultado = 0;
        if ($num2 != 0) {
            $resultado = $num1 / $num2;
        } else {
            $resultado = "\033[1;41mError: ¡No se puede dividir por cero!\033[0m";
        }
        return $resultado;
    }

    /**
     * Esta clase no necesita un método __toString() porque no representa
     * un objeto con un estado que mostrar. Su propósito es solo operar.
     */
}