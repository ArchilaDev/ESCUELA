<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Estudiantes</h1>
    <a href="<?= url('estudiantes', 'formulario') ?>" class="btn btn-primary btn-sm">+ Nuevo Estudiante</a>
</div>

<form method="get" action="/index.php" class="row g-2 mb-3">
    <input type="hidden" name="c" value="estudiantes">
    <div class="col-md-8">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar estudiante por nombre, apellido o correo..." value="<?= h($_GET['buscar'] ?? '') ?>">
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-secondary w-100">Buscar</button>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Email</th>
                <th>Edad</th>
                <th>País</th>
                <th>Idioma</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($estudiantes)): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">No hay estudiantes registrados.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($estudiantes as $e): ?>
                    <tr>
                        <td><strong><?= h(($e['nombre_estudiante'] ?? '') . ' ' . ($e['apellido_estudiante'] ?? '')) ?></strong></td>
                        <td><?= h($e['email_estudiante'] ?? '') ?></td>
                        <td><?= h($e['edad_estudiante'] ?? 'N/A') ?></td>
                        <td><?= h($e['pais_estudiante'] ?? 'N/A') ?></td>
                        <td><?= h($e['idioma_estudiante'] ?? 'N/A') ?></td>
                        <td>
                            <?php if (!empty($e['activo'])): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="<?= url('estudiantes', 'estado') ?>" method="post" class="d-inline">
                                <input type="hidden" name="id" value="<?= (int) $e['id_estudiante'] ?>">
                                <button type="submit" class="btn btn-sm <?= !empty($e['activo']) ? 'btn-outline-warning' : 'btn-outline-success' ?>">
                                    <?= !empty($e['activo']) ? 'Desactivar' : 'Activar' ?>
                                </button>
                            </form>
                            <a href="<?= url('estudiantes', 'formulario', ['id' => $e['id_estudiante']]) ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="<?= url('estudiantes', 'eliminar') ?>" method="post" class="d-inline" onsubmit="return confirm('¿Seguro de eliminar este estudiante?');">
                                <input type="hidden" name="id" value="<?= (int) $e['id_estudiante'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>