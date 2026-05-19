<?php  
require_once 'logger.php';
include_once "header.php"; 
?>

<div class="container mt-4">

    <div class="text-center mb-5">
        <h2><i class="bi bi-shield-lock"></i> Panel d'Administrador</h2>
        <p class="text-muted">Gestiona les incidències i consulta els informes del sistema</p>
        <hr>
    </div>

    <h5 class="text-secondary mb-3"><i class="bi bi-exclamation-triangle"></i> Gestió d'Incidències</h5>
    <div class="row g-4 mb-5">

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-list-ul fs-1 text-danger mb-3 d-block"></i>
                    <h5 class="card-title">Llistat d'incidències</h5>
                    <p class="card-text text-muted">Consulta totes les incidències registrades al sistema.</p>
                    <a href="incidencies.php" class="btn btn-danger">
                        <i class="bi bi-arrow-right-circle"></i> Accedir
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-pencil-square fs-1 text-danger mb-3 d-block"></i>
                    <h5 class="card-title">Modificar incidència</h5>
                    <p class="card-text text-muted">Edita o actualitza l'estat de les incidències existents.</p>
                    <a href="modificar_incidencia.php" class="btn btn-danger">
                        <i class="bi bi-arrow-right-circle"></i> Accedir
                    </a>
                </div>
            </div>
        </div>

    </div>
    
    <h5 class="text-secondary mb-3"><i class="bi bi-bar-chart"></i> Informes i Estadístiques</h5>
    <div class="row g-4 mb-5">

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-person-badge fs-1 text-warning mb-3 d-block"></i>
                    <h5 class="card-title">Informe tècnics</h5>
                    <p class="card-text text-muted">Rendiment i activitat dels tècnics assignats.</p>
                    <a href="informe_tecnics.php" class="btn btn-warning">
                        <i class="bi bi-arrow-right-circle"></i> Accedir
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-building fs-1 text-warning mb-3 d-block"></i>
                    <h5 class="card-title">Consum departaments</h5>
                    <p class="card-text text-muted">Anàlisi del consum d'incidències per departament.</p>
                    <a href="informe_departaments.php" class="btn btn-warning">
                        <i class="bi bi-arrow-right-circle"></i> Accedir
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <i class="bi bi-graph-up fs-1 text-warning mb-3 d-block"></i>
                    <h5 class="card-title">Estadístiques d'accés</h5>
                    <p class="card-text text-muted">Visualitza les estadístiques d'accessos al sistema.</p>
                    <a href="estadistiques.php" class="btn btn-warning">
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
