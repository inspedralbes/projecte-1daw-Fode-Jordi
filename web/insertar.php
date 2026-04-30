<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);?>



<h2>Nuevo registro</h2>

<form action="guardar.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <textarea name="descripcion" placeholder="Descripción" required></textarea>
    <button type="submit">Guardar</button>
</form>