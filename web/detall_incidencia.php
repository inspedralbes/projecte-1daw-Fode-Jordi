<?php
require_once 'logger.php';
include_once "connexio.php";
?>

<?php include_once "header.php"; ?>

<<<<<<< Updated upstream
<h2>Estat de la Incidència</h2>
<br>
=======
<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-search"></i> Estat de la Incidència</h2>
        <p class="text-muted">Consulta l'estat i les actuacions d'una incidència</p>
        <hr>
    </div>
>>>>>>> Stashed changes

<?php
if (!isset($_GET["id"])) {
?>

<<<<<<< Updated upstream
    <form method="GET" action="detall_incidencia.php">
        <div class="mb-3">
            <label for="id">Introdueix el codi de la incidència:</label>
            <br>
            <input type="number" name="id" id="id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="index.php" class="btn btn-secondary">Tornar a l'inici</a>
    </form>

<?php
} else {
=======
    <div class="row">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title mb-3"> Cerca una incidència</h5>
                    <form method="GET" action="detall_incidencia.php">
                        <div class="mb-3">
                            <label for="id" class="form-label text-muted">Introdueix el codi de la incidència</label>
                            <input type="number" name="id" id="id" class="form-control" required>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-house"></i> Tornar a l'inici
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php else:
>>>>>>> Stashed changes
    $id = $_GET["id"];
    $sentencia = $conn->prepare("SELECT * FROM INCIDENCIA WHERE idIncidencia = ?");
    $sentencia->bind_param("i", $id);
    $sentencia->execute();
    $resultat = $sentencia->get_result();
    $incidencia = $resultat->fetch_assoc();

<<<<<<< Updated upstream
    if (!$incidencia) {
        echo '<p>No existeix cap incidencia amb aquest codi.</p>';
        echo '<a href="detall_incidencia.php" class="btn btn-secondary">Tornar</a>';
    } else {
?>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?php echo $incidencia["idIncidencia"]; ?></td>
        </tr>
        <tr>
            <th>Títol</th>
            <td><?php echo $incidencia["titol"]; ?></td>
        </tr>
        <tr>
            <th>Descripció</th>
            <td><?php echo $incidencia["descripcio"]; ?></td>
        </tr>
        <tr>
            <th>Data</th>
            <td><?php echo $incidencia["data"]; ?></td>
        </tr>
        <tr>
            <th>Prioritat</th>
            <td><?php echo $incidencia["prioritat"]; ?></td>
        </tr>
        <tr>
            <th>Estat</th>
            <td>
                <?php
                if ($incidencia["dataFinalitzacio"] == NULL) {
                    echo "Oberta";
                } else {
                    echo "Tancada el " . $incidencia["dataFinalitzacio"];
                }
                ?>
            </td>
        </tr>
    </table>

    <h5>Actuacions visibles</h5>

    <?php
    $sentencia2 = $conn->prepare("SELECT * FROM ACTUACIO WHERE incidencia = ? AND visible = 1 ORDER BY data ASC");
    $sentencia2->bind_param("i", $id);
    $sentencia2->execute();
    $actuacions = $sentencia2->get_result();

    if ($actuacions->num_rows == 0) {
        echo '<p>Encara no hi ha actuacions visibles.</p>';
    } else {
    ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Data</th>
                <th>Descripció</th>
                <th>Temps (minuts)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($act = $actuacions->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $act["data"]; ?></td>
                    <td><?php echo $act["descripcio"]; ?></td>
                    <td><?php echo $act["temps"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php } ?>

    <a href="detall_incidencia.php" class="btn btn-secondary">Buscar una altra</a>
    <a href="index.php" class="btn btn-secondary">Tornar a l'inici</a>

<?php
    }
}
?>

<?php include_once "footer.php"; ?>
=======
    if (!$incidencia): ?>

        <div class="alert alert-warning d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-triangle fs-5"></i>
            No existeix cap incidència amb aquest codi.
        </div>
        <a href="detall_incidencia.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Tornar
        </a>

    <?php else:
        $prioritat = $incidencia["prioritat"];
        if ($prioritat == "Alta") {
            $badgePrioritat = '<span class="badge bg-danger"><i class="bi bi-arrow-up-circle"></i> ' . $prioritat . '</span>';
        } elseif ($prioritat == "Mitja") {
            $badgePrioritat = '<span class="badge bg-warning text-dark"><i class="bi bi-dash-circle"></i> ' . $prioritat . '</span>';
        } else {
            $badgePrioritat = '<span class="badge bg-success"><i class="bi bi-arrow-down-circle"></i> ' . $prioritat . '</span>';
        }

        $estat = $incidencia["dataFinalitzacio"] == NULL
            ? '<span class="badge bg-success"><i class="bi bi-unlock"></i> Oberta</span>'
            : '<span class="badge bg-secondary"><i class="bi bi-lock"></i> Tancada el ' . $incidencia["dataFinalitzacio"] . '</span>';
    ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-file-earmark-text"></i>
            Incidència #<?php echo $incidencia["idIncidencia"]; ?>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <tr>
                    <th class="ps-3 text-muted" width="180">ID</th>
                    <td class="fw-bold">#<?php echo $incidencia["idIncidencia"]; ?></td>
                </tr>
                <tr>
                    <th class="ps-3 text-muted">Títol</th>
                    <td><?php echo htmlspecialchars($incidencia["titol"]); ?></td>
                </tr>
                <tr>
                    <th class="ps-3 text-muted">Descripció</th>
                    <td class="text-muted"><?php echo htmlspecialchars($incidencia["descripcio"]); ?></td>
                </tr>
                <tr>
                    <th class="ps-3 text-muted">Data</th>
                    <td><i class="bi bi-calendar3"></i> <?php echo $incidencia["data"]; ?></td>
                </tr>
                <tr>
                    <th class="ps-3 text-muted">Prioritat</th>
                    <td><?php echo $badgePrioritat; ?></td>
                </tr>
                <tr>
                    <th class="ps-3 text-muted">Estat</th>
                    <td><?php echo $estat; ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    <h5 class="mb-3"><i class="bi bi-clock-history"></i> Actuacions visibles</h5>

    <?php
    $sentencia2 = $conn->prepare("SELECT * FROM ACTUACIO WHERE incidencia = ? AND visible = 1 ORDER BY data ASC");
    $sentencia2->bind_param("i", $id);
    $sentencia2->execute();
    $actuacions = $sentencia2->get_result();

    if ($actuacions->num_rows == 0): ?>

        <div class="alert alert-info d-flex align-items-center gap-2">
            <i class="bi bi-info-circle fs-5"></i>
            Encara no hi ha actuacions visibles.
        </div>

    <?php else: ?>

        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="bi bi-calendar3"></i> Data</th>
                            <th><i class="bi bi-chat-left-text"></i> Descripció</th>
                            <th><i class="bi bi-stopwatch"></i> Temps (min)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($act = $actuacions->fetch_assoc()): ?>
                            <tr>
                                <td><i class="bi bi-calendar3 text-secondary"></i> <?php echo $act["data"]; ?></td>
                                <td class="text-muted"><?php echo htmlspecialchars($act["descripcio"]); ?></td>
                                <td><i class="bi bi-stopwatch"></i> <?php echo $act["temps"]; ?> min</td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

    <div class="d-flex gap-2">
        <a href="detall_incidencia.php" class="btn btn-primary">
            <i class="bi bi-search"></i> Buscar una altra
        </a>
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-house"></i> Tornar a l'inici
        </a>
    </div>
>>>>>>> Stashed changes

    <?php endif; ?>
<?php endif; ?>

</div>

<?php include_once "footer.php"; ?>