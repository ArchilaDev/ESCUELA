<?php require_once __DIR__ . '/../layout_header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Estudiantes</h2>
    <a href="<?= url('estudiantes', 'formulario') ?>" class="btn btn-primary">Nuevo Estudiante</a>
</div>

<?php if (!empty($_SESSION['mensaje'])): ?>
    <div class="alert alert-<?= $_SESSION['mensaje_tipo'] === 'peligro' ? 'danger' : 'success' ?> alert-dismissible fade show">
        <?= h($_SESSION['mensaje']) ?>
        <?php unset($_SESSION['mensaje'], $_SESSION['mensaje_tipo']); ?>
    </div>
<?php endif; ?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($estudiantes)): ?>
            <?php foreach ($estudiantes as $e): ?>
                <tr>
                    <td><?= h($e['id_estudiante']) ?></td>
                    <td><?= h($e['nombre']) ?></td>
                    <td><?= h($e['apellido']) ?></td>
                    <td><?= h($e['email']) ?></td>
                    <td>
                        <a href="<?= url('estudiantes', 'formulario', ['id' => $e['id_estudiante']]) ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="<?= url('estudiantes', 'eliminar', ['id' => $e['id_estudiante']]) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este estudiante?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No hay estudiantes registrados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../layout_footer.php'; ?>