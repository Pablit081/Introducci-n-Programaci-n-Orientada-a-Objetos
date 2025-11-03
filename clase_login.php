<?php

class Login
{
    // Atributos
    private $nombreUsuario;
    private $contraseña;
    private $fraseRecordatoria;
    private $ultimasContraseñas;

    /**
     * Constructor de la clase Login.
     * @param string $nombreUsuario
     * @param string $contraseñaInicial
     * @param string $fraseRecordatoria
     */
    public function __construct($nombreUsuario, $contraseñaInicial, $fraseRecordatoria)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->contraseña = $contraseñaInicial;
        $this->fraseRecordatoria = $fraseRecordatoria;
        // Al crear el usuario, la única contraseña "usada" es la actual.
        $this->ultimasContraseñas = [$contraseñaInicial];
    }

    // --- Métodos de acceso (Getters) ---
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getUltimasContraseñas()
    {
        return $this->ultimasContraseñas;
    }

    /**
     * Valida si una contraseña coincide con la almacenada.
     * La función devuelve el resultado de esa comparación, que será un valor booleano:
     * true: Si la contraseña ingresada ($password) es exactamente igual a la contraseña guardada ($this->contraseña).
     * false: Si las contraseñas no coinciden.
     * @param string $password
     * @return bool
     */
    public function validarContraseña($password)
    {
        return $this->contraseña === $password;
    }

    /**
     * Cambia la contraseña actual por una nueva.
     * La nueva contraseña no puede estar entre las últimas 4 utilizadas.
     * @param string $nuevaContraseña
     * @param string $nuevaFrase La nueva frase recordatoria.
     * @return bool Devuelve true si el cambio fue exitoso, false en caso contrario.
     */
    public function cambiarContraseña($nuevaContraseña, $nuevaFrase)
    {
        // in_array() verifica si un valor existe en un array.
        if (in_array($nuevaContraseña, $this->ultimasContraseñas)) {
            // La contraseña ya fue usada recientemente, no se puede cambiar.
            return false;
        } else {
            // La contraseña es válida, procedemos con el cambio.

            // 1. Agregamos la nueva contraseña al historial.
            // array_unshift() la añade al principio del array.
            array_unshift($this->ultimasContraseñas, $nuevaContraseña);

            // 2. Nos aseguramos de que el historial no tenga más de 4 contraseñas.
            if (count($this->ultimasContraseñas) > 4) {
                // array_pop() elimina el último elemento del array.
                array_pop($this->ultimasContraseñas);
            }

            // 3. Actualizamos la contraseña actual.
            $this->contraseña = $nuevaContraseña;
            $this->fraseRecordatoria = $nuevaFrase;

            // 4. Indicamos que el cambio fue exitoso.
            return true;
        }
    }

    /**
     * Devuelve la frase recordatoria de la contraseña para este usuario.
     * @return string
     */
    public function recordar()
    {
        return $this->fraseRecordatoria;
    }
}
