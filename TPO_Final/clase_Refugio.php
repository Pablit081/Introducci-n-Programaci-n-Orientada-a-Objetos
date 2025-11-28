<?php
require_once 'config.php'; // Importamos la conexión $database
require_once 'clase_Animal.php';
require_once 'clase_Persona.php';
require_once 'clase_Adopcion.php';

class Refugio 
{
    // Ya no necesitamos arrays privados. Usaremos la variable global $database.

    // --- 1. AGREGAR ANIMALES (CORREGIDO) ---
    public function agregarAnimal(Animal $animal) 
    {
        global $database; 

        // 1. Preparamos los datos comunes (Base)
        $datos = [
            "nombre" => $animal->getNombre(),
            "edad" => $animal->getEdad(),
            "tipo" => $animal->getTipoAnimal(),
            "estado" => "Disponible"
        ];

        // 2. Detectamos el tipo y agregamos los datos específicos al array
        if ($animal instanceof Perro) {
            $datos["raza"] = $animal->getRaza();
            // Convertimos el booleano a 1 o 0 para la BD
            $datos["sabe_obediencia"] = $animal->getSabeObediencia() ? 1 : 0;
            $datos["antecedentes_agresion"] = $animal->getAntecedentesAgresion() ? 1 : 0;
        } 
        elseif ($animal instanceof Gato) {
            $datos["color_pelo"] = $animal->getColorPelo();
            $datos["requiere_medicacion"] = $animal->getRequiereMedicacion() ? 1 : 0;
        } 
        elseif ($animal instanceof Ave) {
            $datos["puede_volar"] = $animal->getPuedeVolar() ? 1 : 0;
            $datos["tamanio"] = $animal->getTamanio();
        }

        // 3. Insertamos el array completo en la base de datos
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
        // Buscamos en la BD por ID
        $data = $database->get("animales", "*", ["id_animal" => $id]);
        
        if($data) {
            $animal = null;

            // 1. Reconstruimos el objeto según su tipo (Hidratación)
            // Importante: Convertimos los 1/0 de la BD a true/false para el constructor
            if($data['tipo'] == 'Perro') {
                $animal = new Perro(
                    $data['nombre'], 
                    $data['edad'], 
                    $data['raza'], 
                    $data['sabe_obediencia'] == 1, 
                    $data['antecedentes_agresion'] == 1
                );
            }
            elseif($data['tipo'] == 'Gato') {
                $animal = new Gato(
                    $data['nombre'], 
                    $data['edad'], 
                    $data['color_pelo'], 
                    $data['requiere_medicacion'] == 1
                );
            }
            elseif($data['tipo'] == 'Ave') {
                $animal = new Ave(
                    $data['nombre'], 
                    $data['edad'], 
                    $data['puede_volar'] == 1, 
                    $data['tamanio']
                );
            }

            // 2. Si se creó el objeto, le inyectamos los datos clave
            if ($animal) {
                $animal->setId($data['id_animal']);
                $animal->setEstado($data['estado']); // Recuperamos si ya está adoptado
                return $animal;
            }
        }
        return null;
    }

    public function buscarPersonaPorId($id) {
        global $database;
        $data = $database->get("personas", "*", ["id_persona" => $id]);
        
        if($data)
        {
            $p = new Persona(
                $data['nombre'], 
                $data['apellido'], 
                $data['dni'], 
                $data['telefono']
            );
            
            $p->setId($data['id_persona']); 
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
        
        // Buscamos el animal (Acá ya tenemos su nombre en $animal['nombre'])
        $animal = $database->get("animales", "*", ["id_animal" => $idAnimal]);
        
        if (!$animal || $animal['estado'] !== 'Adoptado') {
            return "El animal no figura como adoptado o no existe.";
        }

        // Buscamos a la persona
        $persona = $database->get("adopciones", 
            [
                "[>]personas" => ["id_persona" => "id_persona"]
            ],
            ["personas.nombre", "personas.apellido"], 
            ["id_animal" => $idAnimal]
        );

        // Agregamos el nombre del animal al array de la persona
        if ($persona) {
            $persona['nombre_animal'] = $animal['nombre'];
            return $persona;
        }

        return "Error al buscar datos de adopción.";
    }

    public function totalPorTipo() {
        global $database;
        // SQL puro es más fácil para agrupar a veces: SELECT tipo, COUNT(*) FROM animales GROUP BY tipo
        return $database->query("SELECT tipo, COUNT(*) as cantidad FROM animales GROUP BY tipo")->fetchAll();
    }
}
?>