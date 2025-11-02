

<?php
session_start();

if (!isset($_SESSION['recuperar_usuario'])) {
    header('Location: solicitar_codigo.php');
    exit();
}

$success = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
unset($_SESSION['success_message']);

$error = isset($_SESSION['codigo_error']) ? $_SESSION['codigo_error'] : '';
unset($_SESSION['codigo_error']);
?>


<!doctype html>
<html lang="en">
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
                            <h4 class="card-title">Verificación</h4>
                            <?php if ($success): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo htmlspecialchars($success); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($error): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo htmlspecialchars($error); ?>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="../php_correo/verificar_codigo1.php">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" id="txtfrm">Te enviamos un código de Verificación a tu correo</label>
                                     <input type="text" class="form-control text-center" id="codigo" name="codigo" 
                                           maxlength="6" required autofocus >
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">Ingresa el código de 6 dígitos que te enviamos</div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="btnlogin">Verificar</button>
                            </form>
                            <br>
                            <a href="../html/login_inicio.php" id="ref_link">Volver al inicio de sesión</a>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>