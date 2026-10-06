<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAME-LANGUAGE</title>
    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- Google Fonts & FontAwesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top left, #1e1b4b, #0f172a, #090d16);
            background-attachment: fixed;
            min-height: 100vh;
            color: #f8fafc;
        }

        /* Navbar estilo Glassmorphism */
        .navbar-custom {
            background: rgba(30, 41, 59, 0.7) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }

        .brand-title {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        /* Botones de navegación */
        .btn-nav-custom {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.4rem 0.85rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-nav-custom:hover {
            background: rgba(99, 102, 241, 0.2);
            border-color: #6366f1;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-exit-custom {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.4rem 0.85rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-exit-custom:hover {
            background: rgba(239, 68, 68, 0.25);
            border-color: #ef4444;
            color: #ffffff;
            transform: translateY(-1px);
        }

        /* Chip de usuario */
        .user-badge {
            background: rgba(99, 102, 241, 0.15);
            border: 1px solid rgba(99, 102, 241, 0.3);
            color: #a5b4fc;
            padding: 0.35rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        /* Alertas estilizadas */
        .alert-dismissible .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .alert-success {
            background-color: rgba(34, 197, 94, 0.15) !important;
            border: 1px solid rgba(34, 197, 94, 0.3) !important;
            color: #86efac !important;
            border-radius: 0.75rem;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.15) !important;
            border: 1px solid rgba(239, 68, 68, 0.3) !important;
            color: #fca5a5 !important;
            border-radius: 0.75rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand navbar-dark navbar-custom mb-4 py-3">
    <div class="container">
        <a href="<?= url('cursos') ?>" class="navbar-brand d-flex align-items-center me-4">
            <div class="d-inline-flex align-items-center justify-content-center me-2 rounded-circle" style="width: 36px; height: 36px; background: rgba(99, 102, 241, 0.15);">
                <i class="fa-solid fa-code" style="color: #818cf8;"></i>
            </div>
            <span class="brand-title h5 mb-0">GAME-LANGUAGE</span>
        </a>
        <div class="d-flex align-items-center ms-auto">
            <a href="<?= url('cursos') ?>" class="btn btn-nav-custom me-2">
                <i class="fa-solid fa-book-open me-1"></i> Cursos
            </a>
            <a href="<?= url('estudiantes') ?>" class="btn btn-nav-custom me-3">
                <i class="fa-solid fa-user-graduate me-1"></i> Estudiantes
            </a>
            <span class="user-badge me-3 d-flex align-items-center">
                <i class="fa-solid fa-circle-user me-1"></i>
                <?= h($_SESSION['usuario_nombre'] ?? '') ?>
            </span>
            <a href="<?= url('auth', 'salir') ?>" class="btn btn-exit-custom">
                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Salir
            </a>
        </div>
    </div>
</nav>

<main class="container pb-5">

<?php if (!empty($_SESSION['mensaje'])): ?>
    <?php 
        // Se valida el tipo de mensaje de forma segura
        $tipo = ($_SESSION['mensaje_tipo'] ?? 'success') === 'error' ? 'danger' : 'success';
    ?>
    <div class="alert alert-<?= $tipo ?> alert-dismissible fade show mb-4 d-flex align-items-center" role="alert">
        <i class="fa-solid <?= $tipo === 'danger' ? 'fa-triangle-exclamation' : 'fa-circle-check' ?> me-2"></i>
        <div><?= h($_SESSION['mensaje']) ?></div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['mensaje'], $_SESSION['mensaje_tipo']); ?>
<?php endif; ?>