<?php

abstract class figura
{

    protected $x;
    protected $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
    public function getCentro()
    {
        return "Centro en: (" . $this->x . ", " . $this->y . ")";
    }
    abstract public function calcularArea();
    abstract public function calcularPerimetro();
    public function toString()
    {
        return "Figura con centro en (" . $this->x . ", " . $this->y . ")";
    }
}

?>

<?php

class Circulo extends figura
{
    private $radio;

    public function __construct($x, $y, $r)
    {
        parent::__construct($x, $y);
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
        return "Círculo con centro en (" . $this->getCentro() . ") y radio " . $this->radio;
    }
}
?>

<?php
class Cuadrado extends figura
{
    private $lado;

    public function __construct($x, $y, $l)
    {
        parent::__construct($x, $y);
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
        return "Cuadrado con centro en (" . $this->getCentro() . ") y lado " . $this->lado;
    }
}

?>

<?php
class Triangulo extends figura
{
    private $base;
    private $altura;

    public function __construct($x, $y, $b, $h)
    {
        parent::__construct($x, $y);
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
        return "Triángulo con centro en (" . $this->getCentro() . "), base " . $this->base . " y altura " . $this->altura;
    }
}

?>

<?php
class Trapecio extends figura
{
    private $baseMayor;
    private $baseMenor;
    private $altura;

    public function __construct($x, $y, $bMayor, $bMenor, $h)
    {
        parent::__construct($x, $y);
        $this->baseMayor = $bMayor;
        $this->baseMenor = $bMenor;
        $this->altura = $h;
    }

    public function calcularArea()
    {
        return (($this->baseMayor + $this->baseMenor) / 2) * $this->altura;
    }

    public function calcularPerimetro()
    {
        // Asumiendo un trapecio isósceles para simplificar
        $lado = sqrt(pow(($this->baseMayor - $this->baseMenor) / 2, 2) + pow($this->altura, 2));
        return $this->baseMayor + $this->baseMenor + 2 * $lado;
    }

    public function toString()
    {
        return "Trapecio con centro en (" . $this->getCentro() . "), base mayor " . $this->baseMayor . ", base menor " . $this->baseMenor . " y altura " . $this->altura;
    }
}
