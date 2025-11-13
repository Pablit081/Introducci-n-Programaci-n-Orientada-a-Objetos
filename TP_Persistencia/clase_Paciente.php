<?php
// Inciso 3_Definición de la clase_Paciente.php

use Medoo\Medoo;

class Paciente
{
    private $bd;
    private $id;
    private $nombre;
    private $apellido;
    private $dni;
    private $obra_social;

    public function __construct($bd, $id, $nombre, $apellido, $dni, $obra_social)
    {
        $this->bd = $bd;
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->obra_social = $obra_social;
    }

    public function guardar()
    {
        $this->bd->insert('pacientes', [
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'obrasocial' => $this->obra_social
        ]);
    }

    public function actualizar($idpaciente)
    {
        $this->bd->update('pacientes', [
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'obrasocial' => $this->obra_social
        ], [
            'idpaciente' => $idpaciente
        ]);
    }

    /*function eliminar paciente por ID, siempre y cuando no tenga estudios asociados.
    // ... (Aquí termina el método ActualizarPaciente)

    /**
     * Intenta eliminar un paciente de la base de datos.
     * Solo elimina si el paciente no tiene estudios asociados.
     *
     * @param int $id_a_eliminar El ID del paciente que se intentará eliminar.
     * @return string Un mensaje indicando el resultado de la operación.
     
    public function eliminarPaciente($id_a_eliminar)
    {
        // 1. VERIFICAR CONDICIÓN: Contamos cuántos estudios tiene este paciente.
        // Usamos el traductor Medoo ($this->bd) que guardamos en el constructor.
        $conteo_estudios = $this->bd->count('estudios', [
            'idpaciente' => $id_a_eliminar
        ]);

        // 2. LÓGICA CONDICIONAL
        if ($conteo_estudios > 0) {
            // Si el conteo es mayor a 0, no podemos eliminarlo.
            return "NO SE PUEDE ELIMINAR: El paciente ID $id_a_eliminar tiene $conteo_estudios estudio(s) registrado(s).";
        }

        // 3. EJECUTAR ELIMINACIÓN: Si el conteo es 0, procedemos.
        $resultado = $this->bd->delete('pacientes', [
            'idpaciente' => $id_a_eliminar
        ]);

        // 4. INFORMAR RESULTADO: Verificamos si la eliminación afectó a alguna fila.
        // rowCount() nos dice cuántas filas se eliminaron.
        if ($resultado->rowCount() > 0) {
            return "ÉXITO: Paciente ID $id_a_eliminar eliminado correctamente.";
        } else {
            // Esto pasa si el IF de arriba dio 0 Y no se encontró el ID (ya estaba borrado o nunca existió).
            return "ERROR: No se encontró ningún paciente con el ID $id_a_eliminar.";
        }
    }
} // <-- Este es el cierre final de tu clase Paciente
*/
    public function eliminar($idpaciente)
    {
        $this->bd->delete('pacientes', [
            'idpaciente' => $idpaciente
        ]);
    }
}

