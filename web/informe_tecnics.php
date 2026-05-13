<?php
require_once 'logger.php';
include_once "connexio.php";

$sort = $_GET['sort'] ?? 'nomTecnic';
$order = $_GET['order'] ?? 'ASC';

$resultat = $conn->query("SELECT * FROM vista_informe_tecnics ORDER BY $sort $order");
?>

<?php include_once "header.php"; ?>

<h2>Informe de Tècnics</h2>
<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                Tècnic
                <a href="?sort=nomTecnic&order=asc">↑</a>
                <a href="?sort=nomTecnic&order=desc">↓</a>
            </th>
            <th>ID</th>
            <th>Descripció</th>
            <th>
                Data inici
                <a href="?sort=dataInici&order=asc">↑</a>
                <a href="?sort=dataInici&order=desc">↓</a>
            </th>
            <th>
                Prioritat
                <a href="?sort=prioritat&order=asc">↑</a>
                <a href="?sort=prioritat&order=desc">↓</a>
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
                <td><?php echo $fila["descripcioIncidencia"]; ?></td>
                <td><?php echo $fila["dataInici"]; ?></td>
                <td><?php echo $fila["prioritat"]; ?></td>
                <td><?php echo $fila["tempsTotalDedicat"]; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="admin.php" class="btn btn-secondary">Tornar</a>

<?php include_once "footer.php"; ?>
