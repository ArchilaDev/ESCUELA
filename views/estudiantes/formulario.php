<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                <h4><?= isset($estudiante) ? 'Editar Estudiante' : 'Nuevo Estudiante' ?></h4>
            </div>
            <div class="card-body">
                <form action="<?= url('estudiantes', 'guardar') ?>" method="POST">
                    <?php if (isset($estudiante)): ?>
                        <input type="hidden" name="id_estudiante" value="<?= h($estudiante['id_estudiante']) ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?= h($estudiante['nombre'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" value="<?= h($estudiante['apellido'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= h($estudiante['email'] ?? '') ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="<?= url('estudiantes') ?>" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>