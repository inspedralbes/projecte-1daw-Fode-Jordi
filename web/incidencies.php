<?php include_once "header.php"; ?>
<?php include_once "connexio.php"; ?>

<div class="card mt-4">
    <div class="card-header bg-danger text-white d-flex justify-content-between">
        <h3>Llistat d'incidències</h3>
        <a href="crear_incidencia.php" class="btn btn-light">+ Nova incidència</a>
    </div>
    <div class="card-body">
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'ok'): ?>
            <div class="alert alert-success">Incidència creada correctament!</div>
        <?php endif; ?>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Descripció</th>
                    <th>Departament</th>
                    <th>Tècnic</th>
                    <th>Tipus</th>
                    <th>Prioritat</th>
                    <th>Data creació</th>
                    <th>Data finalització</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT i.*, d.nom as nom_departament, t.nom as nom_tecnic
                        FROM INCIDENCIA i
                        LEFT JOIN DEPARTAMENT d ON i.departament = d.idDepartament
                        LEFT JOIN TECNIC t ON i.tecnic = t.idTecnic
                        ORDER BY i.data DESC";
                $result = $conn->query($sql);

                if ($result->num_rows == 0): ?>
                    <tr>
                        <td colspan="8" class="text-center">No hi ha incidències registrades.</td>
                    </tr>
                <?php else:
                    while($row = $result->fetch_assoc()): ?>
                        <td>
                            <td><?= $row['idIncidencia'] ?></td>
                            <td><?= htmlspecialchars($row['descripcio']) ?></td>
                            <td><?= htmlspecialchars($row['nom_departament']) ?></td>
                            <td><?= htmlspecialchars($row['nom_tecnic']) ?></td>
                            <td><?= $row['tipo'] ?></td>
                            <td>
                                <span class="badge <?= $row['prioritat'] == 'Alta' ? 'bg-danger' : ($row['prioritat'] == 'Mitja' ? 'bg-warning' : 'bg-secondary') ?>">
                                    <?= $row['prioritat'] ?>
                                </span>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($row['data'])) ?></td>
                            <td><?= $row['dataFinalitzacio'] ? date('d/m/Y', strtotime($row['dataFinalitzacio'])) : '-' ?></td>
                        </tr>
                    <?php endwhile;
                endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once "footer.php"; ?>
