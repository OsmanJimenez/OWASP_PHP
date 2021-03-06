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
    <title>Registrate</title>
    <!-- CSS Normalize -->
    <link rel="stylesheet" href="css/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- CSS Propios -->
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="row justify-content-center align-items-center full">
        <div class="col-sm registro">
            <img class="" src="img/register_fondo.jpg" alt="">
        </div>
        <div class="col-sm">
            <div class="contenedor">
            <form action="userAccount.php" method="post" >
                    <div class="container" id="formulario">
                        <div class="row">
                            <div class="col">
                                <!-- Grupo: Nombre -->
                                <div class="formulario__grupo" id="grupo__first_name">
                                    <label for="first_name" class="formulario__label">Nombre:</label>
                                    <div class="formulario__grupo-input">
                                        <input type="text" class="formulario__input" name="first_name" id="first_name"
                                            placeholder="Digite su usuario">
                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                    </div>
                                    <p class="formulario__input-error">El usuario tiene que ser de 8 a 16 dígitos y solo
                                        puede contener numeros, letras y guion bajo.</p>
                                </div>
                            </div>
                            <div class="col">
                                <!-- Grupo: Apellido -->
                                <div class="formulario__grupo" id="grupo__last_name">
                                    <label for="last_name" class="formulario__label">Apellido:</label>
                                    <div class="formulario__grupo-input">
                                        <input type="text" class="formulario__input" name="last_name" id="last_name"
                                            placeholder="Osman Jimenez">
                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                    </div>
                                    <p class="formulario__input-error">El usuario tiene que ser de 8 a 16 caracteres y
                                        solo puede contener numeros, letras y guion bajo.</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <!-- Grupo: Contraseña -->
                                <div class="formulario__grupo" id="grupo__password">
                                    <label for="password" class="formulario__label">Contraseña</label>
                                    <div class="formulario__grupo-input">
                                        <input type="password" class="formulario__input" name="password" maxlength="18"
                                            id="password">

                                        <i class="formulario__validacion-estado fas fa-times-circle">
                                            <span class="fas fa-eye" id="ver" onclick="mostrar()"></span>
                                        </i>
                                    </div>
                                    <p class="formulario__input-error">La contraseña debe tener mas de 12 caracteres.
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

                                    <label for="confirm_password" class="formulario__label">Repetir Contraseña</label>
                                    <div class="formulario__grupo-input">
                                        <input type="password" class="formulario__input" maxlength="18" name="confirm_password"
                                            id="confirm_password">
                                        <i class="formulario__validacion-estado fas fa-times-circle">
                                            <span class="fas fa-eye" id="ver2" onclick="mostrar2()"></span>
                                        </i>
                                    </div>
                                    <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <!-- Grupo: Correo Electronico -->
                                <div class="formulario__grupo" id="grupo__email">
                                    <label for="correo" class="formulario__label">Correo Electrónico</label>
                                    <div class="formulario__grupo-input">
                                        <input type="email" class="formulario__input" name="email" id="email"
                                            placeholder="correo@correo.com">
                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                    </div>
                                    <p class="formulario__input-error">El correo solo puede contener letras, numeros,
                                        puntos, guiones y guion bajo.</p>
                                </div>
                            </div>
                            <div class="col">
                                <!-- Grupo: Teléfono -->
                                <div class="formulario__grupo" id="grupo__phone">
                                    <label for="telefono" class="formulario__label">Teléfono</label>
                                    <div class="formulario__grupo-input">
                                        <input type="number" class="formulario__input" name="phone" id="phone"
                                            placeholder="3212056161">
                                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                    </div>
                                    <p class="formulario__input-error">El telefono solo puede contener numeros y el
                                        maximo son 14 dígitos.</p>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col">
                                <!-- Grupo: Verificación -->
                                <div class="formulario__grupo formulario__grupo-btn-enviar" id="grupo__terminos">
                                    <label class="formulario__label">
                                        <fieldset>
                                            <span id="SuccessMessage" class="success">Has ingresado exitosamente al
                                                captcha.</span>
                                            <input type="text" id="UserCaptchaCode" class="CaptchaTxtField"
                                                placeholder='Ingrese Captcha - Sensible a mayúsculas'>
                                            <span id="WrongCaptchaError" class="error"></span>
                                            <div class='CaptchaWrap'>
                                                <div id="CaptchaImageCode" class="CaptchaTxtField">
                                                    <canvas id="CapCode" class="capcode" width="300"
                                                        height="80"></canvas>
                                                </div>
                                                <input type="button" class="ReloadBtn" onclick='CreateCaptcha();'>
                                            </div>
                                        </fieldset>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col">
                                <!-- Grupo: Terminos y Condiciones -->
                                <div class="formulario__grupo formulario__grupo-btn-enviar" id="grupo__terminos">
                                    <label class="formulario__label">
                                        <input class="formulario__checkbox" type="checkbox" name="terminos"
                                            id="terminos">
                                        Acepta los Terminos y Condiciones
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col">
                                <div class="formulario__mensaje" id="formulario__mensaje">
                                    <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el
                                        formulario correctamente. </p>
                                </div>

                                <div class="formulario__grupo formulario__grupo-btn-enviar">
                                     <input type="button" class="formulario__btn" value="comprobar" onclick="CheckCaptcha();">
                                    <button type="submit" disabled class="formulario__btn" id="subir" name="signupSubmit"
                                        onclick="CheckCaptcha();">Enviar</button>
                                    <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario
                                        enviado exitosamente!</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
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
    <!-- Captcha -->
    <script src='js/captcha.js'></script>
    <!-- Control de contraseñas -->
    <script src='js/visualizar.js'></script>
    <!-- Medidor -->
    <script src='js/medidor.js'></script>

</body>

</html>