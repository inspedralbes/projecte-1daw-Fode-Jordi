<?php
include_once "header.php";
$mysqli = include_once "conexion.php";

$resultado = $mysqli->query("SELECT * FROM registros");
$registros = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<h2>Lista de registros</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Acciones</th>
</tr>

<?php foreach ($registros as $r) { ?>
<tr>
    <td><?php echo $r["id"]; ?></td>
    <td><?php echo $r["nombre"]; ?></td>
    <td><?php echo $r["descripcion"]; ?></td>
    <td>
        <a href="editar.php?id=<?php echo $r["id"]; ?>">Editar</a>
        <a href="eliminar.php?id=<?php echo $r["id"]; ?>">Eliminar</a>
    </td>
</tr>
<?php } ?>

</table>

<?php include_once "footer.php"; ?>