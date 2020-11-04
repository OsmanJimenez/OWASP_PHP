<?php
$para      = 'osman98125@gmail.com';
$asunto    = 'El asunto del correo';
$descripcion   = 'Este es el cuerpo del correo';
$de = 'From: jocker2198@gmail.com';

if (mail($para, $asunto, $descripcion, $de))
   {
echo "Correo enviado satisfactoriamente";
}
?>