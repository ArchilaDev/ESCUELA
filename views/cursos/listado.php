<?php require_once __DIR__ . '/../layout_header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Cursos</h2>
    <a href="index.php?c=curso&a=crear" class="btn btn-success">Nuevo Curso</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Género / Categoría</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Profesor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cursos)): ?>
                <?php foreach ($cursos as $c): ?>
                    <tr>
                        <td><?= $c['id_curso'] ?></td>
                        <td><?= htmlspecialchars($c['nombre_curso']) ?></td>
                        <td><?= htmlspecialchars($c['genero_curso']) ?></td>
                        <td>$<?= number_format($c['precio_curso'], 2) ?></td>
                        <td><?= htmlspecialchars($c['descripcion_curso']) ?></td>
                        <td>
                            <?= htmlspecialchars(($c['nombre_profesor'] ?? '') . ' ' . ($c['apellido_profesor'] ?? '')) ?>
                        </td>
                        <td>
                            <a href="index.php?c=curso&a=editar&id=<?= $c['id_curso'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?c=curso&a=eliminar&id=<?= $c['id_curso'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este curso?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No hay cursos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>