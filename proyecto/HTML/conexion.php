<?php

$host = "127.0.0.1";
$dbname = "GGCHAMP";
$user = "root";
$password = "57401742";

try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    echo "Conexión exitosa a la base de datos";

} catch (PDOException $e) {

    die("Error de conexión: " . $e->getMessage());

}
