<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Estudiantes</h1>
    <a href="<?= url('estudiantes', 'formulario') ?>" class="btn btn-primary">+ Nuevo Estudiante</a>
</div>

<form action="<?= url('estudiantes') ?>" method="get" class="row g-2 mb-3">
    <div class="col-sm-5 col-md-4">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre de estudiante o email " value="<?= h($buscar) ?>">
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
                <th>Email</th>
                <th>Edad</th>
                <th>Pais estudiante</th>
                <th>Idioma del estudiante</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$estudiantes): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No hay estudiantes  con ese filtro.</td>
                </tr>
            <?php endif; ?>
            <!--Nombre estudiante-->
            <?php foreach ($estudiantes as $es): ?>
                <tr class="<?= $es['activo'] ? '' : 'table-secondary text-muted' ?>">
                    <td><?= h($es['nombre_estudiante']) , ' ' , h($es['apellido_estudiante'])?></td>
                     <!--email estudiante-->
                    <td><?= h($es['email_estudiante']) ?></td>
                    
                     <!--edad estudiante-->
                    <td><?= h($es['edad_estudiante']) ?></td>
                    
            <!--Pais estudiante-->
                    <td><?= h($es['pais_estudiante']) ?></td>
                    
                         <!--idioma estudiante-->
                    <td><?= h($es['idioma_estudiante']) ?></td>
                     <!--mirar si se encuentra activo o inactivo el estudiante-->
                  

                        <!--Acciones-->
                    <td class="text-center">
                        <span class="badge <?= $es['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $es['activo'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td class="text-end text-nowrap">
                        <a href="<?= url('estudiantes', 'formulario', ['id' => $es['id_estudiante']]) ?>" class="btn btn-sm btn-outline-primary">Editar</a>

                        <form action="<?= url('estudiantes', 'activo') ?>" method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $es['id_estudiante'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-secondary"><?= $es['activo'] ? 'Desactivar' : 'Activar' ?></button>
                        </form>
                        
                        <form action="<?= url('estudiantes', 'eliminar') ?>" method="post" class="d-inline" onsubmit="return confirm('¿Eliminar la ficha de <?= h($es['nombre_estudiante'])?>?');">
                            <input type="hidden" name="id" value="<?= $es['id_estudiante'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>