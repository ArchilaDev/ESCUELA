<!-- Encabezado de vista -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1" style="color: #f8fafc;">
            <i class="fa-solid fa-graduation-cap me-2" style="color: #818cf8;"></i>Cursos
        </h1>
        <p class="text-secondary small mb-0">Listado y gestión general de los cursos registrados</p>
    </div>
    <a href="<?= url('cursos', 'formulario') ?>" class="btn-custom text-decoration-none">
        <i class="fa-solid fa-plus me-1"></i> Nuevo Curso
    </a>
</div>

<!-- Estilos para tabla y buscador coherentes con el diseño base -->
<style>
    .card-table-custom {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 1.25rem;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
        overflow: hidden;
    }

    .search-card {
        background: rgba(30, 41, 59, 0.5);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 1rem;
    }

    .input-group-custom {
        position: relative;
    }

    .input-group-custom .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        z-index: 5;
        transition: color 0.2s ease;
        pointer-events: none;
    }

    .form-control-custom {
        background-color: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #f8fafc;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .form-control-custom:focus {
        background-color: rgba(15, 23, 42, 0.85);
        border-color: #6366f1;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
    }

    .form-control-custom:focus + .input-icon,
    .input-group-custom:focus-within .input-icon {
        color: #818cf8;
    }

    .btn-search-custom {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #cbd5e1;
        font-weight: 600;
        padding: 0.75rem 1.25rem;
        border-radius: 0.75rem;
        transition: all 0.2s ease;
    }

    .btn-search-custom:hover {
        background: rgba(99, 102, 241, 0.2);
        border-color: #6366f1;
        color: #ffffff;
    }

    /* Tabla personalizada */
    .table-dark-custom {
        --bs-table-bg: transparent;
        --bs-table-color: #e2e8f0;
        margin-bottom: 0;
    }

    .table-dark-custom th {
        background-color: rgba(15, 23, 42, 0.8);
        color: #94a3b8;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1rem;
    }

    .table-dark-custom td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding: 1rem;
        vertical-align: middle;
    }

    .table-dark-custom tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-dark-custom tbody tr:hover {
        background-color: rgba(99, 102, 241, 0.08);
    }

    .badge-category {
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.3);
        color: #a5b4fc;
        padding: 0.35em 0.65em;
        font-weight: 600;
        border-radius: 0.5rem;
    }

    .badge-price {
        background: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #86efac;
        padding: 0.35em 0.65em;
        font-weight: 700;
        border-radius: 0.5rem;
    }

    /* Botones de acción */
    .btn-action-edit {
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.3);
        color: #818cf8;
        font-size: 0.85rem;
        padding: 0.35rem 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }

    .btn-action-edit:hover {
        background: #6366f1;
        color: #ffffff;
        border-color: #6366f1;
    }

    .btn-action-delete {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fca5a5;
        font-size: 0.85rem;
        padding: 0.35rem 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }

    .btn-action-delete:hover {
        background: #ef4444;
        color: #ffffff;
        border-color: #ef4444;
    }
</style>

<!-- Formulario de Búsqueda -->
<form method="get" action="/index.php" class="search-card p-3 mb-4">
    <input type="hidden" name="c" value="cursos">
    <div class="row g-2 align-items-center">
        <div class="col-md-9 col-lg-10">
            <div class="input-group-custom">
                <input type="text" name="buscar" class="form-control form-control-custom" placeholder="Buscar por nombre o descripción..." value="<?= h($_GET['buscar'] ?? '') ?>">
                <i class="fa-solid fa-magnifying-glass input-icon"></i>
            </div>
        </div>
        <div class="col-md-3 col-lg-2">
            <button type="submit" class="btn btn-search-custom w-100">
                <i class="fa-solid fa-filter me-1"></i> Buscar
            </button>
        </div>
    </div>
</form>

<!-- Contenedor de Tabla con Glassmorphism -->
<div class="card card-table-custom">
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Género / Categoría</th>
                    <th>Profesor</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($curso)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-secondary">
                            <i class="fa-solid fa-folder-open fs-2 mb-2 d-block text-slate-500"></i>
                            No hay cursos registrados.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($curso as $c): ?>
                        <tr>
                            <td>
                                <strong style="color: #f8fafc;"><?= h($c['nombre_curso'] ?? '') ?></strong>
                            </td>
                            <td>
                                <span class="badge badge-category">
                                    <i class="fa-solid fa-layer-group me-1"></i><?= h($c['genero_curso'] ?? 'N/A') ?>
                                </span>
                            </td>
                            <td class="text-secondary">
                                <i class="fa-regular fa-user me-1 text-slate-400"></i><?= h(($c['nombre_profesor'] ?? '') . ' ' . ($c['apellido_profesor'] ?? '')) ?>
                            </td>
                            <td>
                                <span class="badge badge-price">
                                    $<?= number_format((float) ($c['precio_curso'] ?? 0), 2) ?>
                                </span>
                            </td>
                            <td class="text-secondary small" style="max-width: 250px;">
                                <?= h($c['descripcion_curso'] ?? '') ?>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="<?= url('cursos', 'formulario', ['id_curso' => $c['id_curso']]) ?>" class="btn btn-action-edit text-decoration-none">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>
                                    <form action="<?= url('cursos', 'eliminar') ?>" method="post" class="d-inline" onsubmit="return confirm('¿Seguro de eliminar este curso?');">
                                        <input type="hidden" name="id" value="<?= (int) $c['id_curso'] ?>">
                                        <button type="submit" class="btn btn-action-delete">
                                            <i class="fa-solid fa-trash-can"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>