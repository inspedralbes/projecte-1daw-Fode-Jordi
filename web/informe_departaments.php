<?php
require_once 'logger.php';
include_once "connexio.php";

$sort = $_GET['sort'] ?? 'nomDepartament';
$order = $_GET['order'] ?? 'ASC';

$resultat = $conn->query("SELECT * FROM vista_consum_departaments ORDER BY $sort $order");
?>

<?php include_once "header.php"; ?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-building"></i> Consum per Departaments</h2>
        <p class="text-muted">Resum del nombre d'incidències i temps dedicat per departament</p>
        <hr>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>
                            <i class="bi bi-building"></i> Departament
                            <a href="?sort=nomDepartament&order=ASC" class="text-white ms-1">↑</a>
                            <a href="?sort=nomDepartament&order=DESC" class="text-white">↓</a>
                        </th>
                        <th>
                            <i class="bi bi-exclamation-circle"></i> Nombre d'incidències
                            <a href="?sort=nombreIncidencies&order=ASC" class="text-white ms-1">↑</a>
                            <a href="?sort=nombreIncidencies&order=DESC" class="text-white">↓</a>
                        </th>
                        <th>
                            <i class="bi bi-clock"></i> Temps total (min)
                            <a href="?sort=tempsTotalDedicat&order=ASC" class="text-white ms-1">↑</a>
                            <a href="?sort=tempsTotalDedicat&order=DESC" class="text-white">↓</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultat->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <i class="bi bi-building text-secondary"></i>
                                <?php echo htmlspecialchars($fila["nomDepartament"]); ?>
                            </td>
                            <td>
                                <span class="badge bg-primary rounded-pill">
                                    <?php echo $fila["nombreIncidencies"]; ?>
                                </span>
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