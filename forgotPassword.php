<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- CSS Normalize -->
    <link rel="stylesheet" href="css/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- CSS Propios -->
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="row justify-content-md-center">
        <div class="col">
            <div class="contenedor" style="max-width:50%; margin-left:25%; ">
                <div class="container">
                <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'" style="display:inline">'.$statusMsg.'</p>':''; ?>
                    <form action="userAccount.php" method="post">

                        <div class="row" id="formulario" name="formulario">
                            <div class="row justify-content-md-center">
                                <div class="col">
                                    <div class="formulario__grupo" id="grupo__email">
                                        <label for="correo" class="formulario__label">Correo Electrónico</label>
                                        <div class="formulario__grupo-input">
                                            <input type="email" class="formulario__input" name="email" id="email"
                                                placeholder="correo@correo.com" required>
                                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                        </div>
                                        <p class="formulario__input-error">El correo solo puede contener letras,
                                            numeros,
                                            puntos, guiones y guion bajo.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <button type="submit" class="btn btn-primary" onclick="" style="margin: 20px;"
                                    name="forgotSubmit">Recuperar Contraseña</button>
                                <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado
                                    exitosamente!</p>
                                <p class="text-center">No tienes una cuenta aun.</p>
                            </div>
                    </form>
                    <div class="row justify-content-md-center">
                            <button href="registration.php" class="btn btn-success">
							<a href="registration.php" class="text-center" style="text-decoration: none; color:#fff;">
							Crea una Cuenta </a>
							</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- JS Propios -->
    <script src="js/script.js"></script>
    <!-- JS Font Awesome -->
    <script src="js/fontawesome.min.js" crossorigin="anonymous"></script>
    <!-- JS Bootrstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- JQuery -->
    <script src='js/jquery.min.js'></script>
    <!-- Control de contraseñas -->
    <script src='js/visualizar.js'></script>
    <!-- Medidor -->
    <script src='js/medidor.js'></script>

</body>

</html>