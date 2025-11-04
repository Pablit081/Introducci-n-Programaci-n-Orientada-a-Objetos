<?php

require_once 'Medoo.php';

use \Medoo\Medoo;

$database = new \Medoo\Medoo([
    'database_type' => 'mysql',
    'database_name' => 'bdclinica',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);
?>
