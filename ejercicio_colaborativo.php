<?php

// Clase abstracta base
abstract class Fruta {
    protected $nombre;
    protected $color;
    protected $peso;
    protected $origen;

    public function __construct($nombre, $color, $peso, $origen) {
        $this->nombre = $nombre;
        $this->color = $color;
        $this->peso = $peso;
        $this->origen = $origen;
    }

    public function __toString() {
        return "Fruta: {$this->nombre}, Color: {$this->color}, Peso: {$this->peso}g, Origen: {$this->origen}";
    }

    public function esComestible(){
        return true;
    }

    // Método abstracto que cada fruta concreta debe definir
    abstract public function esDeCalidad();
}

//--- Clase Limon ---//

class Limon extends Fruta {
    // Atributos propios de la clase Limon
    protected $nivelDeAcidez;
    protected $numeroDeSemillas;

    /**
     * Constructor para la clase Limon.
     * Asigna valores fijos para nombre, color, peso y origen, y recibe los específicos del limón.
     * @param int $nivelDeAcidez Nivel de acidez (ej: 85).
     * @param int $numeroDeSemillas Cantidad de semillas (ej: 5).
     */
    public function __construct($nivelDeAcidez, $numeroDeSemillas) {
        // Llamamos al constructor de la clase padre (Fruta) con valores predefinidos
        parent::__construct('Limon', 'amarillo', 150, 'Tucumán');

        // Inicializamos las variables de instancia propias de Limon
        $this->nivelDeAcidez = $nivelDeAcidez;
        $this->numeroDeSemillas = $numeroDeSemillas;
    }

    /**
     * Implementación del método abstracto de la clase Fruta.
     * Un limón es de calidad si su acidez es mayor a 80 y tiene menos de 7 semillas.
     * @return bool Devuelve true si es de buena calidad, false en caso contrario.
     */
    public function esDeCalidad() {
        return $this->nivelDeAcidez > 80 && $this->numeroDeSemillas < 7;
    }
}

//--- Clase Manzana ---//

class Manzana extends Fruta {
    // Atributo propio de la clase Manzana
    protected $nivelDeDulzura;

    /**
     * Constructor para la clase Manzana.
     * @param string $color Debe ser 'rojo' o 'verde'.
     * @param int $nivelDeDulzura Nivel de dulzura (ej: 75).
     */
    public function __construct($color, $nivelDeDulzura) {
        // Llamamos al constructor de la clase padre (Fruta)
        parent::__construct('Manzana', $color, 200, 'Río Negro');

        // Inicializamos la variable de instancia propia de Manzana
        $this->nivelDeDulzura = $nivelDeDulzura;
    }

    /**
     * Indica si la manzana es dulce.
     * Una manzana es dulce si es roja y su nivel de dulzura es superior a 50.
     * @return bool Devuelve true si es dulce, false en caso contrario.
     */
    public function esDulce() {
        return $this->color === 'rojo' && $this->nivelDeDulzura > 50;
    }
    
    /**
     * Implementación del método abstracto de la clase Fruta.
     * Para una manzana, consideramos que "es de calidad" si es dulce.
     * @return bool
     */
    public function esDeCalidad() {
        // Reutilizamos la lógica del método esDulce() para determinar la calidad.
        return $this->esDulce();
    }
}


// --- EJEMPLO DE USO --- //

echo "<h3>Evaluando Frutas:</h3>";

// Creamos una instancia de Limon
$limonDeCalidad = new Limon(85, 5); // Acidez > 80 y semillas < 7
echo $limonDeCalidad . "<br>";
if ($limonDeCalidad->esDeCalidad()) {
    echo "<b>Resultado:</b> El limón es de buena calidad. 👍<br>";
} else {
    echo "<b>Resultado:</b> El limón no es de buena calidad. 👎<br>";
}

echo "<hr>";

// Creamos instancias de Manzana
$manzanaDulce = new Manzana('rojo', 70); // Roja y dulzura > 50
echo $manzanaDulce . "<br>";
if ($manzanaDulce->esDulce()) {
    echo "<b>Resultado:</b> La manzana es dulce. 🍎<br>";
} else {
    echo "<b>Resultado:</b> La manzana no es dulce.<br>";
}

echo "<br>";

$manzanaNoDulce = new Manzana('verde', 80); // Verde, no cumple la condición
echo $manzanaNoDulce . "<br>";
if ($manzanaNoDulce->esDulce()) {
    echo "<b>Resultado:</b> La manzana es dulce.<br>";
} else {
    echo "<b>Resultado:</b> La manzana no es dulce. 🍏<br>";
}

?>