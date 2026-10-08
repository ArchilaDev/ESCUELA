<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><?= $item['id_curso'] ? 'Editar curso' : 'Nuevo curso' ?></h1>
    <a href="<?= url('cursos') ?>" class="btn btn-outline-secondary btn-sm">&lArr; Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= url('cursos', 'guardar') ?>" method="post">
            <input type="hidden" name="id_curso" value="<?= (int) $item['id_curso'] ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre_curso" class="form-control" maxlength="80" required value="<?= h($item['nombre_curso']) ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Estudiante</label>
                    <select name="id_estudiante" class="form-select" required>
                        <option value="">Elige un Estudiante</option>
                        <?php foreach ($estudiantes as $es): ?>
                            <option value="<?= $es['id_estudiante'] ?>" <?= (int) $item['id_estudiante'] === (int) $es['id_estudiante'] ? 'selected' : '' ?>>
                                <?= h($es['nombre_estudiante']) ?><?= $es['activo'] ? '' : ' (inactivo)' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Genero del curso</label>
                    <select name="genero_curso" class="form-select">
                        <?php foreach($generos as $g): ?>
                            <option value="<?= $g ?>" <?= $item['genero_curso'] === $g ? 'selected' : '' ?>><?= $g ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio_curso" class="form-control" maxlength="80" value="<?= h($item['precio_curso']) ?>">
                </div>
                
             
            </div>

            <div class="row">
               
                <div class="col-md-4 mb-3">
                    <label class="form-label">Descripcion del curso</label>
                    <input type="text" step="0.01" name="descripcion_curso" class="form-control" value="<?= h($item['descripcion_curso']) ?>">
                </div>


            <button type="submit" class="btn btn-primary">Guardar Cursos</button>
        </form>
    </div>
</div>