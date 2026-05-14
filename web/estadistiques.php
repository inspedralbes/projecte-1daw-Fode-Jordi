<?php
require_once 'logger.php';
require_once 'connexio_mongo.php';
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
<br>
<h2>Estadístiques d'Accés</h2>
<br>

<p><strong>Total d'accessos:</strong> <?php echo $total; ?></p>
<br>

<h5>Pàgines més visitades</h5>
<table class="table table-bordered">
    <thead>
        <tr><th>URL</th><th>Visites</th></tr>
    </thead>
    <tbody>
        <?php foreach ($pagines as $p): ?>
            <tr>
                <td><?php echo $p['_id']; ?></td>
                <td><?php echo $p['total']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h5>Usuaris més actius</h5>
<table class="table table-bordered">
    <thead>
        <tr><th>Usuari</th><th>Accessos</th></tr>
    </thead>
    <tbody>
        <?php foreach ($usuaris as $u): ?>
            <tr>
                <td><?php echo $u['_id']; ?></td>
                <td><?php echo $u['total']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h5>Accessos per dia</h5>
<table class="table table-bordered">
    <thead>
        <tr><th>Dia</th><th>Accessos</th></tr>
    </thead>
    <tbody>
        <?php foreach ($perDia as $d): ?>
            <tr>
                <td><?php echo $d['_id']; ?></td>
                <td><?php echo $d['total']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="admin.php" class="btn btn-secondary">Tornar</a>

<?php include_once 'footer.php'; ?>
<?php include_once 'footer.php'; ?>
