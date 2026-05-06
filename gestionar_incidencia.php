<?php
include_once "connexio.php";

// ESTAT 3: Si s'ha enviat el formulari de tancar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $dataFinalitzacio = $_POST["dataFinalitzacio"];
    $sentencia = $conn->prepare("UPDATE INCIDENCIA SET dataFinalitzacio = ? WHERE idIncidencia = ?");
    $sentencia->bind_param("si", $dataFinalitzacio, $id);
    $sentencia->execute();
    $sentencia->close();

    echo '<p>Incidencia tancada correctament.</p>';
}
?>

<?php include_once "header.php"; ?>
<br>

<h2>Gestionar Incidència</h2>
<br>

<?php
// ESTAT 1: Si no hi ha ID, mostrem formulari per introduir-lo
if (!isset($_GET["id"])) {
?>
    <form method="GET" action="gestionar_incidencia.php">
        <div class="mb-3">
            <label for="id">Introdueix el codi de la incidència:</label>
            <br>
            <input type="number" name="id" id="id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="index.php" class="btn btn-secondary">Tornar</a>
    </form>

<?php
// ESTAT 2: Si hi ha ID, mostrem les dades
} else {
    $id = $_GET["id"];
    $sentencia = $conn->prepare("SELECT * FROM INCIDENCIA WHERE idIncidencia = ?");
    $sentencia->bind_param("i", $id);
    $sentencia->execute();
    $resultat = $sentencia->get_result();
    $incidencia = $resultat->fetch_assoc();

    if (!$incidencia) {
        echo '<p>No existeix cap incidencia amb aquest codi.</p>';
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

    <?php if ($incidencia["dataFinalitzacio"] == NULL): ?>
        <h5>Tancar incidència</h5>
        <form method="POST" action="gestionar_incidencia.php">
            <input type="hidden" name="id" value="<?php echo $incidencia["idIncidencia"]; ?>">
            <div class="mb-3">
                <label for="dataFinalitzacio">Data de tancament:</label>
                <br>
                <input type="date" name="dataFinalitzacio" id="dataFinalitzacio" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-danger">Tancar incidència</button>
            <a href="index.php" class="btn btn-secondary">Tornar</a>
        </form>
    <?php else: ?>
        <p>Aquesta incidencia ja esta tancada.</p>
        <a href="index.php" class="btn btn-secondary">Tornar</a>
    <?php endif; ?>

<?php
    }
}
?>

<?php include_once "footer.php"; ?>