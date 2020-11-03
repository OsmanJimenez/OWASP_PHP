<?php
require ("conexion.php");
$user=$_POST['usuario'];		
$name=$_POST['nombre'];	
$password=$_POST['password'];	
$email=$_POST['correo'];	
$phone=$_POST['telefono'];
$password = password_hash(
                    base64_encode(
                        hash('sha256', $password, true)
                    ),
                PASSWORD_DEFAULT
            );
try {
$query=$pdo->prepare("Insert into usuario (user,name,pass,email,phone)values(?,?,?,?,?)");
$query->bindParam(1,$user);
$query->bindParam(2,$name);
$query->bindParam(3,$password);
$query->bindParam(4,$email);
$query->bindParam(5,$phone);
$result=$query->execute();

if($result){
echo "Bienvenido por ahora";
}else{
echo "algo anda mal";	
}




  
} catch (Exception $e) {
 
  
}
?>