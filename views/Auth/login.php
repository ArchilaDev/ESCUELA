<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body class="bg-dark d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-8 col-md-5 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h1 class="h4 text-center mb-1">🎓Sistema</h1>
                        <p class="text-center text-muted mb-4">Gestión Académica</p>
                        <?php if(!empty($error)): ?>
                            <div class="alert alert-danger py-2"><?= h($error) ?></div>
                        <?php endif; ?>

                        <form action="<?= url('auth', 'ingresar') ?>" method="post">
                            <div class="mb-3">
                                <label for="" class="form-label">Usuario</label>
                                <input type="text" name="txtUsuario" id="" class="form-control" required="required" autofocus="autofocus">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Contraseña</label>
                                <input type="password" name="txtClave" id="" class="form-control" required="required" autofocus="autofocus">
                            </div>
                            <input type="submit" value="Ingresar" class="btn btn-primary w-100">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>