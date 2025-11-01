<?php

include_once 'clase_Persona.php';

//*Crea una clase CuentaBancaria con los siguientes atributos: número de cuenta, el DNI del cliente, 
//*el saldo actual y el interés anual que se aplica a la cuenta. Define en la clase los siguientes métodos:

class CuentaBancaria
{
    private string $numeroCuenta;
    private Persona $cliente; // Ahora es un objeto Persona
    private float $saldoActual;
    private float $interesAnual;


    //*14.a. Método constructor _ _construct() que recibe como parámetros los valores iniciales para los
    //*atributos de la clase.

    public function __construct(string $numeroCuenta, Persona $cliente, float $saldoActual, float $interesAnual)
    {
        $this->numeroCuenta = $numeroCuenta;
        $this->cliente = $cliente;
        $this->saldoActual = $saldoActual;
        $this->interesAnual = $interesAnual;
    }

    //*14.b. Los método de acceso de cada uno de los atributos de la clase.

    public function getNumeroCuenta(): string
    {
        return $this->numeroCuenta;
    }

    public function getCliente(): Persona
    {
        return $this->cliente;
    }

    public function getSaldoActual(): float
    {
        return $this->saldoActual;
    }

    public function getInteresAnual(): float
    {
        return $this->interesAnual;
    }

    public function setNumeroCuenta(string $numeroCuenta): void
    {
        $this->numeroCuenta = $numeroCuenta;
    }

    public function setCliente(Persona $cliente): void
    {
        $this->cliente = $cliente;
    }

    public function setSaldoActual(float $saldoActual): void
    {
        $this->saldoActual = $saldoActual;
    }

    public function setInteresAnual(float $interesAnual): void
    {
        $this->interesAnual = $interesAnual;
    }
    //*14.c. actualizarSaldo(): actualizará el saldo de la cuenta aplicándole el interés diario (interés anual
    //*dividido entre 365 aplicado al saldo actual).

    public function actualizarSaldo(): void
    {
        $interesDiario = $this->interesAnual / 365 / 100; // Convertir porcentaje a decimal
        $this->saldoActual += $this->saldoActual * $interesDiario;
    }
    //*14.d. depositar($cant): permitirá ingresar una cantidad de dinero en la cuenta.

    public function depositar(float $cant): void
    {
        if ($cant > 0) {
            $this->saldoActual += $cant;
        } else {
            throw new InvalidArgumentException("La cantidad a depositar debe ser positiva.");
        }
    }

    //*14.e. retirar($cant): permitirá sacar una cantidad de dinero de la cuenta (si hay saldo).

    public function retirar(float $cant): void
    {
        if ($cant > 0) {
            if ($cant <= $this->saldoActual) {
                $this->saldoActual -= $cant;
            } else {
                throw new RuntimeException("Fondos insuficientes para retirar la cantidad solicitada.");
            }
        } else {
            throw new InvalidArgumentException("La cantidad a retirar debe ser positiva.");
        }
    }

    //*14.f. Redefinir el método _ _toString() para que retorne la información de los atributos de la clase.

    public function __toString(): string
    {
        return sprintf(
            "Número de Cuenta: %s\nCliente: %s %s (DNI: %s)\nSaldo Actual: $%s\nInterés Anual: %.2f%%",
            $this->numeroCuenta,
            $this->cliente->getNombre(),
            $this->cliente->getApellido(),
            $this->cliente->getNumeroDocumento(),
            number_format($this->saldoActual, 2, ',', '.'),
            $this->interesAnual
        );
    }
}

//*14.g. Crear un script Test_CuentaBancaria que cree un objeto CuentaBancaria e invoque a cada
//*uno de los métodos implementados.
