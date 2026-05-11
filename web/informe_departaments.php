<?php
include_once "connexio.php";

$sort = $_GET['sort'] ?? 'nomDepartament';
$order = $_GET['order'] ?? 'ASC';

$resultat = $conn->query("SELECT * FROM vista_consum_departaments ORDER BY $sort $order");
?>

<?php include_once "header.php"; ?>

<h2>Consum per Departaments</h2>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                Departament
                <a href="?sort=nomDepartament&order=asc">↑</a>
                <a href="?sort=nomDepartament&order=desc">↓</a>
            </th>
            <th>
                Nombre d'incidències
                <a href="?sort=nombreIncidencies&order=asc">↑</a>
                <a href="?sort=nombreIncidencies&order=desc">↓</a>
            </th>
            <th>
                Temps total (min)
                <a href="?sort=tempsTotalDedicat&order=asc">↑</a>
                <a href="?sort=tempsTotalDedicat&order=desc">↓</a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php while ($fila = $resultat->fetch_assoc()): ?>
            <tr>
                <td><?php echo $fila["nomDepartament"]; ?></td>
                <td><?php echo $fila["nombreIncidencies"]; ?></td>
                <td><?php echo $fila["tempsTotalDedicat"]; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="admin.php" class="btn btn-secondary">Tornar</a>

<?php include_once "footer.php"; ?>
