<?php
require_once 'logger.php';
include_once "connexio.php";

$idTecnic = $_GET["id"];

$sentencia = $conn->prepare("SELECT * FROM INCIDENCIA WHERE tecnic = ?");
$sentencia->bind_param("i", $idTecnic);
$sentencia->execute();
$resultat = $sentencia->get_result();
?>

<?php include_once "header.php"; ?>

<h2>Incidències del tècnic</h2>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Títol</th>
            <th>Prioritat</th>
            <th>Data</th>
            <th>Estat</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($inc = $resultat->fetch_assoc()): ?>
            <tr>
                <td><?php echo $inc["idIncidencia"]; ?></td>
                <td><?php echo $inc["titol"]; ?></td>
                <td><?php echo $inc["prioritat"]; ?></td>
                <td><?php echo $inc["data"]; ?></td>
                <td>
                    <?php
                    if ($inc["dataFinalitzacio"] == NULL) {
                        echo "Oberta";
                    } else {
                        echo "Tancada";
                    }
                    ?>
                </td>
                <td>
                    <a href="afegir_actuacio.php?id=<?php echo $inc["idIncidencia"]; ?>" class="btn btn-primary">Actuació</a>
                    <a href="gestionar_incidencia.php?id=<?php echo $inc["idIncidencia"]; ?>" class="btn btn-danger">Tancar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="tecnic.php" class="btn btn-secondary">Tornar</a>

<?php include_once "footer.php"; ?>
