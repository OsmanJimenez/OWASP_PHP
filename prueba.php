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
                            <div class="justify-content-md-center">

                                <div class="row">
                                    <div class="col">
                                        <!-- Grupo: Contraseña -->
                                        <div class="formulario__grupo" id="grupo__password">
                                            <label for="password" class="formulario__label">Contraseña</label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="formulario__input" name="password"
                                                    maxlength="18" id="password">

                                                <i class="formulario__validacion-estado fas fa-times-circle">
                                                    <span class="fas fa-eye" id="ver" onclick="mostrar()"></span>
                                                </i>
                                            </div>
                                            <p class="formulario__input-error">La contraseña debe tener mas de 12
                                                caracteres.
                                            </p>
                                            <div class="nivelSeguridad">
                                                <span id="nivelseguridad">bajo</span>
                                                <div class="nivelesColores">
                                                    <div class="spanNivelesColores"></div>
                                                </div>

                                                <div class="NivelesColores"></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Grupo: Contraseña 2 -->
                                        <div class="formulario__grupo" id="grupo__confirm_password">

                                            <label for="confirm_password" class="formulario__label">Repetir
                                                Contraseña</label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="formulario__input" maxlength="18"
                                                    name="confirm_password" id="confirm_password">
                                                <i class="formulario__validacion-estado fas fa-times-circle">
                                                    <span class="fas fa-eye" id="ver2" onclick="mostrar2()"></span>
                                                </i>
                                            </div>
                                            <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <input type="hidden" style="display:none" name="fp_code" value="<?php echo $_REQUEST['fp_code']; ?>"/>
                                <button type="submit" class="btn btn-primary" onclick="" style="margin: 20px;"
                                name="resetSubmit">Restablecer Contraseña</button>
                                <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado
                                    exitosamente!</p>
                            </div>
                    </form>
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