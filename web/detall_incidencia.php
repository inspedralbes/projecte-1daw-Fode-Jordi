<?php include_once "header.php"; ?>

<h2>Estat de la Incidència</h2>
<br>

<?php if (!isset($_GET["id"])): ?>

    <form method="GET" action="detall_incidencia.php">
        <div class="mb-3">
            <label for="id">Introdueix el codi de la incidència:</label>
            <input type="number" name="id" id="id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="index.php" class="btn btn-secondary">Tornar</a>
    </form>

<?php else:
    include_once "connexio.php";
    $id = $_GET["id"];

    $sentencia = $conn->prepare("SELECT * FROM INCIDENCIA WHERE idIncidencia = ?");
    $sentencia->bind_param("i", $id);
    $sentencia->execute();
    $incidencia = $sentencia->get_result()->fetch_assoc();

    if (!$incidencia): ?>
        <p>No existeix cap incidència amb aquest codi.</p>
        <a href="detall_incidencia.php" class="btn btn-secondary">Tornar</a>
    <?php else:
        $sentencia2 = $conn->prepare("SELECT * FROM ACTUACIO WHERE incidencia = ? AND visible = 1 ORDER BY data ASC");
        $sentencia2->bind_param("i", $id);
        $sentencia2->execute();
        $actuacions = $sentencia2->get_result();
    ?>

        <table class="table table-bordered">
            <tr><th>ID</th><td><?php echo $incidencia["idIncidencia"]; ?></td></tr>
            <tr><th>Títol</th><td><?php echo $incidencia["titol"]; ?></td></tr>
            <tr><th>Estat</th><td><?php echo $incidencia["dataFinalitzacio"] ? "Tancada" : "Oberta"; ?></td></tr>
        </table>

        <h5>Actuacions</h5>
        <table class="table table-bordered">
            <thead>
                <tr><th>Data</th><th>Descripció</th><th>Temps (min)</th></tr>
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

        <a href="detall_incidencia.php" class="btn btn-secondary">Tornar</a>

    <?php endif; ?>
<?php endif; ?>

<?php include_once "footer.php"; ?>
