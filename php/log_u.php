<?php 
require ("conexion.php");
$user=$_POST['usuario'];
$password=$_POST['password'];
$query=$pdo->prepare("Select pass,user from usuario where user=?");
$query->bindParam(1,$user);
$result=$query->execute();


if($result){

			$fila = $query->fetch(PDO::FETCH_OBJ);		
				$stored = $fila->pass;
				$userl = $fila->user; 
				
		}else{
			echo "Compruebe sus credenciales";
		}			

if (password_verify(base64_encode(hash('sha256', $password, true)),$stored) and $user==$userl) {
   echo "todo bien";
} else {
    echo "no es";
}
?>