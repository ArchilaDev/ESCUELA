<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Estudiantes</h1>
    <a href="<?= url('mascotas', 'formulario') ?>" class="btn btn-primary">+ Nuevo Estudiante</a>
</div>

<form action="<?= url('mascotas') ?>" method="get" class="row g-2 mb-3">
    <div class="col-sm-5 col-md-4">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por mascota, raza o dueño" value="<?= h($buscar) ?>">
    </div>

    <div class="col-sm-3 col-md-3">
        <select name="estado" class="form-select">
            <option value="">Todos los estados clínicos</option>
            <?php foreach ($estados as $e): ?>
                <option value="<?= $e ?>" <?= $estado === $e ? 'selected' : '' ?>><?= $e ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-sm-2 col-md-2">
        <select name="activo" class="form-select">
            <option value="">Activas e inactivas</option>
            <option value="1" <?= $activo === '1' ? 'selected' : '' ?>>Activo</option>
            <option value="0" <?= $activo === '0' ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </div>

    <div class="col-sm-2">
        <button type="submit" class="btn btn-outline-secondary w-100">Filtrar</button>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-hover align-middle bg-white">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Especie/Raza</th>
                <th>Dueño</th>
                <th>Estado Clínico</th>
                <th>Estado</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$mascotas): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No hay mascotas con ese filtro.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($mascotas as $m): ?>
                <tr class="<?= $m['activo'] ? '' : 'table-secondary text-muted' ?>">
                    <td><?= h($m['nombreM']) ?></td>
                    <td><?= h($m['especie']) ?><?= $m['raza'] ? ' · ' . h($m['raza']) : '' ?></td>
                    <td>
                        <?= h($m['cliente_nombre']) ?>
                        <?php if (!$m['cliente_activo']) : ?><span class="badge bg-secondary">Dueño inactivo</span><?php endif; ?>
                    </td>

                    <td>
                        <form action="<?= url('mascotas', 'estado') ?>" method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $m['idMascota'] ?>">
                            <select name="estado" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()" <?= $m['activo'] ? '' : 'disabled' ?>>
                                <?php foreach ($estados as $e): ?>
                                    <option value="<?= $e ?>" <?= $m['estado'] === $e ? 'selected' : '' ?>><?= $e ?></option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </td>
                    <td class="text-center">
                        <span class="badge <?= $m['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $m['activo'] ? 'Activa' : 'Inactiva' ?>
                        </span>
                    </td>
                    <td class="text-end text-nowrap">
                        <a href="<?= url('mascotas', 'formulario', ['id' => $m['idMascota']]) ?>" class="btn btn-sm btn-outline-primary">Editar</a>

                        <form action="<?= url('mascotas', 'activo') ?>" method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $m['idMascota'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-secondary"><?= $m['activo'] ? 'Desactivar' : 'Activar' ?></button>
                        </form>
                        
                        <form action="<?= url('mascotas', 'eliminar') ?>" method="post" class="d-inline" onsubmit="return confirm('¿Eliminar la ficha de <?= h($m['nombreM'])?>?');">
                            <input type="hidden" name="id" value="<?= $m['idMascota'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>