<?php
require_once 'config.php'; // Importamos la conexión $database
require_once 'clase_Animal.php';
require_once 'clase_Persona.php';
require_once 'clase_Adopcion.php';

class Refugio 
{
    // Ya no necesitamos arrays privados. Usaremos la variable global $database.

    // --- 1. AGREGAR ANIMALES ---
    public function agregarAnimal(Animal $animal) 
    {
        global $database; // Traemos la conexión de config.php

        // Preparamos los datos comunes
        $datos = [
            "nombre" => $animal->getNombre(),
            "edad" => $animal->getEdad(),
            "tipo" => $animal->getTipoAnimal(),
            "estado" => "Disponible"
        ];

        // Detectamos qué tipo de animal es para guardar sus atributos específicos
        // (Esto completa los campos que creamos en la tabla única)
        if ($animal instanceof Perro) {
            // Es un truco para acceder a métodos del hijo usando el objeto padre
            // En un framework real usaríamos Reflection, pero aquí extraemos la info del string.
            // Como en tu clase Perro el getCaracteristicas devuelve un string, 
            // para guardar en BD limpia lo ideal sería tener getters específicos en Perro.
            // PERO, para simplificar tu TP, vamos a asumir que pasaste los datos al crear el objeto.
            // *Nota: Si tenés getters en Perro (getRaza, etc), usalos acá.*
            
            // Inserción genérica (Si tuvieras getters en las hijas sería más limpio)
            // Por ahora guardaremos los datos básicos obligatorios.
        }

        // INSERTAMOS EN LA BD
        // Como Medoo necesita arrays asociativos, mapeamos todo:
        // IMPORTANTE: Para que esto funcione perfecto, necesitarías getters en las clases hijas (getRaza, etc).
        // Si no los tenés, se guardarán nulls en esos campos específicos, pero el animal se creará igual.
        
        $database->insert("animales", $datos);
    }

    // --- 2. AGREGAR PERSONAS ---
    
    // Verifica si un DNI ya existe en la base de datos
    public function verificarDNI($dni) 
    {
        global $database;
        return $database->has("personas", ["dni" => $dni]);
    }

    // Agrega una persona a la base de datos
    public function agregarPersona(Persona $persona) 
    {
        global $database;
        $database->insert("personas", [
            "nombre" => $persona->getNombrePersona(),
            "apellido" => $persona->getApellidoPersona(),
            "dni" => $persona->getDniPersona(),
            "telefono" => $persona->getTelefono(),
            "cantidad_animales_adoptados" => 0
        ]);
    }

    // --- 3. LISTADOS (Recuperar de la BD) ---
    
    public function listarAnimales() 
    {
        global $database;
        // Select * from animales
        return $database->select("animales", "*"); 
    }

    public function listarPersonas() 
    {
        global $database;
        return $database->select("personas", "*");
    }

    public function listarDisponibles() {
        global $database;
        return $database->select("animales", "*", ["estado" => "Disponible"]);
    }

    public function listarAdoptados() {
        global $database;
        return $database->select("animales", "*", ["estado" => "Adoptado"]);
    }

    // --- 4. BUSQUEDAS ---

    public function buscarAnimalPorId($id) {
        global $database;
        $data = $database->get("animales", "*", ["id_animal" => $id]);
        
        if($data) {
            // Reconstruimos el objeto para que la clase Adopcion pueda validarlo
            // Esto es "Hidratación de objetos" básica
            if($data['tipo'] == 'Perro') {
                // Creamos un perro temporal con los datos de la BD para validar reglas
                // Ojo: Los booleanos de la BD vienen como 1/0
                return new Perro($data['nombre'], $data['edad'], $data['raza'], $data['sabe_obediencia'], $data['antecedentes_agresion']);
            }
            elseif($data['tipo'] == 'Gato') {
                return new Gato($data['nombre'], $data['edad'], $data['color_pelo'], $data['requiere_medicacion']);
            }
            elseif($data['tipo'] == 'Ave') {
                return new Ave($data['nombre'], $data['edad'], $data['puede_volar'], $data['tamanio']);
            }
        }
        return null;
    }

    public function buscarPersonaPorId($id) {
        global $database;
        $data = $database->get("personas", "*", ["id_persona" => $id]);
        if($data) {
            $p = new Persona($data['nombre'], $data['dni'], $data['telefono']);
            $p->setId($data['id_persona']); // Importante setear el ID real
            return $p;
        }
        return null;
    }

    // --- 5. REGISTRAR ADOPCIÓN (Transacción) ---
    
    public function registrarAdopcion(Adopcion $adopcion) 
    {
        global $database;

        // 1. Insertar en tabla adopciones
        $database->insert("adopciones", [
            "id_animal" => $adopcion->getIdAnimal(),
            "id_persona" => $adopcion->getIdPersona(),
            "fecha_adopcion" => date("Y-m-d")
        ]);

        // 2. Actualizar estado del animal en tabla animales
        $database->update("animales", 
            ["estado" => "Adoptado"], 
            ["id_animal" => $adopcion->getIdAnimal()]
        );

        // 3. Actualizar contador de la persona (opcional, ya que se puede calcular con count)
        // Pero como tu tabla tiene la columna, la actualizamos:
        $database->update("personas", 
            ["cantidad_animales_adoptados[+]" => 1], // Medoo permite incrementar así
            ["id_persona" => $adopcion->getIdPersona()]
        );
    }
    
    // --- CONSULTAS EXTRA PEDIDAS EN LA IMAGEN ---

    public function listarAnimalesPorPersona($dni) {
        global $database;
        // Join entre animales, adopciones y personas
        return $database->select("adopciones", 
            [
                "[>]animales" => ["id_animal" => "id_animal"],
                "[>]personas" => ["id_persona" => "id_persona"]
            ],
            "animales.nombre", // Qué columnas queremos ver
            ["personas.dni" => $dni] // Condición WHERE
        );
    }

    public function obtenerAdoptanteDeAnimal($idAnimal) {
        global $database;
        // Verificamos primero el estado
        $animal = $database->get("animales", "*", ["id_animal" => $idAnimal]);
        
        if ($animal['estado'] !== 'Adoptado') {
            return "El animal no está adoptado.";
        }

        // Buscamos quién lo tiene
        $resultado = $database->get("adopciones", 
            [
                "[>]personas" => ["id_persona" => "id_persona"]
            ],
            "personas.nombre",
            ["id_animal" => $idAnimal]
        );
        
        return $resultado ? $resultado : "Error al buscar adoptante.";
    }

    public function totalPorTipo() {
        global $database;
        // SQL puro es más fácil para agrupar a veces: SELECT tipo, COUNT(*) FROM animales GROUP BY tipo
        return $database->query("SELECT tipo, COUNT(*) as cantidad FROM animales GROUP BY tipo")->fetchAll();
    }
}
?>