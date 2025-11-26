-- ==============================================================
-- SCRIPT DE CREACIÓN: BDPatitasFelices
-- ==============================================================

-- 1. Crear y seleccionar la Base de Datos
CREATE DATABASE IF NOT EXISTS bdpatitasfelices;
USE bdpatitasfelices;

-- ==============================================================
-- SECCIÓN DE LIMPIEZA (RESET)
-- ==============================================================
-- Útil durante desarrollo. Borra TODOS los datos pero deja las tablas vacías.
-- Desactivamos temporalmente la seguridad de claves foráneas para poder borrar sin errores.
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE adopciones;
TRUNCATE TABLE animales;
TRUNCATE TABLE personas;

-- Reactivamos la seguridad
SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================
-- CREACIÓN DE TABLAS
-- ==============================================================

-- 2. Tabla PERSONAS
CREATE TABLE IF NOT EXISTS personas (
    -- CLAVE PRIMARIA (id_persona):
    -- ¿Por qué? Porque necesitamos identificar a cada persona de forma ÚNICA.
    -- Aunque dos personas se llamen "Juan Perez", tendrán ID diferente (ej: 1 y 2).
    -- AUTO_INCREMENT: La base de datos inventa el número sola (1, 2, 3...) para evitar errores humanos.
    id_persona INT AUTO_INCREMENT PRIMARY KEY,
    
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    
    -- DNI UNIQUE: Evita que carguemos dos veces a la misma persona real.
    dni VARCHAR(20) UNIQUE NOT NULL,
    
    telefono VARCHAR(50),
    cantidad_animales_adoptados INT DEFAULT 0
);

-- 3. Tabla ANIMALES
CREATE TABLE IF NOT EXISTS animales (
    -- CLAVE PRIMARIA (id_animal):
    -- ¿Por qué? Igual que arriba, identifica al animal inequívocamente.
    -- Es fundamental para que luego la tabla 'adopciones' pueda apuntar a un animal específico
    -- y no a "ese perro marrón que se parece a otro".
    id_animal INT AUTO_INCREMENT PRIMARY KEY,
    
    nombre VARCHAR(50) NOT NULL,
    edad INT NOT NULL,
    tipo VARCHAR(20) NOT NULL, -- "Perro", "Gato", "Ave"
    estado VARCHAR(20) DEFAULT 'Disponible', 
    
    -- Atributos específicos (Single Table Inheritance)
    raza VARCHAR(50),
    sabe_obediencia TINYINT(1),       
    antecedentes_agresion TINYINT(1), 
    
    color_pelo VARCHAR(50),
    requiere_medicacion TINYINT(1),
    
    puede_volar TINYINT(1),
    tamanio VARCHAR(20)
);

-- 4. Tabla ADOPCIONES (Tabla Intermedia / Transaccional)
CREATE TABLE IF NOT EXISTS adopciones (
    -- CLAVE PRIMARIA (id_adopcion):
    -- ¿Por qué? Cada evento de adopción es único. Si Juan adopta a Firulais hoy,
    -- eso es un "contrato" con su propio número de archivo (ID).
    id_adopcion INT AUTO_INCREMENT PRIMARY KEY,
    
    id_animal INT NOT NULL,
    id_persona INT NOT NULL,
    fecha_adopcion DATE,
    
    -- CLAVES FORÁNEAS (Foreign Keys):
    -- ¿Por qué? Esto garantiza la INTEGRIDAD REFERENCIAL.
    -- 1. No permite crear una adopción con un ID de animal que no existe en la tabla 'animales'.
    -- 2. No permite crear una adopción con un ID de persona que no existe en la tabla 'personas'.
    -- Es decir, conecta esta tabla con las otras dos de forma segura y obligatoria.
    FOREIGN KEY (id_animal) REFERENCES animales(id_animal),
    FOREIGN KEY (id_persona) REFERENCES personas(id_persona)
);

-- ==============================================================
-- DATOS DE PRUEBA (Opcional: Para no arrancar vacíos)
-- ==============================================================

-- Insertamos un animal de ejemplo si la tabla está vacía
INSERT INTO animales (nombre, edad, tipo, estado, raza, sabe_obediencia, antecedentes_agresion) 
VALUES ('Firulais', 3, 'Perro', 'Disponible', 'Mestizo', 1, 0);