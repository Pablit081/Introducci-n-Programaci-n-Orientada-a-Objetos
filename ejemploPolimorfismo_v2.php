<?php

abstract class figura
{
    protected $x;
    protected $y;
    protected $icono;

    public function __construct($x, $y, $icono)
    {
        $this->x = $x;
        $this->y = $y;
        $this->icono = $icono;
    }

    public function getCentro()
    {
        return "Centro en: (" . $this->x . ", " . $this->y . ")";
    }

    abstract public function calcularArea();
    abstract public function calcularPerimetro();

    public function toString()
    {
        return $this->icono . " Figura con centro en (" . $this->x . ", " . $this->y . ")";
    }
}

class Circulo extends figura
{
    private $radio;

    public function __construct($x, $y, $r)
    {
        parent::__construct($x, $y, '⚪');
        $this->radio = $r;
    }

    public function calcularArea()
    {
        return pi() * pow($this->radio, 2);
    }

    public function calcularPerimetro()
    {
        return 2 * pi() * $this->radio;
    }

    public function toString()
    {
        return $this->icono . " Círculo. " . $this->getCentro() . " y radio " . $this->radio;
    }
}

class Cuadrado extends figura
{
    private $lado;

    public function __construct($x, $y, $l)
    {
        parent::__construct($x, $y, '⬜');
        $this->lado = $l;
    }

    public function calcularArea()
    {
        return pow($this->lado, 2);
    }

    public function calcularPerimetro()
    {
        return 4 * $this->lado;
    }

    public function toString()
    {
        return $this->icono . " Cuadrado. " . $this->getCentro() . " y lado " . $this->lado;
    }
}

class Triangulo extends figura
{
    private $base;
    private $altura;

    public function __construct($x, $y, $b, $h)
    {
        parent::__construct($x, $y, '🔺');
        $this->base = $b;
        $this->altura = $h;
    }

    public function calcularArea()
    {
        return ($this->base * $this->altura) / 2;
    }

    public function calcularPerimetro()
    {
        // Asumiendo un triángulo rectángulo para simplificar
        $hipotenusa = sqrt(pow($this->base, 2) + pow($this->altura, 2));
        return $this->base + $this->altura + $hipotenusa;
    }

    public function toString()
    {
        return $this->icono . " Triángulo. " . $this->getCentro() . ", base " . $this->base . " y altura " . $this->altura;
    }
}
// Nota: La clase Trapecio no estaba en el archivo de prueba, pero si la necesitas,
// se puede añadir siguiendo el mismo patrón.