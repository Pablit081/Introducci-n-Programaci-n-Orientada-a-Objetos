<?php
// 1. Incluimos todas las clases (El orden importa si no usas autoloader)
require_once 'clase_Animal.php';
require_once 'clase_Perro.php';
require_once 'clase_Gato.php';
require_once 'clase_Ave.php';
require_once 'clase_Persona.php';
require_once 'clase_Adopcion.php';
require_once 'clase_Refugio.php';

echo "--- INICIO DEL TEST SIN BASE DE DATOS ---\n";

// 2. Instanciamos el Refugio (Nuestro gestor)
$miRefugio = new Refugio();
echo "✅ Refugio creado correctamente.\n";

// ---------------------------------------------------------
// CASO 1: LLEGAN ANIMALES AL REFUGIO
// ---------------------------------------------------------
echo "1. Ingreso de Animales\n";

// Perro: Firulais, 3 años, Mestizo, Obediente, SIN agresión
$perro1 = new Perro("Firulais", 3, "Mestizo", true, false);

// Perro: Brutus, 5 años, Doberman, Desobediente, CON agresión (Muerde)
$perro2 = new Perro("Brutus", 5, "Doberman", false, true);

// Gato: Mishi, 2 años, Blanco, SANO
$gato1 = new Gato("Mishi", 2, "Blanco", false);

// Los agregamos al refugio
$miRefugio->agregarAnimal($perro1);
$miRefugio->agregarAnimal($perro2);
$miRefugio->agregarAnimal($gato1);

// Mostramos la lista actual
echo "Animales en el refugio:\n";
foreach ($miRefugio->listarAnimales() as $a) {
    echo "- " . $a->getNombre() . " (" . $a->getTipoAnimal() . ") - Estado: " . ($a->getEstado() ?? "Sin estado") . "\n";
}

// ---------------------------------------------------------
// CASO 2: LLEGA UNA PERSONA INTERESADA
// ---------------------------------------------------------
echo "2. Registro de Persona\n";

$persona1 = new Persona("Juan Perez", "12345678", "555-1234");
$miRefugio->agregarPersona($persona1);

echo "Persona registrada: " . $persona1->getNombrePersona() . "\n";
echo "Animales adoptados hasta ahora: " . $persona1->getCantidadAnimalesAdoptados() . "\n";

// ---------------------------------------------------------
// CASO 3: INTENTO DE ADOPCIÓN EXITOSA (HAPPY PATH)
// ---------------------------------------------------------
echo "3. Intento de Adopción: Juan quiere adoptar a Firulais (El perro bueno)\n";

try {
    // Creamos la adopción
    // Esto internamente valida, cambia estado a "Adoptado" y suma contador a Juan
    $adopcionExitosa = new Adopcion($perro1, $persona1);
    
    // Registramos en el refugio
    $miRefugio->registrarAdopcion($adopcionExitosa);

    echo "🎉 ¡ÉXITO! La adopción se concretó.\n";
    echo "Estado actual de Firulais: " . $perro1->getEstado() . "\n";
    echo "Cantidad de animales de Juan: " . $persona1->getCantidadAnimalesAdoptados() . "\n";

} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}

// ---------------------------------------------------------
// CASO 4: INTENTO DE ADOPCIÓN FALLIDA (ANIMAL AGRESIVO)
// ---------------------------------------------------------
echo "4. Intento de Adopción: Juan quiere adoptar a Brutus (El perro agresivo)\n";

try {
    // Esto debería fallar porque Brutus tiene antecedentesAgresion = true
    $adopcionFallida = new Adopcion($perro2, $persona1);
    
    $miRefugio->registrarAdopcion($adopcionFallida);
    echo "🎉 ¡ÉXITO! (Esto no debería verse)\n";

} catch (Exception $e) {
    // Deberíamos entrar acá
    echo "🛑 BLOQUEO DEL SISTEMA (Correcto): " . $e->getMessage() . "\n";
}

// ---------------------------------------------------------
// RESUMEN FINAL
// ---------------------------------------------------------
echo "--- RESUMEN FINAL ---\n";
echo "Lista de adopciones registradas en el historial del refugio: " . count($miRefugio->listarAdopciones()) . "\n";

?>