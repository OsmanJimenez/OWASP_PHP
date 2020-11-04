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
<html>
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
	<div class="container">
        <?php
			if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
				include 'user.php';
				$user = new User();
				$conditions['where'] = array(
					'id' => $sessData['userID'],
				);
				$conditions['return_type'] = 'single';
				$userData = $user->getRows($conditions);
		?>
        <h2>Bienvenid@ <?php echo $userData['first_name']; ?>!</h2>
        <a href="userAccount.php?logoutSubmit=1" class="logout">Cerrar Sesión</a>
		<div class="regisFrm">
			<p><b>Nombre: </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
            <p><b>Correo: </b><?php echo $userData['email']; ?></p>
            <p><b>Teléfono: </b><?php echo $userData['phone']; ?></p>
		</div>
	</div>
        <?php }else{ ?>


			<div class="row justify-content-center align-items-center full">
        <div class="col-sm registro">
            <img class="" src="img/register_fondo.jpg" alt="">
        </div>
        <div class="col-sm">
            <div class="contenedor">
                <div class="container"></div>
		<form action="userAccount.php" method="post">

                    <div class="row">
                        <div class="col">
                            <!-- Grupo: Usuario -->
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
                            <!-- Grupo: Contraseña -->
                            <div class="formulario__grupo" id="grupo__password">
                                <label for="password" class="formulario__label">Contraseña</label>
                                <div class="formulario__grupo-input">
                                    <input type="password" class="formulario__input" name="password" id="password"
                                        required>
                                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                </div>
                                <p class="formulario__input-error">La contraseña debe tener mas de 12 caracteres.
                                </p>
                            </div>
                            <a href="forgotPassword.php" style="text-decoration: none;">
                                <p class="text-right recuperar">¿Olvidaste tu contraseña?</p>
                            </a>
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
                                                <canvas id="CapCode" class="capcode" width="300" height="80"></canvas>
                                            </div>
                                            <input type="button" class="ReloadBtn" onclick='CreateCaptcha();'>
                                        </div>
                                    </fieldset>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="formulario__mensaje" id="formulario__mensaje">
                            <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el
                                formulario correctamente. </p>
                        </div>

                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                            <input type="button" class="formulario__btn" value="comprobar" onclick="CheckCaptcha();">

                        </div>

                        <button type="submit" class="btn btn-primary" id="subir" onclick=""
                            style="margin: 20px;" name="loginSubmit">Iniciar
                            Sesión</button>
                        <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado
                            exitosamente!</p>
                        <p class="text-center">No tienes una cuenta aun.</p>
                    </div>
                </form>
                <div class="row justify-content-md-center">

                    <a href="registration.php" class="text-center">
                        <button class="btn btn-success">Crea una Cuenta</button>
                    </a>

                </div>

            </div>
        </div>
    </div>

		
        <?php } ?>
	

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