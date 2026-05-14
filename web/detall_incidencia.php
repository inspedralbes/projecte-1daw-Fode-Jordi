<?php
require_once 'logger.php';
include_once "connexio.php";
?>

<?php include_once "header.php"; ?>

<h2>Estat de la Incidència</h2>
<br>

<?php
if (!isset($_GET["id"])) {
?>

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
    $id = $_GET["id"];
    $sentencia = $conn->prepare("SELECT * FROM INCIDENCIA WHERE idIncidencia = ?");
    $sentencia->bind_param("i", $id);
    $sentencia->execute();
    $resultat = $sentencia->get_result();
    $incidencia = $resultat->fetch_assoc();

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

    <?php endif; ?>
<?php endif; ?>

<?php include_once "footer.php"; ?>
