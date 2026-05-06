<?php include_once "header.php"; ?>
<?php include_once "connexio.php"; ?>

<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h3>Crear nova incidència</h3>
    </div>
    <div class="card-body">
        <form action="guardar_incidencia.php" method="POST">
            <div class="mb-3">
                <label for="descripcio" class="form-label">Descripció</label>
                <textarea class="form-control" id="descripcio" name="descripcio" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="departament" class="form-label">Departament</label>
                <select class="form-select" id="departament" name="departament" required>
                    <option value="">Selecciona...</option>
                    <?php
                    $result = $conn->query("SELECT idDepartament, nom FROM DEPARTAMENT");
                    while($row = $result->fetch_assoc()):
                    ?>
                        <option value="<?= $row['idDepartament'] ?>"><?= htmlspecialchars($row['nom']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tecnic" class="form-label">Tècnic assignat</label>
                <select class="form-select" id="tecnic" name="tecnic" required>
                    <option value="">Selecciona...</option>
                    <?php
                    $result = $conn->query("SELECT idTecnic, nom FROM TECNIC");
                    while($row = $result->fetch_assoc()):
                    ?>
                        <option value="<?= $row['idTecnic'] ?>"><?= htmlspecialchars($row['nom']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipus</label>
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="Software">Software</option>
                    <option value="Hardware">Hardware</option>
                    <option value="Internet">Internet</option>
                    <option value="Corrent">Corrent</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="dataFinalitzacio" class="form-label">Data finalització (opcional)</label>
                <input type="date" class="form-control" id="dataFinalitzacio" name="dataFinalitzacio">
            </div>

            <button type="submit" class="btn btn-success">Guardar incidència</button>
            <a href="incidencies.php" class="btn btn-secondary">Cancel·lar</a>
        </form>
    </div>
</div>

<?php include_once "footer.php"; ?>
