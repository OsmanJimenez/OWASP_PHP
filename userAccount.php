<?php
//start session
session_start();
//load and initialize user class
include 'user.php';
include 'Admin/log.php';
$user = new User();
$log  = new Log();
if(isset($_POST['signupSubmit'])){
	//check whether user details are empty
    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
		//password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirme que la contraseña debe coincidir con la contraseña.'; 
        }else{
			//check whether user exists in the database
            $prevCon['where'] = array('email'=>$_POST['email']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows($prevCon);
            if($prevUser > 0){
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'El correo electrónico ya existe, utilice otro correo electrónico.';
            }else{
				//insert user data in the database
                $userData = array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'password' => md5($_POST['password']),
                    'phone' => $_POST['phone']
                );
                $insert = $user->insert($userData);
				//set status based on data insert
                if($insert){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Te has registrado correctamente, inicia sesión con tus credenciales.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Se produjo algún problema, por favor intente nuevamente.';
                }
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Todos los campos son obligatorios, complete todos los campos.'; 
    }
	//store signup status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'registration.php';
	//redirect to the home/registration page
    header("Location:".$redirectURL);
}elseif(isset($_POST['loginSubmit'])){
	//check whether login details are empty
    if(!empty($_POST['email']) && !empty($_POST['password'])){
		//get user data from user class
        $conditions['where'] = array(
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'status' => '1'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
		//set user data and status based on login credentials
        if($userData){
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $userData['id'];
            $sessData['permits']=$userData['permits'];
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Bienvenid@ '.$userData['first_name'].'!';
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Correo electrónico o contraseña incorrectos, intente nuevamente.'; 
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Ingrese correo electrónico y contraseña.'; 
    }
	//store login status into the session
    $_SESSION['sessData'] = $sessData;
	//redirect to the home page
    header("Location:Admin/index.php");
}elseif(isset($_POST['forgotSubmit'])){
	//check whether email is empty
    if(!empty($_POST['email'])){
		//check whether user exists in the database
		$prevCon['where'] = array('email'=>$_POST['email']);
		$prevCon['return_type'] = 'count';
		$prevUser = $user->getRows($prevCon);
		if($prevUser > 0){
			//generat unique string
			$uniqidStr = md5(uniqid(mt_rand()));;
			
			//update data with forgot pass code
			$conditions = array(
				'email' => $_POST['email']
			);
			$data = array(
				'forgot_pass_identity' => $uniqidStr
			);
			$update = $user->update($data, $conditions);
			
			if($update){
				$resetPassLink = 'http://localhost/OWASP_PHP/resetPassword.php?fp_code='.$uniqidStr;
				
				//get user details
				$con['where'] = array('email'=>$_POST['email']);
				$con['return_type'] = 'single';
				$userDetails = $user->getRows($con);
				
				//send reset password email
				$to = $userDetails['email'];
				$subject = "Solicitud de Cambio de Contraseña";
				$mailContent = 'Estimad@ '.$userDetails['first_name'].', 
				<br/><br/>Recientemente se envió una solicitud para restablecer una contraseña para su cuenta. Si esto fue un error, simplemente ignore este correo electrónico y no pasará nada.
				<br/>Para restablecer su contraseña, visite el siguiente enlace: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a>
				<br/><br/>Saludos,
                <br/>No considere este mensaje como spam, atentamente 
                <br/>Osman Jimenez';                ;
                
				//set content-type header for sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				//additional headers
				$headers .= 'From: Atomix<sender@example.com>' . "\r\n";
				//send email
				mail($to,$subject,$mailContent,$headers);
				
				$sessData['status']['type'] = 'success';
				$sessData['status']['msg'] = 'Verifique su correo electrónico, hemos enviado un enlace para restablecer la contraseña a su correo electrónico registrado.';
			}else{
				$sessData['status']['type'] = 'error';
				$sessData['status']['msg'] = 'Se produjo algún problema, por favor intente nuevamente.';
			}
		}else{
			$sessData['status']['type'] = 'error';
			$sessData['status']['msg'] = 'El correo electrónico dado no está asociado con ninguna cuenta.'; 
		}
		
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Ingrese el correo electrónico para crear una nueva contraseña para su cuenta.'; 
    }
	//store reset password status into the session
    $_SESSION['sessData'] = $sessData;
	//redirect to the forgot pasword page
    header("Location:forgotPassword.php");
}elseif (isset($_POST['perSubmit'])) {
    include 'Admin/forum.php';
    $deco=new Forum();
    $atc=substr("".$_POST['atc'], 4, -4);
    $conditions = array(
                'id' => $deco->decode($atc)
            );
    $data= array(
                'permits' => $_POST['ptc']
            );
    
    $update = $user->update($data, $conditions);

    if($update){
        $nu=$deco->decode('$atc');
        $descr='Se han actualizado los permisos del usuario';
                    $data=array(
                        'des'=> $descr,
                        'user'=>$_SESSION['sessData']['userID']
                    );
                    $add=$log->insert($data);
                    if ($add) {

      header("Location:Admin/config.php");
  }
    }
}elseif (isset($_POST['pefSubmit'])) {
    include 'Admin/forum.php';
    $conditions = array(
                'id' => $_SESSION['sessData']['userID']
            );
    $data= array(
                'first_name'  => $_POST['name'],
                'last_name'   => $_POST['ape'],
                'email'       => $_POST['email'],
                'phone'       => $_POST['phone']  
            );
    
    $update = $user->update($data, $conditions);

    if($update){
        $descr='Se ha actualizado el perfil de usuario';
                    $data=array(
                        'des'=> $descr,
                        'user'=>$_SESSION['sessData']['userID']
                    );
                    $add=$log->insert($data);
                    var_dump($add);
                    if ($add) {

      header("Location:Admin/perfil.php");
  }
    }
}elseif (isset($_POST['passSubmit'])) {
    include 'Admin/forum.php';

    if($_POST['nivel']!='bajo'){


    $conditions['where'] = array(
                'id' => $_SESSION['sessData']['userID'],
                'password' =>  md5($_POST['pass1'])
            );
    $consult=$user->getRows($conditions);
    if($consult){
            $conditions2 = array(
                'id' => $_SESSION['sessData']['userID']
            );
    $data2= array(
                'password'  => md5($_POST['pass2'])  
            );
    
    $update = $user->update($data2, $conditions2);
 
        if($update){
        $descr='Se ha actualizado la contraseña';
                    $data=array(
                        'des'=> $descr,
                        'user'=>$_SESSION['sessData']['userID']
                    );
                    $add=$log->insert($data);
                    if ($add) {
        //send reset password email
                $to = $consult['0']['email'];
                $subject = "Cambio de Contraseña";
                $mailContent = 'Estimad@ '.$consult['0']['first_name'].', 
                <br/><br/>Recientemente se restablecio la contraseña de su cuenta. Si no fue usted, por favor cambiar su contraseña para no perder el acceso a su cuenta.
                <br/><br/>Saludos,
                <br/>No considere este mensaje como spam, atentamente 
                <br/>Osman Jimenez';                ;
                
                //set content-type header for sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                //additional headers
                $headers .= 'From: Atomix<sender@example.com>' . "\r\n";
                //send email
                mail($to,$subject,$mailContent,$headers);
     header("Location:Admin/perfil.php");
  }
    

    }}

}

} elseif (isset($_GET['dtc'])) {
    include 'Admin/forum.php';
    $deco=new Forum();
    $dtc=substr("".$_GET['dtc'], 4, -4);
    $conditions = array(
                'id' => $deco->decode($dtc)
            );
    $delete=$user->delete($conditions);
     if($delete){
      header("Location:Admin/config.php");
    }else{
        header("Location:Admin/");
    }
}elseif(isset($_POST['resetSubmit'])){
	$fp_code = '';
	if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])){
		$fp_code = $_POST['fp_code'];
		//password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirme que la contraseña debe coincidir con la contraseña.'; 
        }else{
			//check whether identity code exists in the database
            $prevCon['where'] = array('forgot_pass_identity' => $fp_code);
            $prevCon['return_type'] = 'single';
            $prevUser = $user->getRows($prevCon);
            if(!empty($prevUser)){
				//update data with new password
				$conditions = array(
					'forgot_pass_identity' => $fp_code
				);
				$data = array(
					'password' => md5($_POST['password'])
				);
				$update = $user->update($data, $conditions);
				if($update){
					$sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'La contraseña de su cuenta se ha restablecido correctamente. Inicia sesión con tu nueva contraseña.';
                    $descr='Se ha cambiado recientemente la contraseña ';
                    $logdata=array(
                        'des'=> $descr,
                        'user'=>$prevUser['id'],
                    );
                    $add=$log->insert($logdata);
				}else{
					$sessData['status']['type'] = 'error';
					$sessData['status']['msg'] = 'Se produjo algún problema, por favor intente nuevamente.';
				}
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'No tiene autorización para restablecer la nueva contraseña de esta cuenta.';
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Todos los campos son obligatorios, complete todos los campos.'; 
    }
	//store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'resetPassword.php?fp_code='.$fp_code;
	//redirect to the login/reset pasword page
    header("Location:".$redirectURL);
}elseif(!empty($_REQUEST['logoutSubmit'])){
	//remove session data
    unset($_SESSION['sessData']);
    session_destroy();
	//store logout status into the ession
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'Has cerrado la sesión correctamente desde tu cuenta.';
    $_SESSION['sessData'] = $sessData;
	//redirect to the home page
    header("Location:index.php");
}else{
	//redirect to the home page
    header("Location:index.php");
}