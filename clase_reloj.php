<?php

class Reloj {
    private $horas;
    private $minutos;
    private $segundos;

    /**
     * Constructor que inicializa el reloj en 00:00:00.
     */
    public function __construct() {
        $this->puestaACero();
    }

    /**
     * Reinicia los contadores de horas, minutos y segundos a 0.
     */
    public function puestaACero() {
        $this->horas = 0;
        $this->minutos = 0;
        $this->segundos = 0;
    }

    /**
     * Incrementa el tiempo en un segundo.
     * Gestiona el desbordamiento de segundos a minutos y de minutos a horas.
     * Reinicia el reloj a 00:00:00 después de las 23:59:59.
     */
    public function incremento() {
        $this->segundos++;
        if ($this->segundos == 60) {
            $this->segundos = 0;
            $this->minutos++;
            if ($this->minutos == 60) {
                $this->minutos = 0;
                $this->horas++;
                if ($this->horas == 24) {
                    $this->horas = 0;
                }
            }
        }
    }

    /**
     * Devuelve una representación del tiempo en formato HH:MM:SS.
     * Utiliza sprintf para asegurar el padding con ceros a la izquierda.
     * @return string
     */
    public function __toString() {
        return sprintf('%02d:%02d:%02d', $this->horas, $this->minutos, $this->segundos);
        /** 
         * -%: Este símbolo le dice a sprintf: "¡Atención! Aquí viene un espacio en blanco que tienes que rellenar".
         * -d: Indica el tipo de valor que vamos a insertar. d es por "dígito" o "decimal", y significa que vamos a poner un número entero.
         * -2: Asegúrate de que el número ocupe al menos 2 espacios de ancho.
         * -0: Si el número es más corto que 2 espacios, rellena el espacio sobrante a la izquierda con un cero. 
         * Entonces, %02d significa: "Toma un número entero y formatéalo para que tenga 2 dígitos, añadiendo un cero a la izquierda si es necesario." */
        
    }
}