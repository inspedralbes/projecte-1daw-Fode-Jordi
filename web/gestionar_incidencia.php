<?php
require_once 'logger.php';
include_once "connexio.php";

$tancada = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $dataFinalitzacio = $_POST["dataFinalitzacio"];

    $sentencia = $conn->prepare("UPDATE INCIDENCIA SET dataFinalitzacio = ? WHERE idIncidencia = ?");
    $sentencia->bind_param("si", $dataFinalitzacio, $id);
    $sentencia->execute();
    $sentencia->close();
    $tancada = true;
}
?>

<?php include_once "header.php"; ?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-x-circle"></i> Gestionar Incidència</h2>
        <p class="text-muted">Cerca i tanca una incidència oberta</p>
        <hr>
    </div>

    <?php if ($tancada): ?>

        <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="bi bi-check-circle fs-5"></i>
            Incidència tancada correctament.
        </div>
        <div class="d-flex gap-2">
            <a href="index.php" class="btn btn-secondary">
                <i class="bi bi-house"></i> Tornar a l'inici
            </a>
        </div>

    <?php elseif (!isset($_GET["id"])): ?>

        <div class="row">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3"><i class="bi bi-hash"></i> Cerca una incidència</h5>
                        <form method="GET" action="gestionar_incidencia.php">
                            <div class="mb-3">
                                <label for="id" class="form-label text-muted">Introdueix el codi de la incidència</label>
                                <input type="number" name="id" id="id" class="form-control" placeholder="Ex: 123" required>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Buscar
                                </button>
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="bi bi-house"></i> Tornar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php else:
        $id = $_GET["id"];
        $sentencia = $conn->prepare("SELECT * FROM INCIDENCIA WHERE idIncidencia = ?");
        $sentencia->bind_param("i", $id);
        $sentencia->execute();
        $resultat = $sentencia->get_result();
        $incidencia = $resultat->fetch_assoc();

        if (!$incidencia): ?>

            <div class="alert alert-warning d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle fs-5"></i>
                No existeix cap incidència amb aquest codi.
            </div>
            <a href="gestionar_incidencia.php" class="btn btn-secondary">
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

        <?php if ($incidencia["dataFinalitzacio"] == NULL): ?>

            <div class="row">
                <div class="col-md-5">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-danger text-white">
                            <i class="bi bi-x-circle"></i> Tancar incidència
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="gestionar_incidencia.php">
                                <input type="hidden" name="id" value="<?php echo $incidencia["idIncidencia"]; ?>">
                                <div class="mb-4">
                                    <label for="dataFinalitzacio" class="form-label text-muted">Data de tancament</label>
                                    <input type="date" name="dataFinalitzacio" id="dataFinalitzacio" class="form-control" required>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-x-circle"></i> Tancar incidència
                                    </button>
                                    <a href="index.php" class="btn btn-secondary">
                                        <i class="bi bi-house"></i> Tornar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="alert alert-secondary d-flex align-items-center gap-2">
                <i class="bi bi-lock fs-5"></i>
                Aquesta incidència ja està tancada.
            </div>
            <a href="index.php" class="btn btn-secondary">
                <i class="bi bi-house"></i> Tornar a l'inici
            </a>

        <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

</div>

<?php include_once "footer.php"; ?>
