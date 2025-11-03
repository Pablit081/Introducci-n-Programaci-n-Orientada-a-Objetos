<?php

class Fecha {
    private $dia;
    private $mes;
    private $anio;

    public function __construct($dia, $mes, $anio) {
        $this->dia = $dia;
        $this->mes = $mes;
        $this->anio = $anio;
    }

    // Metodos de acceso (getters y setters)
    public function getDia() {return $this->dia;}
    public function getMes() {return $this->mes;}
    public function getAnio() {return $this->anio;}
    public function setDia ($dia) {$this->dia = $dia;}
    public function setMes ($mes) {$this->mes = $mes;}   
    public function setAnio ($anio) {$this->anio = $anio;}

    /**
     * Devuelve la fecha en formato corto: DD/MM/AAAA
     * @return string
     */
    public function toStringAbreviado() {
        return sprintf('%02d/%02d/%04d', $this->dia, $this->mes, $this->anio);
    }

    /**
     * Devuelve la fecha en formato extendido: DD de Mes de AAAA
     * @return string
     */
    public function toStringExtendido() {
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        return sprintf('%02d de %s de %04d', $this->dia, $meses[$this->mes], $this->anio);  
    }

    /**
     * Verifica si el año de la fecha es bisiesto.
     * Un año es bisiesto si es múltiplo de 4, excepto los múltiplos de 100 que no son múltiplos de 400.
     * @return bool
     */
    private function esBisiesto($anio) {
        return ($anio % 4 == 0 && $anio % 100 != 0) || ($anio % 400 == 0);
    }

    //Incrementa la fecha en un día
    public function incrementaUnDia() {
        $diasxMes = [1 => 31, 2=> 28, 3=>31, 4=>30, 5=>31, 6=>30, 7=>31, 8=>31, 9=>30, 10=>31, 11=>30, 12=>31];
        if ($this->esBisiesto($this->anio)) {
            $diasxMes[2] = 29; // Febrero tiene 29 días en años bisiestos
        }
        $this->dia++;
        // Si el día supera el máximo del mes actual
        if ($this->dia > $diasxMes[$this->mes]) {
            $this->dia = 1; // Reiniciamos el día
            $this->mes++; // y avanzamos al siguiente mes
            // Si el mes supera diciembre...
            if ($this->mes > 12) {
                $this->mes = 1; // Reiniciamos el mes a enero
                $this->anio++; // y avanzamos al siguiente año
            }
        }
    }

    /**
     * Retorna una NUEVA fecha incrementada en N días.
     * @param int $n
     * @return Fecha
     */
    public function incremento($n) {
        // Creamos un clon para no modificar la fecha original
        $nuevaFecha = clone $this;
        for ($i = 0; $i < $n; $i++) {
            $nuevaFecha->incrementaUnDia();
        }
        return $nuevaFecha;
    }
}


