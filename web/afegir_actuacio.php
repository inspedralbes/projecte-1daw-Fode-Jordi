<?php
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
<br>

<h2>Registrar Actuació</h2>
<br>

<?php if ($registrat): ?>

    <p>Actuacio registrada correctament.</p>
    <a href="index.php" class="btn btn-secondary">Tornar</a>
    <a href="afegir_actuacio.php?id=<?php echo $idIncidencia; ?>" class="btn btn-primary">Afegir una altra actuacio</a>

<?php elseif (!isset($_GET["id"])): ?>

    <form method="GET" action="afegir_actuacio.php">
        <div class="mb-3">
            <label for="id">Introdueix el codi de la teva incidència:</label><br>
            <input type="number" name="id" id="id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="index.php" class="btn btn-secondary">Tornar</a>
    </form>

<?php else:
    $id = $_GET["id"];
    $sentencia = $conn->prepare("SELECT * FROM INCIDENCIA WHERE idIncidencia = ?");
    $sentencia->bind_param("i", $id);
    $sentencia->execute();
    $resultat = $sentencia->get_result();
    $incidencia = $resultat->fetch_assoc();

    if (!$incidencia): ?>
        <p>No existeix cap incidencia amb aquest codi.</p>
        <a href="afegir_actuacio.php" class="btn btn-secondary">Tornar</a>
    <?php else: ?>

    <table class="table table-bordered">
        <tr><th>ID</th><td><?php echo $incidencia["idIncidencia"]; ?></td></tr>
        <tr><th>Títol</th><td><?php echo $incidencia["titol"]; ?></td></tr>
        <tr><th>Descripció</th><td><?php echo $incidencia["descripcio"]; ?></td></tr>
        <tr><th>Data</th><td><?php echo $incidencia["data"]; ?></td></tr>
        <tr><th>Prioritat</th><td><?php echo $incidencia["prioritat"]; ?></td></tr>
    </table>

    <h5>Nova actuació</h5>
    <form method="POST" action="afegir_actuacio.php">
        <input type="hidden" name="idIncidencia" value="<?php echo $incidencia["idIncidencia"]; ?>">

        <div class="mb-3">
            <label for="descripcio">Descripció:</label><br>
            <textarea name="descripcio" id="descripcio" class="form-control" rows="4" placeholder="Descriu l'actuació realitzada" required></textarea>
        </div>

        <div class="mb-3">
            <label for="temps">Temps invertit (minuts):</label><br>
            <input type="number" name="temps" id="temps" class="form-control" placeholder="Exemple: 30" required>
        </div>

        <div class="mb-3">
            <label for="visible">Visible per l'usuari:</label><br>
            <select name="visible" id="visible" class="form-select" required>
                <option value="">-- Selecciona --</option>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="mb-5">
            <button type="submit" class="btn btn-primary">Registrar actuació</button>
            <a href="index.php" class="btn btn-secondary">Tornar</a>
        </div>

    </form>

    <?php endif; ?>
<?php endif; ?>

<?php include_once "footer.php"; ?>
