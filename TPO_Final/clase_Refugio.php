<?php

require_once 'clase_Animal.php';
require_once 'clase_Persona.php';
require_once 'clase_Adopcion.php';

class Refugio 
{
    // --- 1. El "Almacén" (Arrays) ---
    // Como todavía no estamos metiendo los datos en la base de datos (MariaDB),
    // usaremos estos arrays como si fueran nuestras tablas temporales en memoria.
    private $animales = [];
    private $personas = [];
    private $adopciones = [];

    // --- 2. Gestión de ANIMALES ---

    // Recibimos un objeto de tipo Animal (puede ser Perro, Gato o Ave gracias al polimorfismo)
    public function agregarAnimal(Animal $animal) 
    {
        $this->animales[] = $animal; 
        // Los corchetes [] vacíos significan "agregar al final de la lista".
    }

    public function listarAnimales(): array 
    {
        return $this->animales;
    }

    // Buscamos un animal por su ID único
    public function buscarPorId(int $id) 
    {
        // Recorremos el array de animales uno por uno
        foreach ($this->animales as $animal) {
            // Usamos el getter que definiste en clase_Animal.php
            if ($animal->getId() == $id) {
                return $animal; // ¡Lo encontramos! Devolvemos el objeto.
            }
        }
        return null; // Si termina el bucle y no lo encontró, devuelve nulo.
    }

    // Buscamos por tipo (ej: "Perro", "Gato")
    public function buscarPorTipo(string $tipo): array 
    {
        $resultados = [];
        foreach ($this->animales as $animal) {
            // strcasecmp compara textos ignorando mayúsculas/minúsculas.
            // Si devuelve 0, es que son iguales.
            if (strcasecmp($animal->getTipoAnimal(), $tipo) === 0) {
                $resultados[] = $animal;
            }
        }
        return $resultados;
    }

    // --- 3. Filtros de Estado (Disponibles vs Adoptados) ---

    public function listarDisponibles(): array 
    {
        $disponibles = [];
        foreach ($this->animales as $animal) {
            // Verificamos que el estado NO sea "Adoptado"
            if ($animal->getEstado() !== "Adoptado") {
                $disponibles[] = $animal;
            }
        }
        return $disponibles;
    }

    public function listarAdoptados(): array 
    {
        $adoptados = [];
        foreach ($this->animales as $animal) {
            // Verificamos que el estado SÍ sea "Adoptado"
            if ($animal->getEstado() === "Adoptado") {
                $adoptados[] = $animal;
            }
        }
        return $adoptados;
    }

    // Este método es manual, aunque tu clase Adopcion ya lo hace automáticamente.
    // Lo incluimos porque el enunciado lo pedía explícitamente.
    public function marcarComoAdoptado(int $idAnimal) 
    {
        $animal = $this->buscarPorId($idAnimal); // Reutilizamos nuestro método de búsqueda
        if ($animal != null) {
            $animal->setEstado("Adoptado");
        }
    }

    // --- 4. Gestión de PERSONAS ---

    public function agregarPersona(Persona $persona) 
    {
        $this->personas[] = $persona;
    }

    public function listarPersonas(): array 
    {
        return $this->personas;
    }

    // Método extra muy útil: Buscar persona por DNI para no repetirlas
    public function buscarPersonaPorDni($dni) 
    {
        foreach ($this->personas as $p) {
            if ($p->getDniPersona() == $dni) {
                return $p;
            }
        }
        return null;
    }

    // --- 5. Gestión de ADOPCIONES ---

    public function registrarAdopcion(Adopcion $adopcion) 
    {
        // Aquí solo guardamos el comprobante (el objeto adopción).
        // Recuerda: La lógica de validación (si muerde o no) y el cambio de estado 
        // YA OCURRIÓ dentro del "new Adopcion(...)" antes de llegar acá.
        $this->adopciones[] = $adopcion;
    }

    public function listarAdopciones(): array 
    {
        return $this->adopciones;
    }
}
?>