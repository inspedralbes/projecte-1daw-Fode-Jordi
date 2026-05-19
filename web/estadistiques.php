<?php
require_once 'connexio_mongo.php';
require_once 'logger.php';
include_once 'header.php';

$total = $collection->countDocuments();

$pagines = $collection->aggregate([
    ['$group' => ['_id' => '$url', 'total' => ['$sum' => 1]]],
    ['$sort' => ['total' => -1]],
    ['$limit' => 10]
]);

$usuaris = $collection->aggregate([
    ['$match' => ['usuari' => ['$ne' => null]]],
    ['$group' => ['_id' => '$usuari', 'total' => ['$sum' => 1]]],
    ['$sort' => ['total' => -1]],
    ['$limit' => 10]
]);

$perDia = $collection->aggregate([
    ['$group' => [
        '_id' => ['$substr' => ['$timestamp', 0, 10]],
        'total' => ['$sum' => 1]
    ]],
    ['$sort' => ['_id' => 1]]
]);
?>

<div class="container mt-4">

    <div class="mb-4">
        <h2><i class="bi bi-graph-up"></i> Estadístiques d'Accés</h2>
        <p class="text-muted">Resum dels accessos registrats al sistema</p>
        <hr>
    </div>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-dark text-white">
                <div class="card-body text-center p-4">
                    <i class="bi bi-activity fs-1 mb-2 d-block"></i>
                    <h6 class="text-white-50">Total d'accessos</h6>
                    <h2 class="fw-bold"><?php echo $total; ?></h2>
                </div>
            </div>
        </div>
    </div>


    <div class="mb-5">
        <h5 class="mb-3"><i class="bi bi-link-45deg"></i> Pàgines més visitades</h5>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="bi bi-file-earmark-code"></i> URL</th>
                            <th><i class="bi bi-eye"></i> Visites</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagines as $p): ?>
                            <tr>
                                <td><i class="bi bi-link text-secondary"></i> <?php echo htmlspecialchars($p['_id']); ?></td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">
                                        <?php echo $p['total']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h5 class="mb-3"><i class="bi bi-people"></i> Usuaris més actius</h5>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="bi bi-person"></i> Usuari</th>
                            <th><i class="bi bi-arrow-repeat"></i> Accessos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuaris as $u): ?>
                            <tr>
                                <td>
                                    <i class="bi bi-person-circle text-secondary"></i>
                                    <?php echo htmlspecialchars($u['_id']); ?>
                                </td>
                                <td>
                                    <span class="badge bg-success rounded-pill">
                                        <?php echo $u['total']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h5 class="mb-3"><i class="bi bi-calendar3"></i> Accessos per dia</h5>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="bi bi-calendar-date"></i> Dia</th>
                            <th><i class="bi bi-bar-chart"></i> Accessos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($perDia as $d): ?>
                            <tr>
                                <td><i class="bi bi-calendar3 text-secondary"></i> <?php echo $d['_id']; ?></td>
                                <td>
                                    <span class="badge bg-warning text-dark rounded-pill">
                                        <?php echo $d['total']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="admin.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Tornar
        </a>
    </div>

</div>

<?php include_once 'footer.php'; ?>

