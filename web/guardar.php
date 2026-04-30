<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (empty($_POST["nombre"]) || empty($_POST["descripcion"])) {
    exit("Datos incompletos");
}

$mysqli = include_once "conexion.php";

if (!$mysqli) {
    die("Error al conectar con la base de datos");
}

$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];

$sentencia = $mysqli->prepare("INSERT INTO videojuegos (nombre, descripcion) VALUES (?, ?)");
if (!$sentencia) {
    die("Error en prepare: " . $mysqli->error);
}

$sentencia->bind_param("ss", $nombre, $descripcion);

if (!$sentencia->execute()) {
    die("Error al ejecutar: " . $sentencia->error);
}

//header("Location: listar.php");
exit;
