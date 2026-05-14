<?php
require_once 'logger.php';
include_once "connexio.php";

$sort = $_GET['sort'] ?? 'nomTecnic';
$order = $_GET['order'] ?? 'ASC';

$resultat = $conn->query("SELECT * FROM vista_informe_tecnics ORDER BY $sort $order");
?>

<?php include_once "header.php"; ?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-person-badge"></i> Informe de Tècnics</h2>
        <p class="text-muted">Resum de les incidències gestionades per cada tècnic</p>
        <hr>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>
                            <i class="bi bi-person"></i> Tècnic
                            <a href="?sort=nomTecnic&order=ASC" class="text-white ms-1">↑</a>
                            <a href="?sort=nomTecnic&order=DESC" class="text-white">↓</a>
                        </th>
                        <th>#ID</th>
                        <th>Descripció</th>
                        <th>
                            <i class="bi bi-calendar3"></i> Data inici
                            <a href="?sort=dataInici&order=ASC" class="text-white ms-1">↑</a>
                            <a href="?sort=dataInici&order=DESC" class="text-white">↓</a>
                        </th>
                        <th>
                            Prioritat
                            <a href="?sort=prioritat&order=ASC" class="text-white ms-1">↑</a>
                            <a href="?sort=prioritat&order=DESC" class="text-white">↓</a>
                        </th>
                        <th>
                            <i class="bi bi-clock"></i> Temps (min)
                            <a href="?sort=tempsTotalDedicat&order=ASC" class="text-white ms-1">↑</a>
                            <a href="?sort=tempsTotalDedicat&order=DESC" class="text-white">↓</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultat->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <i class="bi bi-person-circle text-secondary"></i>
                                <?php echo htmlspecialchars($fila["nomTecnic"]); ?>
                            </td>
                            <td class="fw-bold text-muted">#<?php echo $fila["idIncidencia"]; ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($fila["descripcioIncidencia"]); ?></td>
                            <td><i class="bi bi-calendar3"></i> <?php echo $fila["dataInici"]; ?></td>
                            <td>
                                <?php
                                $prioritat = $fila["prioritat"];
                                if ($prioritat == "Alta") {
                                    echo '<span class="badge bg-danger"><i class="bi bi-arrow-up-circle"></i> ' . $prioritat . '</span>';
                                } elseif ($prioritat == "Mitja") {
                                    echo '<span class="badge bg-warning text-dark"><i class="bi bi-dash-circle"></i> ' . $prioritat . '</span>';
                                } else {
                                    echo '<span class="badge bg-success"><i class="bi bi-arrow-down-circle"></i> ' . $prioritat . '</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <i class="bi bi-stopwatch"></i>
                                <?php echo $fila["tempsTotalDedicat"]; ?> min
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="admin.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Tornar
        </a>
    </div>

</div>

<?php include_once "footer.php"; ?>