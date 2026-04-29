<?php
// Configuració de la connexió a la base de dades
$servername = "db"; // Nom del servei definit al docker-compose.yaml
$username = "usuari"; // Usuari definit al docker-compose.yaml
$password = "paraula_de_pas"; // Contrasenya definida al docker-compose.yaml
$dbname = "persones"; // Nom de la base de dades


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<p>Error de connexió: " . htmlspecialchars($conn->connect_error) . "</p>";
    die("Error de connexió: " . $conn->connect_error);
}

