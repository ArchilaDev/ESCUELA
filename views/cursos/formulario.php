<!-- Encabezado de vista -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1" style="color: #f8fafc;">
            <i class="fa-solid <?= !empty($item['id_curso']) ? 'fa-pen-to-square' : 'fa-folder-plus' ?> me-2 text-indigo-400" style="color: #818cf8;"></i>
            <?= !empty($item['id_curso']) ? 'Editar curso' : 'Nuevo curso' ?>
        </h1>
        <p class="text-secondary small mb-0">Gestiona la información del curso en la plataforma</p>
    </div>
    <a href="<?= url('cursos') ?>" class="btn-nav-custom text-decoration-none">
        <i class="fa-solid fa-arrow-left me-1"></i> Volver
    </a>
</div>

<!-- Estilos específicos para componentes de formulario dentro de la vista -->
<style>
    .card-custom {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 1.25rem;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
    }

    .form-label-custom {
        color: #94a3b8;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .form-control-custom,
    .form-select-custom {
        background-color: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #f8fafc;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        background-color: rgba(15, 23, 42, 0.85);
        border-color: #6366f1;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
    }

    /* Estilo para las opciones del desplegable */
    .form-select-custom option {
        background-color: #0f172a;
        color: #f8fafc;
    }

    .btn-custom {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        border: none;
        color: #ffffff;
        font-weight: 600;
        padding: 0.75rem 1.75rem;
        border-radius: 0.75rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);
    }

    .btn-custom:hover {
        background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.45);
    }

    .btn-custom:active {
        transform: translateY(0);
    }
</style>

<!-- Tarjeta de Formulario -->
<div class="card card-custom">
    <div class="card-body p-4 p-md-5">
        <form action="<?= url('cursos', 'guardar') ?>" method="post">
            <input type="hidden" name="id_curso" value="<?= (int) ($item['id_curso'] ?? 0) ?>">

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label form-label-custom">Nombre del curso</label>
                    <input type="text" name="nombre_curso" class="form-control form-control-custom" maxlength="80" required value="<?= h($item['nombre_curso'] ?? '') ?>" placeholder="Ej: Programación en Luau">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label form-label-custom">Género / Categoría</label>
                    <select name="genero_curso" class="form-select form-select-custom" required>
                        <option value="">Elige una opción</option>
                        <?php foreach(mdlCurso::GENERO as $e): ?>
                            <option value="<?= $e ?>" <?= ($item['genero_curso'] ?? '') === $e ? 'selected' : '' ?>><?= $e ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label form-label-custom">Precio del curso</label>
                    <input type="number" step="0.01" name="precio_curso" class="form-control form-control-custom" required value="<?= h($item['precio_curso'] ?? '') ?>" placeholder="0.00">
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label form-label-custom">Descripción del curso</label>
                    <input type="text" name="descripcion_curso" class="form-control form-control-custom" required value="<?= h($item['descripcion_curso'] ?? '') ?>" placeholder="Breve descripción del contenido">
                </div>
            </div>

            <div class="d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-custom">
                    <i class="fa-solid fa-floppy-disk me-2"></i>Guardar Curso
                </button>
            </div>
        </form>
    </div>
</div>