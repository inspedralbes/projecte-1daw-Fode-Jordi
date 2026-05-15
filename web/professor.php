<?php include_once "header.php"; ?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-person-workspace"></i> Panel del Professor</h2>
        <p class="text-muted">Gestiona les teves incidències informàtiques</p>
        <hr>
    </div>

    <div class="row g-4 mb-5">

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-plus-circle fs-1 text-info mb-3 d-block"></i>
                    <h5 class="card-title">Nova Incidència</h5>
                    <p class="card-text text-muted">Crea una nova incidència informàtica per ser atesa pels tècnics.</p>
                    <a href="crear_incidencia.php" class="btn btn-info">
                        <i class="bi bi-arrow-right-circle"></i> Accedir
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-clipboard-check fs-1 text-warning mb-3 d-block"></i>
                    <h5 class="card-title">Estat Incidència</h5>
                    <p class="card-text text-muted">Consulta l'estat i les actuacions de les teves incidències.</p>
                    <a href="detall_incidencia.php" class="btn btn-warning">
                        <i class="bi bi-arrow-right-circle"></i> Accedir
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center">
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-house"></i> Tornar a l'inici
        </a>
    </div>

</div>

<?php include_once "footer.php"; ?>
