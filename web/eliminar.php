<?php
$mysqli = include_once "conexion.php";

$id = $_GET["id"];

$sentencia = $mysqli->prepare("DELETE FROM registros WHERE id=?");
$sentencia->bind_param("i", $id);
$sentencia->execute();

header("Location: listar.php");