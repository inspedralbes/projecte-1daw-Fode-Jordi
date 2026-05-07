<?php
include_once "connexio.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $prioritat = $_POST["prioritat"];
    $tipo = $_POST["tipo"];
    $tecnic = $_POST["tecnic"];

    $sentencia = $conn->prepare("UPDATE INCIDENCIA SET prioritat = ?, tipo = ?, tecnic = ? WHERE idIncidencia = ?");
    $sentencia->bind_param("ssii", $prioritat, $tipo, $tecnic, $id);
    $sentencia->execute();
    $sentencia->close();

    echo '<p>Incidencia modificada correctament.</p>';
    echo '<a href="index.php" class="btn btn-secondary">Tornar</a>';
    echo '<a href="modificar_incidencia.php" class="btn btn-primary">Modificar una altra</a>';
}
?>

<?php include_once "header.php"; ?>
<br>

<h2>Modificar Incidència</h2>
<br>

<?php
if (!isset($_GET["id"]) && $_SERVER["REQUEST_METHOD"] != "POST") {
?>

    <form method="GET" action="modificar_incidencia.php">
        <div class="mb-3">
            <label for="id">Introdueix el codi de la incidència:</label>
            <br>
            <input type="number" name="id" id="id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="index.php" class="btn btn-secondary">Tornar</a>
    </form>

<?php
} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sentencia = $conn->prepare("SELECT * FROM INCIDENCIA WHERE idIncidencia = ?");
    $sentencia->bind_param("i", $id);
    $sentencia->execute();
    $resultat = $sentencia->get_result();
    $incidencia = $resultat->fetch_assoc();

    $tecnics = $conn->query("SELECT * FROM TECNIC");

    if (!$incidencia) {
        echo '<p>No existeix cap incidencia amb aquest codi.</p>';
        echo '<a href="modificar_incidencia.php" class="btn btn-secondary">Tornar</a>';
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
    </table>

    <form method="POST" action="modificar_incidencia.php">

        <input type="hidden" name="id" value="<?php echo $incidencia["idIncidencia"]; ?>">

        <div class="mb-3">
            <label for="prioritat">Prioritat:</label>
            <br>
            <select name="prioritat" id="prioritat" class="form-select" required>
                <option value="">-- Selecciona prioritat --</option>
                <option value="Alta" <?php if ($incidencia["prioritat"] == "Alta") echo "selected"; ?>>Alta</option>
                <option value="Mitja" <?php if ($incidencia["prioritat"] == "Mitja") echo "selected"; ?>>Mitja</option>
                <option value="Baixa" <?php if ($incidencia["prioritat"] == "Baixa") echo "selected"; ?>>Baixa</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo">Tipus:</label>
            <br>
            <select name="tipo" id="tipo" class="form-select" required>
                <option value="">-- Selecciona tipus --</option>
                <option value="Software" <?php if ($incidencia["tipo"] == "Software") echo "selected"; ?>>Software</option>
                <option value="Hardware" <?php if ($incidencia["tipo"] == "Hardware") echo "selected"; ?>>Hardware</option>
                <option value="Internet" <?php if ($incidencia["tipo"] == "Internet") echo "selected"; ?>>Internet</option>
                <option value="Corrent" <?php if ($incidencia["tipo"] == "Corrent") echo "selected"; ?>>Corrent</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tecnic">Tècnic:</label>
            <br>
            <select name="tecnic" id="tecnic" class="form-select" required>
                <option value="">-- Selecciona tecnic --</option>
                <?php while ($tec = $tecnics->fetch_assoc()): ?>
                    <option value="<?php echo $tec["idTecnic"]; ?>" <?php if ($incidencia["tecnic"] == $tec["idTecnic"]) echo "selected"; ?>>
                        <?php echo $tec["nom"]; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar canvis</button>
        <a href="index.php" class="btn btn-secondary">Tornar</a>

    </form>

<?php
    }
}
?>

<?php include_once "footer.php"; ?>