<?php
include_once "connexio.php";

$resultat = $conn->query("
    SELECT 
        D.nom AS nomDepartament,
        COUNT(I.idIncidencia) AS numIncidencies,
        (SELECT SUM(A.temps) 
         FROM ACTUACIO A 
         JOIN INCIDENCIA I2 ON A.incidencia = I2.idIncidencia 
         WHERE I2.departament = D.idDepartament) AS tempsTotal
    FROM DEPARTAMENT D
    LEFT JOIN INCIDENCIA I ON I.departament = D.idDepartament
    GROUP BY D.idDepartament
    ORDER BY numIncidencies DESC
");
?>

<?php include_once "header.php"; ?>

<h2>Consum per Departaments</h2>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Departament</th>
            <th>Nombre d'incidències</th>
            <th>Temps total (minuts)</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($fila = $resultat->fetch_assoc()): ?>
            <tr>
                <td><?php echo $fila["nomDepartament"]; ?></td>
                <td><?php echo $fila["numIncidencies"]; ?></td>
                <td><?php echo $fila["tempsTotal"] ? $fila["tempsTotal"] : "0"; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="admin.php" class="btn btn-secondary">Tornar</a>

<?php include_once "footer.php"; ?>