<?php
session_start();
$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']); 
?>
<!doctype html>
<html lang="es">
<head>
    <title>Inicio de sesión</title>
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
                            <h4 class="card-title">Inicio de sesión</h4>
                            
                            <!-- Mostrar error -->
                            <?php if ($error): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo htmlspecialchars($error); ?>
                                </div>
                            <?php endif; ?>
                            
                           
                            <form method="POST" action="../php/login.php">
                                <div class="mb-3">
                                    <label for="usuario" class="form-label" id="txtfrm">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                                    <div id="emailHelp" class="form-text">Ingresa tu nombre de usuario</div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label" id="txtfrm">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div id="emailHelp" class="form-text">Ingresa tu contraseña de usuario</div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary" id="btnlogin">Iniciar Sesión</button>
                            </form>
                            <br>
                            <a href="../html/solicitar_codigo.php" id="ref_link">¿Olvidaste la contraseña?</a>
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