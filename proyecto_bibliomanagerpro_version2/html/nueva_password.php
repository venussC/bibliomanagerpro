<?php
session_start();

if (!isset($_SESSION['cambiar_password_usuario'])) {
    header('Location: solicitar_codigo.php');
    exit();
}

$error = isset($_SESSION['password_error']) ? $_SESSION['password_error'] : '';
unset($_SESSION['password_error']);
?>
<!doctype html>
<html lang="es">
<head>
    <title>Nueva Contraseña</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/design.css">
</head>

<body>
    <main>
        <div class="container-fluid h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card-body" id="card3">
                        <!-- Sección del formulario -->
                        <div class="form-section">
                            <h4 class="card-title">Nueva Contraseña</h4>
                            
                            <?php if ($error): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo htmlspecialchars($error); ?>
                                </div>
                            <?php endif; ?>
                            
                            <p class="text-muted mb-4">Ingresa tu nueva contraseña</p>
                            
                            <form method="POST" action="../php/cambiar_password.php">
                                <div class="mb-3">
                                    <label for="nueva_password" class="form-label" id="txtfrm">Nueva Contraseña</label>
                                    <input type="password" class="form-control" id="nueva_password" name="nueva_password" required>
                                    <div class="form-text">Mínimo 6 caracteres</div>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmar_password" class="form-label" id="txtfrm">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" required>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary" id="btnlogin">Cambiar Contraseña</button>
                            </form>
                        </div>

                        <!-- Sección del logo -->
                        <div id="logo_section">
                            <img src="../css/Logobibliomanagerpro.png" alt="BiblioManager Logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>