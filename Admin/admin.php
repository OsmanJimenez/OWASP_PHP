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
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- CSS Normalize -->
    <link rel="stylesheet" href="css/normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- CSS Propios -->
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
        include '../user.php';
        $user = new User();
        $conditions['where'] = array(
            'id' => $sessData['userID'],
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
?>
    <h2>Bienvenid@ <?php echo $userData['first_name']; ?>!</h2>
    <a href="../userAccount.php?logoutSubmit=1" class="logout">Cerrar Sesión</a>
    <div class="regisFrm">
        <p><b>Nombre: </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
        <p><b>Correo: </b><?php echo $userData['email']; ?></p>
        <p><b>Teléfono: </b><?php echo $userData['phone']; ?></p>
    </div>
    </div>
</body>
</html>