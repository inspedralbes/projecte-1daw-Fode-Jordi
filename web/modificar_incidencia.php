<?php
require_once 'logger.php';
include_once "connexio.php";

$modificat = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $prioritat = $_POST["prioritat"];
    $tipo = $_POST["tipo"];
    $tecnic = $_POST["tecnic"];

    $sentencia = $conn->prepare("UPDATE INCIDENCIA SET prioritat = ?, tipo = ?, tecnic = ? WHERE idIncidencia = ?");
    $sentencia->bind_param("ssii", $prioritat, $tipo, $tecnic, $id);
    $sentencia->execute();
    $sentencia->close();
    $modificat = true;
}
?>

<?php include_once "header.php"; ?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-pencil-square"></i> Modificar Incidència</h2>
        <p class="text-muted">Cerca i modifica les dades d'una incidència existent</p>
        <hr>
    </div>

    <?php if ($modificat): ?>

        <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="bi bi-check-circle fs-5"></i>
            Incidència modificada correctament.
        </div>
        <div class="d-flex gap-2">
            <a href="modificar_incidencia.php" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i> Modificar una altra
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
                        <h5 class="card-title mb-3">Cerca una incidència</h5>
                        <form method="GET" action="modificar_incidencia.php">
                            <div class="mb-3">
                                <label for="id" class="form-label text-muted">Introdueix el codi de la incidència</label>
                                <input type="number" name="id" id="id" class="form-control" required>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Buscar
                                </button>
                                <a href="admin.php" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Tornar
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
        $tecnics = $conn->query("SELECT * FROM TECNIC");

        if (!$incidencia): ?>

            <div class="alert alert-warning d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle fs-5"></i>
                No existeix cap incidència amb aquest codi.
            </div>
            <a href="modificar_incidencia.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Tornar
            </a>

        <?php else: ?>

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
                </table>
            </div>
        </div>


        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-pencil"></i> Modificar dades
            </div>
            <div class="card-body p-4">
                <form method="POST" action="modificar_incidencia.php">
                    <input type="hidden" name="id" value="<?php echo $incidencia["idIncidencia"]; ?>">

                    <div class="mb-3">
                        <label for="prioritat" class="form-label text-muted">Prioritat</label>
                        <select name="prioritat" id="prioritat" class="form-select" required>
                            <option value="">-- Selecciona prioritat --</option>
                            <option value="Alta" <?php if ($incidencia["prioritat"] == "Alta") echo "selected"; ?>> Alta</option>
                            <option value="Mitja" <?php if ($incidencia["prioritat"] == "Mitja") echo "selected"; ?>> Mitja</option>
                            <option value="Baixa" <?php if ($incidencia["prioritat"] == "Baixa") echo "selected"; ?>> Baixa</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label text-muted">Tipus</label>
                        <select name="tipo" id="tipo" class="form-select" required>
                            <option value="">-- Selecciona tipus --</option>
                            <option value="Software" <?php if ($incidencia["tipo"] == "Software") echo "selected"; ?>> Software</option>
                            <option value="Hardware" <?php if ($incidencia["tipo"] == "Hardware") echo "selected"; ?>> Hardware</option>
                            <option value="Internet" <?php if ($incidencia["tipo"] == "Internet") echo "selected"; ?>> Internet</option>
                            <option value="Corrent" <?php if ($incidencia["tipo"] == "Corrent") echo "selected"; ?>> Corrent</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tecnic" class="form-label text-muted">Tècnic assignat</label>
                        <select name="tecnic" id="tecnic" class="form-select" required>
                            <option value="">-- Selecciona tècnic --</option>
                            <?php while ($tec = $tecnics->fetch_assoc()): ?>
                                <option value="<?php echo $tec["idTecnic"]; ?>" <?php if ($incidencia["tecnic"] == $tec["idTecnic"]) echo "selected"; ?>>
                                     <?php echo htmlspecialchars($tec["nom"]); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-floppy"></i> Guardar canvis
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            <i class="bi bi-house"></i> Tornar
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <?php endif; ?>
    <?php endif; ?>

</div>

<?php include_once "footer.php"; ?>
