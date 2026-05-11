<?php
include_once "connexio.php";

$resultat = $conn->query("SELECT * FROM INCIDENCIA WHERE dataFinalitzacio IS NULL ORDER BY FIELD(prioritat, 'Alta', 'Mitja', 'Baixa')");
?>

<?php include_once "header.php"; ?>

<h2>Llistat d'Incidències Obertes</h2>
<br>

<table class="table table-bordered">
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
            <?php
            if ($incidencia["prioritat"] == "Alta") {
                $color = "table-danger";
            } elseif ($incidencia["prioritat"] == "Mitja") {
                $color = "table-warning";
            } else {
                $color = "table-success";
            }
            ?>
            <tr class="<?php echo $color; ?>">
                <td><?php echo $incidencia["idIncidencia"]; ?></td>
                <td><?php echo $incidencia["titol"]; ?></td>
                <td><?php echo $incidencia["descripcio"]; ?></td>
                <td><?php echo $incidencia["data"]; ?></td>
                <td><?php echo $incidencia["prioritat"]; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="admin.php" class="btn btn-secondary">Tornar</a>

<?php include_once "footer.php"; ?>

<?php include_once "footer.php"; ?>
