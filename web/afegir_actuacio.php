<?php
require_once 'logger.php';
include_once "connexio.php";

$registrat = false;
$idIncidencia = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idIncidencia = $_POST["idIncidencia"];
    $descripcio = $_POST["descripcio"];
    $temps = $_POST["temps"];
    $visible = $_POST["visible"];

    $sentencia = $conn->prepare("INSERT INTO ACTUACIO (descripcio, data, temps, incidencia, visible) VALUES (?, NOW(), ?, ?, ?)");
    $sentencia->bind_param("siii", $descripcio, $temps, $idIncidencia, $visible);
    $sentencia->execute();
    $sentencia->close();
    $registrat = true;
}
?>

<?php include_once "header.php"; ?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-plus-circle"></i> Registrar Actuació</h2>
        <p class="text-muted">Afegeix una nova actuació a la incidència seleccionada</p>
        <hr>
    </div>

    <?php if ($registrat): ?>

        <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="bi bi-check-circle fs-5"></i>
            Actuació registrada correctament.
        </div>

        <div class="d-flex gap-2">
            <a href="afegir_actuacio.php?id=<?php echo $idIncidencia; ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Afegir una altra actuació
            </a>
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
                        <form method="GET" action="afegir_actuacio.php">
                            <div class="mb-3">
                                <label for="id" class="form-label text-muted">Introdueix el codi de la incidència</label>
                                <input type="number" name="id" id="id" class="form-control" placeholder="Ex: 123" >
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
            <a href="afegir_actuacio.php" class="btn btn-secondary">
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
        ?>

        <!-- Detall incidència -->
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
                </table>
            </div>
        </div>

        <!-- Formulari nova actuació -->
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <i class="bi bi-pencil"></i> Nova actuació
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="afegir_actuacio.php">
                            <input type="hidden" name="idIncidencia" value="<?php echo $incidencia["idIncidencia"]; ?>">

                            <div class="mb-3">
                                <label for="descripcio" class="form-label text-muted">Descripció</label>
                                <textarea name="descripcio" id="descripcio" class="form-control" rows="4"
                                    placeholder="Descriu l'actuació realitzada"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="temps" class="form-label text-muted">Temps invertit (minuts)</label>
                                <input type="number" name="temps" id="temps" class="form-control">
                            </div>

                            <div class="mb-4">
                                <label for="visible" class="form-label text-muted">Visible per l'usuari</label>
                                <select name="visible" id="visible" class="form-select" >
                                    <option value="">-- Selecciona --</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-floppy"></i> Registrar actuació
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

        <?php endif; ?>
    <?php endif; ?>

</div>

<script>
document.getElementById("descripcio").addEventListener("blur", function() {
    if (this.value.length < 20) {
        alert("La descripció ha de tenir mínim 20 caràcters.");
    }
});
</script>

<?php include_once "footer.php"; ?>
