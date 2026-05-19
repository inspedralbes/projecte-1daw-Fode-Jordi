    <?php
    require_once 'logger.php';
    include_once "connexio.php";

    $idTecnic = $_GET["id"];

    $sentencia = $conn->prepare("SELECT * FROM INCIDENCIA WHERE tecnic = ?");
    $sentencia->bind_param("i", $idTecnic);
    $sentencia->execute();
    $resultat = $sentencia->get_result();
    ?>

    <?php include_once "header.php"; ?>

    <div class="container mt-4">

        <div class="mb-4">
            <h2><i class="bi bi-list-check"></i> Incidències del tècnic</h2>
            <p class="text-muted">Llistat d'incidències assignades</p>
            <hr>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Títol</th>
                            <th>Prioritat</th>
                            <th>Data</th>
                            <th>Estat</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($inc = $resultat->fetch_assoc()): ?>
                            <tr>
                                <td class="fw-bold text-muted">#<?php echo $inc["idIncidencia"]; ?></td>
                                <td><?php echo htmlspecialchars($inc["titol"]); ?></td>
                                <td>
                                    <?php
                                    $prioritat = $inc["prioritat"];
                                    if ($prioritat == "Alta") {
                                        echo '<span class="badge bg-danger">' . $prioritat . '</span>';
                                    } elseif ($prioritat == "Mitja") {
                                        echo '<span class="badge bg-warning text-dark">' . $prioritat . '</span>';
                                    } else {
                                        echo '<span class="badge bg-success">' . $prioritat . '</span>';
                                    }
                                    ?>
                                </td>
                                <td><i class="bi bi-calendar3"></i> <?php echo $inc["data"]; ?></td>
                                <td>
                                    <?php if ($inc["dataFinalitzacio"] == NULL): ?>
                                        <span class="badge bg-success"><i class="bi bi-unlock"></i> Oberta</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><i class="bi bi-lock"></i> Tancada</span>
                                    <?php endif; ?>
                                </td>
                                <td class="d-flex gap-2">
                                    <a href="afegir_actuacio.php?id=<?php echo $inc["idIncidencia"]; ?>" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i> Actuació
                                    </a>
                                    <a href="gestionar_incidencia.php?id=<?php echo $inc["idIncidencia"]; ?>&idTecnic=<?php echo $idTecnic; ?>" class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Tancar
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <a href="tecnic.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Tornar
            </a>
        </div>

    </div>

    <?php include_once "footer.php"; ?>
