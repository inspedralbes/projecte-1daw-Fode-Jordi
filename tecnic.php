<?php
include_once "connexio.php";

$tecnics = $conn->query("SELECT * FROM TECNIC");
?>

<?php include_once "header.php"; ?>

<div class="text-center mt-5">

    <h2>Selecciona un Tècnic</h2>
    <br>

    <div class="d-flex justify-content-center gap-3">
        <?php while ($tec = $tecnics->fetch_assoc()): ?>
            <a href="tecnic_incidencies.php?id=<?php echo $tec["idTecnic"]; ?>" class="btn btn-success btn-lg">
                <?php echo $tec["nom"]; ?>
            </a>
        <?php endwhile; ?>
    </div>

    <br>
    <a href="index.php" class="btn btn-secondary">Tornar a l'inici</a>

</div>

<?php include_once "footer.php"; ?>