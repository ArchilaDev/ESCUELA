<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Cursos</h1>
    <a href="<?= url('cursos', 'formulario') ?>" class="btn btn-primary">+ Nuevo Curso</a>
</div>

<form action="<?= url('cursos') ?>" method="get" class="row g-2 mb-3">
    <div class="col-sm-5 col-md-4">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por curso, genero o estudiante"
            value="<?= h($buscar) ?>">
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
                <th>Genero</th>
                <th>Precio</th>
                <th>Descripcion</th>
                <th>Estudiante</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$cursos): ?>
            <tr>
                <td colspan="6" class="text-center text-muted py-4">No hay cursos con ese filtro.</td>
            </tr>
            <?php endif; ?>

            <?php foreach ($cursos as $c): ?>
            <tr class="<?= $e['activo'] ? '' : 'table-secondary text-muted' ?>">
                <td><?= h($c['nombre_curso']) ?></td>
                <td><?= h($c['genero_curso']) ?></td>

                <td>
                    <?= h($c['precio_curso']) ?>
                    <?php if (!$c['precio_curso']) : ?><span class="badge bg-secondary">Precio</span><?php endif; ?>
                </td>


                <td>
                    <?= h($c['descripcion_curso']) ?>
                    <?php if (!$c['descripcion_curso']) : ?><span
                        class="badge bg-secondary">Descripcion</span><?php endif; ?>
                </td>

                <td>
                    <?= h($c['nombre_estudiante']) ?>
                    <?php if (!$c['activo']) : ?><span class="badge bg-secondary">Estudiante
                        inactivo</span><?php endif; ?>
                </td>

                <td class="text-end text-nowrap">
                    <a href="<?= url('cursos', 'formulario', ['id_curso' => $c['id_curso']]) ?>"
                        class="btn btn-sm btn-outline-primary">Editar</a>

                    

                    <form action="<?= url('cursos', 'eliminar') ?>" method="post" class="d-inline"
                        onsubmit="return confirm('¿Eliminar la ficha de <?= h($c['nombre_curso'])?>?');">
                        <input type="hidden" name="id" value="<?= $c['id_curso'] ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>