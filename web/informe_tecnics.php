<?php
include_once "connexio.php";

$resultat = $conn->query("
    SELECT 
        T.nom AS nomTecnic,
        I.idIncidencia,
        I.titol,
        I.data,
        I.prioritat,
        SUM(A.temps) AS tempsTotal
    FROM TECNIC T
    JOIN INCIDENCIA I ON I.tecnic = T.idTecnic
    LEFT JOIN ACTUACIO A ON A.incidencia = I.idIncidencia
    WHERE I.dataFinalitzacio IS NULL
    GROUP BY T.idTecnic, I.idIncidencia
    ORDER BY T.nom, FIELD(I.prioritat, 'Alta', 'Mitja', 'Baixa')
");
?>

<?php include_once "header.php"; ?>

<h2>Informe de Tècnics</h2>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tècnic</th>
            <th>ID Incidència</th>
            <th>Títol</th>
            <th>Data inici</th>
            <th>Prioritat</th>
            <th>Temps total (minuts)</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($fila = $resultat->fetch_assoc()): ?>
            <?php
            if ($fila["prioritat"] == "Alta") {
                $color = "table-danger";
            } elseif ($fila["prioritat"] == "Mitja") {
                $color = "table-warning";
            } else {
                $color = "table-success";
            }
            ?>
            <tr class="<?php echo $color; ?>">
                <td><?php echo $fila["nomTecnic"]; ?></td>
                <td><?php echo $fila["idIncidencia"]; ?></td>
                <td><?php echo $fila["titol"]; ?></td>
                <td><?php echo $fila["data"]; ?></td>
                <td><?php echo $fila["prioritat"]; ?></td>
                <td><?php echo $fila["tempsTotal"] ? $fila["tempsTotal"] : "0"; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="admin.php" class="btn btn-secondary">Tornar</a>

<?php include_once "footer.php"; ?>