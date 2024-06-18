<?php

    $servidor = "Localhost";
    $usuario = "root";
    $senha = "12345678";
    $banco = "db_melodiaShop";

    $cn = new PDO("mysql:host=$servidor;dbname=$banco", $usuario);

?>