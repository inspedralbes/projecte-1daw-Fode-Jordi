<?php
require_once 'logger.php';
include_once "connexio.php";

$tecnics = $conn->query("SELECT * FROM TECNIC");
?>

<?php include_once "header.php"; ?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-person-badge"></i> Selecciona un Tècnic</h2>
        <p class="text-muted">Escull un tècnic per veure les seves incidències assignades</p>
        <hr>
    </div>

    <div class="row g-4 mb-5">
        <?php while ($tec = $tecnics->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-person-circle fs-1 text-success mb-3 d-block"></i>
                        <h5 class="card-title"><?php echo htmlspecialchars($tec["nom"]); ?></h5>
                        <p class="card-text text-muted">Veure incidències assignades a aquest tècnic.</p>
                        <a href="tecnic_incidencies.php?id=<?php echo $tec["idTecnic"]; ?>" class="btn btn-success">
                            <i class="bi bi-arrow-right-circle"></i> Veure incidències
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="text-center">
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-house"></i> Tornar a l'inici
        </a>
    </div>

</div>

<?php include_once "footer.php"; ?>