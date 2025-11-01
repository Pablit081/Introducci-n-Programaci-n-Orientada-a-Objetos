<?php

include_once 'clase_Cuenta.php';
include_once 'clase_Cliente.php';

/**
 * Clase que representa un Banco, gestionando clientes y sus cuentas.
 */
class Banco
{
    /** @var CuentaCorriente[] Colección de cuentas corrientes. */
    private $coleccionCuentaCorriente;
    /** @var CajaDeAhorro[] Colección de cajas de ahorro. */
    private $coleccionCajaAhorro;
    /** @var int Último valor asignado a una cuenta del banco. */
    private $ultimoValorCuentaAsignado;
    /** @var Cliente[] Colección de clientes del banco. */
    private $coleccionCliente;

    /**
     * Constructor de la clase Banco.
     */
    public function __construct()
    {
        $this->coleccionCuentaCorriente = [];
        $this->coleccionCajaAhorro = [];
        $this->ultimoValorCuentaAsignado = 0;
        $this->coleccionCliente = [];
    }

    // --- Métodos de acceso (Getters y Setters) ---

    public function getColeccionCuentaCorriente()
    {
        return $this->coleccionCuentaCorriente;
    }
    public function setColeccionCuentaCorriente($coleccion)
    {
        $this->coleccionCuentaCorriente = $coleccion;
    }

    public function getColeccionCajaAhorro()
    {
        return $this->coleccionCajaAhorro;
    }
    public function setColeccionCajaAhorro($coleccion)
    {
        $this->coleccionCajaAhorro = $coleccion;
    }

    public function getUltimoValorCuentaAsignado()
    {
        return $this->ultimoValorCuentaAsignado;
    }
    public function setUltimoValorCuentaAsignado($valor)
    {
        $this->ultimoValorCuentaAsignado = $valor;
    }

    public function getColeccionCliente()
    {
        return $this->coleccionCliente;
    }
    public function setColeccionCliente($coleccion)
    {
        $this->coleccionCliente = $coleccion;
    }

    // --- Métodos específicos ---

    /**
     * Agrega un cliente a la colección del banco si no existe previamente.
     * @param Cliente $unCliente
     * @return bool True si se incorporó, false si ya existía.
     */
    public function incorporarCliente(Cliente $unCliente): bool
    {
        $clienteExistente = false;
        foreach ($this->coleccionCliente as $cliente) {
            if ($cliente->getDni() === $unCliente->getDni()) {
                $clienteExistente = true;
                break;
            }
        }

        if (!$clienteExistente) {
            $this->coleccionCliente[] = $unCliente;
            return true;
        }

        return false;
    }

    /**
     * Busca un cliente en la colección por su número de cliente.
     * @param int $numeroCliente
     * @return Cliente|null
     */
    private function buscarClientePorNumero(int $numeroCliente): ?Cliente
    {
        $clienteEncontrado = null;
        foreach ($this->coleccionCliente as $cliente) {
            if ($cliente->getNroCliente() === $numeroCliente) {
                $clienteEncontrado = $cliente;
                break;
            }
        }
        return $clienteEncontrado;
    }

    /**
     * Busca una cuenta en ambas colecciones por su número de cuenta.
     * @param int $numCuenta
     * @return Cuenta|null
     */
    private function buscarCuentaPorNumero(int $numCuenta): ?Cuenta
    {
        $cuentaEncontrada = null;
        // Buscar en Cuentas Corrientes
        foreach ($this->coleccionCuentaCorriente as $cuenta) {
            if ($cuenta->getNumeroCuenta() === $numCuenta) {
                $cuentaEncontrada = $cuenta;
                break;
            }
        }
        // Si no se encontró, buscar en Cajas de Ahorro
        if ($cuentaEncontrada === null) {
            foreach ($this->coleccionCajaAhorro as $cuenta) {
                if ($cuenta->getNumeroCuenta() === $numCuenta) {
                    $cuentaEncontrada = $cuenta;
                    break;
                }
            }
        }
        return $cuentaEncontrada;
    }

    /**
     * Crea y agrega una nueva Cuenta Corriente para un cliente.
     * @param int $numeroCliente
     * @param float $montoDescubierto
     */
    public function incorporarCuentaCorriente(int $numeroCliente, float $montoDescubierto)
    {
        $cliente = $this->buscarClientePorNumero($numeroCliente);
        if ($cliente !== null) {
            $this->ultimoValorCuentaAsignado++;
            $nuevaCuenta = new CuentaCorriente($cliente, 0, $this->ultimoValorCuentaAsignado, $montoDescubierto);
            $this->coleccionCuentaCorriente[] = $nuevaCuenta;
        }
    }

    /**
     * Crea y agrega una nueva Caja de Ahorro para un cliente.
     * @param int $numeroCliente
     */
    public function incorporarCajaAhorro(int $numeroCliente)
    {
        $cliente = $this->buscarClientePorNumero($numeroCliente);
        if ($cliente !== null) {
            $this->ultimoValorCuentaAsignado++;
            $nuevaCuenta = new CajaDeAhorro($cliente, 0, $this->ultimoValorCuentaAsignado);
            $this->coleccionCajaAhorro[] = $nuevaCuenta;
        }
    }

    /**
     * Dado un número de Cuenta y un monto, realiza un depósito.
     * @param int $numCuenta
     * @param float $monto
     * @return bool True si la operación fue exitosa.
     */
    public function realizarDeposito(int $numCuenta, float $monto): bool
    {
        $cuenta = $this->buscarCuentaPorNumero($numCuenta);
        if ($cuenta !== null) {
            return $cuenta->realizarDeposito($monto);
        }
        return false;
    }

    /**
     * Dado un número de Cuenta y un monto, realiza un retiro.
     * @param int $numCuenta
     * @param float $monto
     * @return bool True si la operación fue exitosa.
     */
    public function realizarRetiro(int $numCuenta, float $monto): bool
    {
        $cuenta = $this->buscarCuentaPorNumero($numCuenta);
        if ($cuenta !== null) {
            return $cuenta->realizarRetiro($monto);
        }
        return false;
    }

    public function __toString()
    {
        $info = "--- Resumen del Banco ---\n";
        $info .= "Total de Clientes: " . count($this->coleccionCliente) . "\n";
        $info .= "Total de Cajas de Ahorro: " . count($this->coleccionCajaAhorro) . "\n";
        $info .= "Total de Cuentas Corrientes: " . count($this->coleccionCuentaCorriente) . "\n";
        $info .= "Último Nro de Cuenta Asignado: " . $this->ultimoValorCuentaAsignado . "\n";
        return $info;
    }
}
