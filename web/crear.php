<?php

require_once 'connexio.php';

/**
 * Funció que llegeix els paràmetres del formulari i crea una nova casa a la base de dades.
 * @param mixed 
 * @return void+
 */
function crear_casa($conn)
{
    $nom = $_POST['nom'];

    if (empty($nom)) {
        echo "<p class='error'>El nom de la casa no pot estar buit.</p>";
        return;
    }

    $sql = "INSERT INTO cases (name) VALUES (?)";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $nom);

    if ($stmt->execute()) {
        echo "<p class='info'>Casa creada amb èxit!</p>";
    } else {
        echo "<p class='error'>Error al crear la casa: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();

}


?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
</head>

<body>
    <h1>Crear una casa</h1>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        crear_casa($conn);
    } else {
        
        ?>
        <form method="POST" action="crear.php">
            <fieldset>
                <legend>CASA</legend>
                <label for="nom">Nom de la casa:</label>
                <input type="text" id="nom" name="nom">
                <input type="submit" value="Crear">
            </fieldset>
        </form>


        <?php
    }
    ?>
    <div id="menu">
        <hr>
        <p><a href="index.php">Portada</a> </p>
        <p><a href="llistar.php">Llistar</a></p>
        <p><a href="crear.php">Crear</a></p>
    </div>
</body>

</html>
