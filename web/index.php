<?php 
require_once 'logger.php';
include_once "header.php"; 
?>

<div class="container mt-4">

    <div class="text-center mb-5">
        <h1 class="fw-bold"><i class="bi bi-pc-display"></i> Gestor d'Incidències</h1>
        <p class="text-muted fs-5">Selecciona el teu perfil per accedir al sistema</p>
        <hr>
    </div>

    <div class="row g-4 justify-content-center mb-5">

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-person-workspace fs-1 text-info mb-3 d-block"></i>
                    <h5 class="card-title">Professor</h5>
                    <p class="card-text text-muted">Crea noves incidències i consulta l'estat de les existents.</p>
                    <a href="professor.php" class="btn btn-info">
                        <i class="bi bi-arrow-right-circle"></i> Accedir
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-tools fs-1 text-success mb-3 d-block"></i>
                    <h5 class="card-title">Tècnic</h5>
                    <p class="card-text text-muted">Gestiona i resol les incidències assignades al teu perfil.</p>
                    <a href="tecnic.php" class="btn btn-success">
                        <i class="bi bi-arrow-right-circle"></i> Accedir
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-shield-lock fs-1 text-danger mb-3 d-block"></i>
                    <h5 class="card-title">Administrador</h5>
                    <p class="card-text text-muted">Accedeix al panel complet de gestió i estadístiques del sistema.</p>
                    <a href="admin.php" class="btn btn-danger">
                        <i class="bi bi-arrow-right-circle"></i> Accedir
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include_once "footer.php"; ?>
