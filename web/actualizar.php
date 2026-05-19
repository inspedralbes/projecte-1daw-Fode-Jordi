<?php
$mysqli = include_once "conexion.php";

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];

$sentencia = $mysqli->prepare("UPDATE registros SET nombre=?, descripcion=? WHERE id=?");
$sentencia->bind_param("ssi", $nombre, $descripcion, $id);
$sentencia->execute();

header("Location: listar.php");