<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><?= isset($curso) ? 'Editar Curso' : 'Nuevo Curso' ?></h4>
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form action="index.php?c=curso&a=<?= isset($curso) ? 'editar&id=' . $curso['id_curso'] : 'crear' ?>" method="POST">
                    <div class="mb-3">
                        <label for="nombre_curso" class="form-label">Nombre del Curso</label>
                        <input type="text" name="nombre_curso" id="nombre_curso" class="form-control" value="<?= htmlspecialchars($curso['nombre_curso'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="genero_curso" class="form-label">Género / Categoría</label>
                        <input type="text" name="genero_curso" id="genero_curso" class="form-control" value="<?= htmlspecialchars($curso['genero_curso'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio_curso" class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio_curso" id="precio_curso" class="form-control" value="<?= htmlspecialchars($curso['precio_curso'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion_curso" class="form-label">Descripción</label>
                        <textarea name="descripcion_curso" id="descripcion_curso" class="form-control" rows="3" required><?= htmlspecialchars($curso['descripcion_curso'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="id_profesor" class="form-label">ID del Profesor</label>
                        <input type="number" name="id_profesor" id="id_profesor" class="form-control" value="<?= htmlspecialchars($curso['id_profesor'] ?? '') ?>">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?c=curso&a=index" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>