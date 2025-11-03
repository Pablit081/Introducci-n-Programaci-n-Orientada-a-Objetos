<?php

include_once 'clase_Mostrador.php';

/**
 * Clase que representa al Banco, gestionando mostradores y clientes.
 */
class Banco
{
    /** @var Mostrador[] Colección de mostradores del banco. */
    private array $mostradores;

    public function __construct(array $mostradores)
    {
        $this->mostradores = $mostradores;
    }

    public function getMostradores(): array
    {
        return $this->mostradores;
    }

    /**
     * Retorna la colección de todos los mostradores que atienden un trámite.
     * @param Tramite $unTramite
     * @return Mostrador[]
     */
    public function mostradoresQueAtienden(Tramite $unTramite): array
    {
        $mostradoresAptos = [];
        foreach ($this->mostradores as $mostrador) {
            if ($mostrador->atiende($unTramite)) {
                $mostradoresAptos[] = $mostrador;
            }
        }
        return $mostradoresAptos;
    }

    /**
     * Retorna el mostrador con la cola más corta con espacio y que atienda el trámite.
     * @param Tramite $unTramite
     * @return Mostrador|null
     */
    public function mejorMostradorPara(Tramite $unTramite): ?Mostrador
    {
        $mostradoresAptos = $this->mostradoresQueAtienden($unTramite);
        $mejorMostrador = null;
        $colaMasCorta = PHP_INT_MAX;

        foreach ($mostradoresAptos as $mostrador) {
            if ($mostrador->tieneEspacio() && $mostrador->getNumeroActualTramites() < $colaMasCorta) {
                $mejorMostrador = $mostrador;
                $colaMasCorta = $mostrador->getNumeroActualTramites();
            }
        }
        return $mejorMostrador;
    }

    /**
     * Atiende a un cliente, ubicándolo en el mejor mostrador posible.
     * @param Tramite $tramite El trámite que el cliente desea realizar.
     * @return string Mensaje con el resultado de la operación.
     */
    public function atender(Tramite $tramite): string
    {
        $unCliente = $tramite->getCliente();
        $mejorMostrador = $this->mejorMostradorPara($tramite);

        if ($mejorMostrador !== null) {
            $mejorMostrador->agregarTramite($tramite);
            return "El cliente " . $unCliente->getNombre() . " ha sido derivado a un mostrador.";
        } else {
            return "El cliente " . $unCliente->getNombre() . " será atendido en cuanto haya lugar en un mostrador.";
        }
    }

    /**
     * Retorna el promedio de trámites ingresados por día.
     * @return float
     */
    public function promTramitesIngresadosDia(): float
    {
        $tramitesPorDia = [];
        $totalTramites = 0;
        foreach ($this->mostradores as $mostrador) {
            foreach ($mostrador->getTramitesRecibidos() as $tramite) {
                $dia = $tramite->getFechaIngreso()->format('Y-m-d');
                if (!isset($tramitesPorDia[$dia])) {
                    $tramitesPorDia[$dia] = 0;
                }
                $tramitesPorDia[$dia]++;
                $totalTramites++;
            }
        }
        if (count($tramitesPorDia) === 0) return 0.0;
        return $totalTramites / count($tramitesPorDia);
    }

    /**
     * Retorna el promedio de trámites cerrados por día.
     * @return float
     */
    public function promTramitesCerradosDia(): float
    {
        $tramitesPorDia = [];
        $totalTramites = 0;
        foreach ($this->mostradores as $mostrador) {
            foreach ($mostrador->getTramitesRecibidos() as $tramite) {
                if ($tramite->getEstado() === 'cerrado') {
                    $dia = $tramite->getFechaCierre()->format('Y-m-d'); // Asumiendo que getFechaCierre no es null
                    if (!isset($tramitesPorDia[$dia])) {
                        $tramitesPorDia[$dia] = 0;
                    }
                    $tramitesPorDia[$dia]++;
                    $totalTramites++;
                }
            }
        }
        if (count($tramitesPorDia) === 0) return 0.0;
        return $totalTramites / count($tramitesPorDia);
    }

    /**
     * Retorna el mostrador con mayor porcentaje de tramites resueltos.
     * @return Mostrador|null
     */
    public function mostradorResuelveMasTramites(): ?Mostrador
    {
        $mejorMostrador = null;
        $maxPorcentaje = -1;

        foreach ($this->mostradores as $mostrador) {
            $porcentaje = $mostrador->porcentajeTramitesResuelto();
            if ($porcentaje > $maxPorcentaje) {
                $maxPorcentaje = $porcentaje;
                $mejorMostrador = $mostrador;
            }
        }
        return $mejorMostrador;
    }

    public function __toString(): string
    {
        return "Banco con " . count($this->mostradores) . " mostradores.";
    }
}
