<?php require_once __DIR__ . '/../layout_header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><?= isset($estudiante) ? 'Editar Estudiante' : 'Nuevo Estudiante' ?></h4>
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form action="index.php?c=estudiante&a=<?= isset($estudiante) ? 'editar&id=' . $estudiante['id_estudiante'] : 'crear' ?>" method="POST">
                    <div class="mb-3">
                        <label for="nombre_estudiante" class="form-label">Nombre</label>
                        <input type="text" name="nombre_estudiante" id="nombre_estudiante" class="form-control" value="<?= htmlspecialchars($estudiante['nombre_estudiante'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido_estudiante" class="form-label">Apellido</label>
                        <input type="text" name="apellido_estudiante" id="apellido_estudiante" class="form-control" value="<?= htmlspecialchars($estudiante['apellido_estudiante'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email_estudiante" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email_estudiante" id="email_estudiante" class="form-control" value="<?= htmlspecialchars($estudiante['email_estudiante'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="edad_estudiante" class="form-label">Edad</label>
                        <input type="number" name="edad_estudiante" id="edad_estudiante" class="form-control" value="<?= htmlspecialchars($estudiante['edad_estudiante'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="pais_estudiante" class="form-label">País</label>
                        <input type="text" name="pais_estudiante" id="pais_estudiante" class="form-control" value="<?= htmlspecialchars($estudiante['pais_estudiante'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="idioma_estudiante" class="form-label">Idioma</label>
                        <input type="text" name="idioma_estudiante" id="idioma_estudiante" class="form-control" value="<?= htmlspecialchars($estudiante['idioma_estudiante'] ?? '') ?>" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?c=estudiante&a=index" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>