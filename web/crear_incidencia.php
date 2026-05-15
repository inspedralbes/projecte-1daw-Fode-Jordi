<?php
include_once "connexio.php";

$departaments = $conn->query("SELECT * FROM DEPARTAMENT");
$enviado = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titol = $_POST["titol"];
    $descripcio = $_POST["descripcio"];
    $idDepartament = $_POST["departament"];
    $data = $_POST["data"];

    if (empty($titol) || empty($descripcio) || empty($idDepartament) || empty($data)) {
        $error = "Tots els camps son obligatoris.";
    } else {
        $sentencia = $conn->prepare("INSERT INTO INCIDENCIA (titol, descripcio, data, departament) VALUES (?, ?, ?, ?)");
        $sentencia->bind_param("sssi", $titol, $descripcio, $data, $idDepartament);
        $sentencia->execute();
        $idNova = $sentencia->insert_id;
        $sentencia->close();
        $enviado = true;
    }
}
?>

<?php include_once "header.php"; ?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-plus-circle"></i> Nova Incidència</h2>
        <p class="text-muted">Omple el formulari per registrar una nova incidència</p>
        <hr>
    </div>

    <?php if ($enviado): ?>

        <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="bi bi-check-circle fs-5"></i>
            Incidència creada correctament! Guarda el teu codi per fer el seguiment.
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body text-center p-4">
                <i class="bi bi-ticket-perforated fs-1 text-success mb-3 d-block"></i>
                <h5 class="text-muted">El teu codi d'incidència és</h5>
                <h1 class="fw-bold display-4">#<?php echo $idNova; ?></h1>
                <p class="text-muted small">Apunta aquest codi per consultar l'estat de la incidència</p>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="crear_incidencia.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Registrar una nova incidència
            </a>
            <a href="professor.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Tornar
            </a>
        </div>

    <?php else: ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle fs-5"></i>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <i class="bi bi-file-earmark-plus"></i> Dades de la incidència
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="crear_incidencia.php">

                            <div class="mb-3">
                                <label for="titol" class="form-label text-muted">Títol</label>
                                <input type="text" name="titol" id="titol" class="form-control"
                                    placeholder="Escriu un títol breu"
                                    value="<?php echo isset($_POST['titol']) ? htmlspecialchars($_POST['titol']) : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="data" class="form-label text-muted">Data</label>
                                <input type="datetime-local" name="data" id="data" class="form-control"
                                    value="<?php echo isset($_POST['data']) ? htmlspecialchars($_POST['data']) : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="departament" class="form-label text-muted">Departament</label>
                                <select name="departament" id="departament" class="form-select">
                                    <option value="">-- Selecciona un departament --</option>
                                    <?php while ($dep = $departaments->fetch_assoc()): ?>
                                        <option value="<?php echo $dep['idDepartament']; ?>"
                                            <?php if (isset($_POST['departament']) && $_POST['departament'] == $dep['idDepartament']) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($dep['nom']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="descripcio" class="form-label text-muted">Descripció</label>
                                <textarea name="descripcio" id="descripcio" class="form-control" rows="4"
                                    placeholder="Descriu la incidència amb detall"><?php echo isset($_POST['descripcio']) ? htmlspecialchars($_POST['descripcio']) : ''; ?></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i> Enviar
                                </button>
                                <a href="professor.php" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Tornar
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
<script>
document.querySelector("form")?.addEventListener("submit", function(e) {
    const campos = document.querySelectorAll("input, select, textarea");
    for (let campo of campos) {
        if (!campo.value.trim()) {
            e.preventDefault();
            alert("Tots els camps son obligatoris.");
            return;
        }
    }
});
</script>
<?php include_once "footer.php"; ?>


