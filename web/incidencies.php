<?php
include_once "connexio.php";

// Fem la consulta per agafar totes les incidencies
$resultat = $conn->query("SELECT * FROM INCIDENCIA");
?>

<?php include_once "header.php"; ?>

<h2>Llistat d'Incidències</h2>
<br>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Títol</th>
            <th>Descripció</th>
            <th>Data</th>
            <th>Prioritat</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($incidencia = $resultat->fetch_assoc()): ?>
            <tr>
                <td><?php echo $incidencia["idIncidencia"]; ?></td>
                <td><?php echo $incidencia["titol"]; ?></td>
                <td><?php echo $incidencia["descripcio"]; ?></td>
                <td><?php echo $incidencia["data"]; ?></td>
                <td><?php echo $incidencia["prioritat"]; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="index.php" class="btn btn-secondary">Tornar</a>

<?php include_once "footer.php"; ?>
