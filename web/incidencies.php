<?php
require_once 'logger.php';
include_once "connexio.php";

$resultat = $conn->query("SELECT * FROM INCIDENCIA WHERE dataFinalitzacio IS NULL ORDER BY FIELD(prioritat, 'Alta', 'Mitja', 'Baixa')");
?>

<?php include_once "header.php"; ?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-exclamation-triangle"></i> Llistat d'Incidències Obertes</h2>
        <p class="text-muted">Incidències pendents de resolució, ordenades per prioritat</p>
        <hr>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#ID</th>
                        <th>Títol</th>
                        <th>Descripció</th>
                        <th>Data</th>
                        <th>Prioritat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($incidencia = $resultat->fetch_assoc()): ?>
                        <tr>
                            <td class="fw-bold text-muted">#<?php echo $incidencia["idIncidencia"]; ?></td>
                            <td><?php echo htmlspecialchars($incidencia["titol"]); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($incidencia["descripcio"]); ?></td>
                            <td><i class="bi bi-calendar3"></i> <?php echo $incidencia["data"]; ?></td>
                            <td>
                                <?php
                                $prioritat = $incidencia["prioritat"];
                                if ($prioritat == "Alta") {
                                    echo '<span class="badge bg-danger"><i class="bi bi-arrow-up-circle"></i> ' . $prioritat . '</span>';
                                } elseif ($prioritat == "Mitja") {
                                    echo '<span class="badge bg-warning text-dark"><i class="bi bi-dash-circle"></i> ' . $prioritat . '</span>';
                                } else {
                                    echo '<span class="badge bg-success"><i class="bi bi-arrow-down-circle"></i> ' . $prioritat . '</span>';
                                }
                                ?>
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