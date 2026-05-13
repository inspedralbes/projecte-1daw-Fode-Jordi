<?php
require_once 'logger.php';
require_once 'connexio_mongo.php';
include_once 'header.php';
?>

<h2>Estadístiques d'Accés</h2>
<br>

<?php
$filtre = [];
if (!empty($_GET['data'])) {
    $data = new MongoDB\BSON\UTCDateTime(strtotime($_GET['data']) * 1000);
    $filtre['timestamp'] = ['$gte' => $data];
}
if (!empty($_GET['usuari'])) {
    $filtre['usuari'] = $_GET['usuari'];
}
if (!empty($_GET['url'])) {
    $filtre['url'] = ['$regex' => $_GET['url']];
}

// Total accessos
$total = $coleccioLogs->countDocuments($filtre);
?>

<p><strong>Total d'accessos:</strong> <?php echo $total; ?></p>
<br>

<form method="GET" action="estadistiques.php" class="mb-4">
    <div class="d-flex gap-3">
        <input type="date" name="data" class="form-control" value="<?php echo $_GET['data'] ?? ''; ?>">
        <input type="text" name="usuari" class="form-control" placeholder="Usuari" value="<?php echo $_GET['usuari'] ?? ''; ?>">
        <input type="text" name="url" class="form-control" placeholder="Pàgina" value="<?php echo $_GET['url'] ?? ''; ?>">
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="estadistiques.php" class="btn btn-secondary">Netejar</a>
    </div>
</form>

<h5>Pàgines més visitades</h5>
<?php
$paginesVisitades = $coleccioLogs->aggregate([
    ['$match' => $filtre],
    ['$group' => ['_id' => '$url', 'total' => ['$sum' => 1]]],
    ['$sort' => ['total' => -1]],
    ['$limit' => 10]
]);
?>
<table class="table table-bordered">
    <thead>
        <tr><th>URL</th><th>Visites</th></tr>
    </thead>
    <tbody>
        <?php foreach ($paginesVisitades as $pagina): ?>
            <tr>
                <td><?php echo $pagina['_id']; ?></td>
                <td><?php echo $pagina['total']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h5>Usuaris més actius</h5>
<?php
$usuarisActius = $coleccioLogs->aggregate([
    ['$match' => array_merge($filtre, ['usuari' => ['$ne' => null]])],
    ['$group' => ['_id' => '$usuari', 'total' => ['$sum' => 1]]],
    ['$sort' => ['total' => -1]],
    ['$limit' => 10]
]);
?>
<table class="table table-bordered">
    <thead>
        <tr><th>Usuari</th><th>Accessos</th></tr>
    </thead>
    <tbody>
        <?php foreach ($usuarisActius as $usuari): ?>
            <tr>
                <td><?php echo $usuari['_id']; ?></td>
                <td><?php echo $usuari['total']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h5>Accessos per dia</h5>
<?php
$accessosDia = $coleccioLogs->aggregate([
    ['$match' => $filtre],
    ['$group' => [
        '_id' => [
            '$dateToString' => ['format' => '%Y-%m-%d', 'date' => '$timestamp']
        ],
        'total' => ['$sum' => 1]
    ]],
    ['$sort' => ['_id' => 1]]
]);
?>
<table class="table table-bordered">
    <thead>
        <tr><th>Dia</th><th>Accessos</th></tr>
    </thead>
    <tbody>
        <?php foreach ($accessosDia as $dia): ?>
            <tr>
                <td><?php echo $dia['_id']; ?></td>
                <td><?php echo $dia['total']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="admin.php" class="btn btn-secondary">Tornar</a>

<?php include_once 'footer.php'; ?>