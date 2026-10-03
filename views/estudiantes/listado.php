<?php require_once __DIR__ . '/../layout_header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Estudiantes</h2>
    <a href="index.php?c=estudiante&a=crear" class="btn btn-success">Nuevo Estudiante</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Edad</th>
                <th>País</th>
                <th>Idioma</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($estudiantes)): ?>
                <?php foreach ($estudiantes as $e): ?>
                    <tr>
                        <td><?= $e['id_estudiante'] ?></td>
                        <td><?= htmlspecialchars($e['nombre_estudiante']) ?></td>
                        <td><?= htmlspecialchars($e['apellido_estudiante'] ?? '') ?></td>
                        <td><?= htmlspecialchars($e['email_estudiante']) ?></td>
                        <td><?= $e['edad_estudiante'] ?></td>
                        <td><?= htmlspecialchars($e['pais_estudiante'] ?? '') ?></td>
                        <td><?= htmlspecialchars($e['idioma_estudiante']) ?></td>
                        <td>
                            <a href="index.php?c=estudiante&a=editar&id=<?= $e['id_estudiante'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?c=estudiante&a=eliminar&id=<?= $e['id_estudiante'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este estudiante?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No hay estudiantes registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>