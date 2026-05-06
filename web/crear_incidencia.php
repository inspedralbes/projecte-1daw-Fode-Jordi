<?php
include_once "connexio.php";

$departaments = $conn->query("SELECT * FROM DEPARTAMENT");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titol = $_POST["titol"];
    $descripcio = $_POST["descripcio"];
    $idDepartament = $_POST["departament"];
    $data = $_POST["data"];

    if (empty($titol) || empty($descripcio) || empty($idDepartament) || empty($data)) {
        echo '<p>Tots els camps son obligatoris.</p>';
    } else {
        $sentencia = $conn->prepare("INSERT INTO INCIDENCIA (titol, descripcio, data, departament) VALUES (?, ?, ?, ?)");
        $sentencia->bind_param("sssi", $titol, $descripcio, $data, $idDepartament);
        $sentencia->execute();
        $idNova = $sentencia->insert_id;
        echo '<p>Incidencia creada! El teu codi es: <strong>' . $idNova . '</strong></p>';
        $sentencia->close();
    }
}
?>

<?php include_once "header.php"; ?>
<br>
<h2>Nova Incidència</h2>
<br>
<form method="POST" action="crear_incidencia.php">

    <div class="mb-3">
        <label for="titol">Títol:</label>
        <br>
        <input type="text" name="titol" id="titol" class="form-control" placeholder="Ex: No s'encèn la pantalla" required>
    </div>

    <div class="mb-3">
        <label for="data">Data:</label>
        <br>
        <input type="date" name="data" id="data" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="departament">Departament: </label>
        <br>
        <select name="departament" id="departament" class="form-select" required>
            <option value="">-- Selecciona un departament --</option>
            <?php while ($dep = $departaments->fetch_assoc()): ?>
                <option value="<?php echo $dep['idDepartament']; ?>">
                    <?php echo $dep['nom']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="descripcio">Descripció:</label>
        <textarea name="descripcio" id="descripcio" class="form-control" rows="4" placeholder="Descriu la incidència amb detall" required></textarea>
    </div>

    <a href="index.php" class="btn btn-secondary">Tornar</a>
    <button type="submit" class="btn btn-primary">Enviar</button>

</form>

<?php include_once "footer.php"; ?>
