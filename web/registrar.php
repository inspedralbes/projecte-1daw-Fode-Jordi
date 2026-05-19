<?php
include_once "connexio.php";

$descripcio = $_POST["descripcio"];
$idDepartament = $_POST["idDepartament"];
$data = date('Y-m-d H:i:s');

$sentencia = $conn->prepare("INSERT INTO INCIDENCIA (descripcio, data, departament) VALUES (?, ?, ?)");
$sentencia->bind_param("ssi", $descripcio, $data, $idDepartament);
$sentencia->execute();

$idIncidencia = $conn->insert_id;

header("Location: listar.php?id=" . $idIncidencia);
exit();
?>
