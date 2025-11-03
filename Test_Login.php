<?php

include 'clase_login.php';

// Variable para almacenar el objeto Login del usuario actual.
$usuariosRegistrados = [];
$usuarioLogueado = null;

echo "=========================================\n";
echo "     Sistema de Prueba de Login\n";
echo "=========================================\n";

do {
    if ($usuarioLogueado === null) {
        // --- MENÚ PRINCIPAL (SIN SESIÓN INICIADA) ---
        echo "\n--- MENÚ PRINCIPAL ---\n";
        echo "1. Acceder al sistema\n";
        echo "2. Crear nuevo usuario\n";
        echo "0. Salir\n";
        echo "Elija una opción: ";
        $opcion = trim(fgets(STDIN));

        switch ($opcion) {
            case '1': // Acceder al sistema
                echo "\n--- Acceso al Sistema ---\n";
                if (count($usuariosRegistrados) === 0) {
                    echo "\n\033[1;33mNo hay usuarios registrados. Por favor, cree uno primero (Opción 2).\033[0m\n";
                    break;
                }
                echo "Ingrese nombre de usuario: ";
                $nombre = trim(fgets(STDIN));
                echo "Ingrese contraseña: ";
                $pass = trim(fgets(STDIN));

                $usuarioEncontrado = null;
                foreach ($usuariosRegistrados as $usuario) {
                    if ($usuario->getNombreUsuario() === $nombre) {
                        $usuarioEncontrado = $usuario;
                        break;
                    }
                }

                if ($usuarioEncontrado && $usuarioEncontrado->validarContraseña($pass)) {
                    $usuarioLogueado = $usuarioEncontrado;
                    echo "\n\033[1;32m¡Bienvenido, " . $usuarioLogueado->getNombreUsuario() . "!\033[0m\n";
                } else {
                    echo "\n\033[1;31mUsuario o contraseña incorrectos.\033[0m\n";
                }
                break;

            case '2': // Crear nuevo usuario
                echo "\n--- Crear Nuevo Usuario ---\n";
                echo "Ingrese el nombre de usuario: ";
                $nombre = trim(fgets(STDIN));

                $nombreExiste = false;
                foreach ($usuariosRegistrados as $usuario) {
                    if ($usuario->getNombreUsuario() === $nombre) {
                        $nombreExiste = true;
                        break;
                    }
                }

                if ($nombreExiste) {
                    echo "\n\033[1;31mError: El nombre de usuario '" . $nombre . "' ya existe.\033[0m\n";
                } else {
                    echo "Ingrese la contraseña inicial: ";
                    $pass = trim(fgets(STDIN));
                    echo "Ingrese una frase para recordar la contraseña: ";
                    $frase = trim(fgets(STDIN));

                    $nuevoUsuario = new Login($nombre, $pass, $frase);
                    $usuariosRegistrados[$nombre] = $nuevoUsuario;
                    echo "\n\033[1;32m¡Usuario '" . $nombre . "' creado exitosamente!\033[0m\n";
                }
                break;

            case '0': // Salir
                break; // El bucle se encargará de salir

            default:
                echo "\n\033[1;31mOpción no válida. Por favor, intente de nuevo.\033[0m\n";
                break;
        }
    } else {
        // --- MENÚ DE USUARIO (SESIÓN INICIADA) ---
        echo "\n--- MENÚ DE USUARIO: " . $usuarioLogueado->getNombreUsuario() . " ---\n";
        echo "1. Cambiar contraseña\n";
        echo "2. Recordar contraseña (mostrar pista)\n";
        echo "3. Ver historial de contraseñas\n";
        echo "4. Cerrar sesión\n";
        echo "0. Salir del programa\n";
        echo "Elija una opción: ";
        $opcion = trim(fgets(STDIN));

        switch ($opcion) {
            case '1': // Cambiar contraseña
                echo "\n--- Cambiar Contraseña ---\n";
                echo "Ingrese la nueva contraseña: ";
                $nuevaPass = trim(fgets(STDIN));
                echo "Ingrese la nueva frase recordatoria: ";
                $nuevaFrase = trim(fgets(STDIN));

                if ($usuarioLogueado->cambiarContraseña($nuevaPass, $nuevaFrase)) {
                    echo "\n\033[1;32m¡Contraseña cambiada exitosamente!\033[0m\n";
                } else {
                    echo "\n\033[1;31mError: La contraseña ya ha sido utilizada recientemente. Elija otra.\033[0m\n";
                }
                break;

            case '2': // Recordar contraseña
                echo "\n--- Pista para Recordar Contraseña ---\n";
                echo "La pista para el usuario '" . $usuarioLogueado->getNombreUsuario() . "' es:\n";
                echo ">> " . $usuarioLogueado->recordar() . " <<\n";
                break;

            case '3': // Ver historial
                echo "\n--- Últimas 4 Contraseñas Utilizadas ---\n";
                // print_r es útil para visualizar el contenido de un array.
                print_r($usuarioLogueado->getUltimasContraseñas());
                echo "-----------------------------------------\n";
                break;

            case '4': // Cerrar sesión
                $usuarioLogueado = null;
                $opcion = -1; // Usamos un valor que no sea '0' para que el bucle continúe
                echo "\nSesión cerrada. Volviendo al menú principal...\n";
                break;

            case '0': // Salir del programa
                break; // El bucle se encargará de salir

            default:
                echo "\n\033[1;31mOpción no válida. Por favor, intente de nuevo.\033[0m\n";
                break;
        }
    }

    if ($opcion === '0') {
        echo "\nGracias por usar el sistema. ¡Hasta luego!\n";
        break; // Salimos del bucle principal
    }

    if ($opcion != '0') {
        echo "\nPresione Enter para continuar...";
        fgets(STDIN);
    }
} while ($opcion != '0');
