<?php

include_once 'clase_Tramite.php';

/**
 * Clase que representa un Mostrador de atención en el banco.
 */
class Mostrador
{
    /** @var string[] Tipos de trámites que atiende. */
    private array $tiposTramite;
    /** @var Tramite[] Cola de trámites esperando a ser atendidos. */
    private array $colaTramites;
    private int $capacidadMaxima;
    /** @var Tramite[] Historial de todos los trámites recibidos. */
    private array $tramitesRecibidos;

    public function __construct(array $tiposTramite, int $capacidadMaxima)
    {
        $this->tiposTramite = $tiposTramite;
        $this->capacidadMaxima = $capacidadMaxima;
        $this->colaTramites = [];
        $this->tramitesRecibidos = [];
    }

    // --- Métodos de acceso ---
    public function getTiposTramite(): array
    {
        return $this->tiposTramite;
    }
    public function getCapacidadMaxima(): int
    {
        return $this->capacidadMaxima;
    }
    public function getNumeroActualTramites(): int
    {
        return count($this->colaTramites);
    }
    public function getTramitesRecibidos(): array
    {
        return $this->tramitesRecibidos;
    }

    /**
     * Devuelve true o false indicando si el tramite se puede atender en el mostrador.
     * @param Tramite $unTramite
     * @return bool
     */
    public function atiende(Tramite $tramite): bool
    {
        return in_array($tramite->getTipo(), $this->tiposTramite);
    }

    public function tieneEspacio(): bool
    {
        return $this->getNumeroActualTramites() < $this->capacidadMaxima;
    }

    public function agregarTramite(Tramite $tramite): void
    {
        if ($this->tieneEspacio()) {
            $this->colaTramites[] = $tramite;
            $this->tramitesRecibidos[] = $tramite; // Se añade al historial
        }
    }

    /**
     * Cierra un trámite que está en la cola de este mostrador.
     * @param Tramite $tramiteACerrar
     * @return bool True si se pudo cerrar, false si no.
     */
    public function cerrarTramite(Tramite $tramiteACerrar): bool
    {
        $cerrado = false;
        // Buscamos el trámite en la cola y en el historial para cerrarlo.
        foreach ($this->tramitesRecibidos as $tramite) {
            if ($tramite === $tramiteACerrar && $tramite->getEstado() === 'abierto') {
                $tramite->cerrar();
                $cerrado = true;
                break;
            }
        }
        return $cerrado;
    }

    /**
     * Retorna la cantidad promedio de trámites resueltos por día en este mes.
     * @return float
     */
    public function cantTramitesAtendidosMes(): float
    {
        $tramitesResueltosMes = [];
        $mesActual = date('Y-m');

        foreach ($this->tramitesRecibidos as $tramite) {
            if ($tramite->getEstado() === 'cerrado' && $tramite->getFechaCierre()->format('Y-m') === $mesActual) {
                $dia = $tramite->getFechaCierre()->format('d');
                if (!isset($tramitesResueltosMes[$dia])) {
                    $tramitesResueltosMes[$dia] = 0;
                }
                $tramitesResueltosMes[$dia]++;
            }
        }

        if (count($tramitesResueltosMes) === 0) return 0.0;

        $totalTramites = array_sum($tramitesResueltosMes);
        return $totalTramites / count($tramitesResueltosMes);
    }

    /**
     * Da el porcentaje de tramites resueltos sobre el total de recibidos.
     * @return float
     */
    public function porcentajeTramitesResuelto(): float
    {
        $totalRecibidos = count($this->tramitesRecibidos);
        if ($totalRecibidos === 0) return 0.0;

        $totalResueltos = 0;
        foreach ($this->tramitesRecibidos as $tramite) {
            if ($tramite->getEstado() === 'cerrado') {
                $totalResueltos++;
            }
        }
        return ($totalResueltos / $totalRecibidos) * 100;
    }

    public function __toString(): string
    {
        $tipos = implode(', ', $this->tiposTramite);
        return sprintf(
            "Mostrador que atiende: [%s]. Cola: %d/%d.",
            $tipos,
            $this->getNumeroActualTramites(),
            $this->getCapacidadMaxima()
        );
    }
}
