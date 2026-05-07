<?php
include_once "connexio.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcio        = $_POST['descripcio'];
    $departament       = $_POST['departament'];
    $tecnic            = $_POST['tecnic'];
    $tipo              = $_POST['tipo'];
    $prioritat         = $_POST['prioritat'];
    $dataFinalitzacio  = $_POST['dataFinalitzacio'] ?: null; 

    $sql = "INSERT INTO INCIDENCIA (descripcio, departament, tecnic, tipo, prioritat, dataFinalitzacio)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siisss", $descripcio, $departament, $tecnic, $tipo, $prioritat, $dataFinalitzacio);

    if ($stmt->execute()) {
        header("Location: incidencies.php?msg=ok");
    } else {
        echo "Error al guardar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: crear_incidencia.php");
}
?>
