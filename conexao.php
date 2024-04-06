<?php

    $servidor = "Localhost";
    $usuario = "root";
    $senha = "S102030d";
    $banco = "db_puremusic";

    $cn = new PDO("mysql:host=$servidor;dbname=$banco", $usuario);

?>