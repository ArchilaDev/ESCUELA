<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAME-LANGUAGE | Iniciar Sesión</title>
    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- Google Fonts & FontAwesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top left, #1e1b4b, #0f172a, #090d16);
            min-height: 100vh;
            color: #f8fafc;
        }

        .login-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.25rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .brand-title {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .form-label {
            color: #94a3b8;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
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

        .btn-custom {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.85rem;
            border-radius: 0.75rem;
            transition: all 0.25 ease;
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

        .alert-custom {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 0.75rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="d-flex align-items-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-8 col-md-5 col-lg-4">
                <div class="card login-card p-2 p-sm-3">
                    <div class="card-body p-3 p-sm-4">
                        <!-- Encabezado / Logo -->
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-indigo-500-10 rounded-circle mb-2" style="width: 50px; height: 50px; background: rgba(99, 102, 241, 0.15);">
                                <i class="fa-solid fa-code text-indigo-400 fs-4" style="color: #818cf8;"></i>
                            </div>
                            <h1 class="h3 brand-title mb-1">GAME-LANGUAGE</h1>
                            <p class="text-secondary small mb-0">Escuela de Programación <i class="fa-solid fa-graduation-cap ms-1"></i></p>
                        </div>

                        <!-- Alerta PHP (Respetada sin alterar la lógica) -->
                        <?php if(!empty($error)): ?>
                            <div class="alert alert-custom alert-danger py-2 mb-4 d-flex align-items-center" role="alert">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                <div><?= h($error) ?></div>
                            </div>
                        <?php endif; ?>

                        <!-- Formulario PHP (Respetado exactamente con las mismas action, method, name, required, autofocus) -->
                        <form action="<?= url('auth', 'ingresar') ?>" method="post">
                            <div class="mb-3">
                                <label for="txtUsuario" class="form-label">Usuario</label>
                                <div class="input-group-custom">
                                    <input type="text" name="txtUsuario" id="txtUsuario" class="form-control form-control-custom" required="required" autofocus="autofocus" placeholder="Ingresa tu usuario">
                                    <i class="fa-regular fa-user input-icon"></i>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="txtClave" class="form-label">Contraseña</label>
                                <div class="input-group-custom">
                                    <input type="password" name="txtClave" id="txtClave" class="form-control form-control-custom" required="required" placeholder="••••••••">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-custom w-100">
                                Ingresar <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>