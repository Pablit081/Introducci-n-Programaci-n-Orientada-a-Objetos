<?php

// Es fundamental incluir la definición de la clase Cliente, ya que una Cuenta "tiene un" Cliente.
include_once 'clase_Cliente.php';

/**
 * Clase abstracta que representa una Cuenta Bancaria genérica.
 * No puede ser instanciada directamente, sirve como molde para sus clases hijas.
 */
abstract class Cuenta
{
    /** @var int El número único de la cuenta. */
    protected $numeroCuenta;
    /** @var Cliente El dueño de la cuenta. */
    protected $cliente;
    /** @var float El saldo actual de la cuenta. */
    protected $saldo;
    /** @var array Un registro de los movimientos realizados. */
    protected $movimientos;

    /**
     * Constructor de la clase Cuenta.
     * @param Cliente $cliente El objeto Cliente dueño de la cuenta.
     * @param float $saldoInicial El saldo con el que se abre la cuenta.
     * @param int $numeroCuenta El número de la cuenta.
     */
    public function __construct(Cliente $cliente, float $saldoInicial, int $numeroCuenta)
    {
        $this->cliente = $cliente;
        $this->numeroCuenta = $numeroCuenta;
        $this->saldo = $saldoInicial;
        $this->movimientos = [];
        if ($saldoInicial > 0) {
            $this->movimientos[] = "Depósito inicial de $" . number_format($saldoInicial, 2);
        }
    }

    public function getNumeroCuenta(): int
    {
        return $this->numeroCuenta;
    }

    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    /**
     * 1. Retorna el saldo de la cuenta.
     * @return float
     */
    public function saldoCuenta(): float
    {
        return $this->saldo;
    }

    /**
     * 2. Permite realizar un depósito a la cuenta.
     * @param float $monto La cantidad a depositar.
     * @return bool True si la operación fue exitosa.
     */
    public function realizarDeposito(float $monto): bool
    {
        if ($monto > 0) {
            $this->saldo += $monto;
            $this->movimientos[] = "Depósito de $" . number_format($monto, 2);
            return true;
        }
        return false;
    }

    /**
     * 3. Permite realizar un retiro de la cuenta.
     * Este método es abstracto porque la lógica de retiro es diferente para cada tipo de cuenta.
     * @param float $monto La cantidad a retirar.
     * @return bool True si la operación fue exitosa, false en caso contrario.
     */
    abstract public function realizarRetiro(float $monto): bool;

    public function __toString()
    {
        $info = "Nro. Cuenta: " . $this->getNumeroCuenta() . "\n";
        $info .= "Titular: " . $this->cliente->getNombre() . " " . $this->cliente->getApellido() . "\n";
        $info .= "Saldo Actual: $" . number_format($this->saldo, 2);
        return $info;
    }
}

/**
 * Clase que representa una Caja de Ahorro.
 * No permite girar en descubierto.
 */
class CajaDeAhorro extends Cuenta
{
    /**
     * {@inheritdoc}
     * Solo se puede retirar si hay fondos suficientes en el saldo.
     */
    public function realizarRetiro(float $monto): bool
    {
        if ($monto > 0 && $this->saldoCuenta() >= $monto) {
            $this->saldo -= $monto;
            $this->movimientos[] = "Retiro de $" . number_format($monto, 2);
            return true;
        }
        return false;
    }

    public function __toString()
    {
        return "--- Caja de Ahorro ---\n" . parent::__toString();
    }
}

/**
 * Clase que representa una Cuenta Corriente.
 * Permite girar en descubierto hasta un límite.
 */
class CuentaCorriente extends Cuenta
{
    private $montoDescubierto;

    public function __construct(Cliente $cliente, float $saldoInicial, int $numeroCuenta, float $montoDescubierto)
    {
        parent::__construct($cliente, $saldoInicial, $numeroCuenta);
        $this->montoDescubierto = $montoDescubierto;
    }

    /**
     * {@inheritdoc}
     * Se puede retirar si el monto es menor o igual al saldo más el descubierto permitido.
     */
    public function realizarRetiro(float $monto): bool
    {
        $limiteRetiro = $this->saldoCuenta() + $this->montoDescubierto;
        if ($monto > 0 && $limiteRetiro >= $monto) {
            $this->saldo -= $monto;
            $this->movimientos[] = "Retiro de $" . number_format($monto, 2);
            return true;
        }
        return false;
    }

    public function __toString()
    {
        return "--- Cuenta Corriente ---\n" . parent::__toString() . "\nDescubierto: $" . number_format($this->montoDescubierto, 2);
    }
}
