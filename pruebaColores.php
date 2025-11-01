<?php
echo "\033[31mEste texto es rojo\033[0m\n"; // Rojo
echo "\033[32mEste texto es verde\033[0m\n"; // Verde

echo "\033[41mEste texto tiene fondo rojo\033[0m\n"; // Fondo rojo
echo "\033[42mEste texto tiene fondo verde\033[0m\n"; // Fondo verde

echo "\033[1mEste texto es en negrita\033[0m\n"; // Negrita
echo "\033[4mEste texto está subrayado\033[0m\n"; // Subrayado
echo "\033[7mEste texto tiene colores invertidos\033[0m\n"; // Colores invertidos

echo "\033[1;31;42mTexto en negrita, rojo, con fondo verde\033[0m\n"; // Negrita, rojo, fondo verde

echo "\033[92;40mTexto verde brillante con fondo negro\033[0m\n"; // Texto en verde brillante, fondo negro

echo "\033[5;35mTexto en magenta con parpadeo\033[0m\n"; // Texto en magenta con parpadeo