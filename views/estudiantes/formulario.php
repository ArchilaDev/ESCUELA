<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><?= !empty($item['id_estudiante']) ? 'Editar estudiante' : 'Nuevo estudiante' ?></h1>
    <a href="<?= url('estudiantes') ?>" class="btn btn-outline-secondary btn-sm">&lArr; Volver</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= url('estudiantes', 'guardar') ?>" method="post">
            <input type="hidden" name="id_estudiante" value="<?= (int) ($item['id_estudiante'] ?? 0) ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre_estudiante" class="form-control" maxlength="70" required value="<?= h($item['nombre_estudiante'] ?? '') ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido_estudiante" class="form-control" maxlength="70" required value="<?= h($item['apellido_estudiante'] ?? '') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email_estudiante" class="form-control" maxlength="80" required value="<?= h($item['email_estudiante'] ?? '') ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Edad</label>
                    <input type="number" name="edad_estudiante" class="form-control" min="1" max="120" value="<?= h($item['edad_estudiante'] ?? '') ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">País</label>
                    <input type="text" name="pais_estudiante" class="form-control" maxlength="50" value="<?= h($item['pais_estudiante'] ?? '') ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Idioma</label>
                    <input type="text" name="idioma_estudiante" class="form-control" maxlength="50" value="<?= h($item['idioma_estudiante'] ?? '') ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Estudiante</button>
        </form>
    </div>
</div>