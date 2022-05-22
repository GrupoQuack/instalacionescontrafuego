<?php
//$correos='jramirez@geoygeo.com.mx,amedina@geoygeo.com.mx,info@geoygeo.com.mx,noelbasurto9@gmail.com,basurtoomar@gmail.com';
$correos='ventassuministros709@gmail.com,instalacioneswest1@gmail.com,noelbasurto9@gmail.com,basurtoomar@gmail.com';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$tel = $_POST['telefono'];
$mensaje = $_POST['comentarios'];
$thank="/gracias.html";

$ip = $_SERVER['REMOTE_ADDR'];   // Obtiene la IP del servidor
$capcha = $_POST['g-recaptcha-response'];   
$secret_key = "6Le1ldgfAAAAAPk4K5RUKOPzlz9HEC9wmWTyjz37";  //secret key de captcha
//llamada API armada
$respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$capcha&remoteip=$ip");
$atributos = json_decode($respuesta,true);


if(is_null($nombre) || $nombre == ""){
	echo "El parametro nombre va vacio" ;
}elseif(is_null($tel) || $tel == ""){
	echo "El parametro telefono va vacio" ;
}elseif (is_null($correo) || $correo == "") {
	echo "El parametro correo va vacio";
}elseif(is_null($mensaje) || $mensaje == "") {
	echo "El parametro mensaje va vacio";
}elseif(!$atributos['success']){
	echo "Verificar Capcha ";	
}
else
{
	$message = '
	<html> 
	<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	   <title>Instalaciones contra fuego</title> 
	<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700" rel="stylesheet" type="text/css">
	   <style>
	   .tex
	   {
	font-family: "Open Sans Condensed", sans-serif;
	color:#4A4646;
	   }
	   </style>
	</head> 
	<body> 
	<p align="center"><img src="http://instalacionescontrafuego.com/img/logo.png" ></p> 
	<h1 style="color:#4A4646;" class="tex">Instalaciones contra fuego</h1> 
	<p> 
	<b style="color:#4A4646;" class="tex">Buen dia tienes un correo electrónico de instalacionescontrafuego.com</b>. </p>
	<p style="color:#4A4646;" class="tex">Los Datos del Contacto Aparecen en seguida contactalo.. </p>
	<table width="200"  align="center" class="tex" >	 
	  <tr>
	    <td>Nombre:</td>
	    <td>'.$nombre.'</td>
	  </tr>
	  <tr>
	    <td>Correo:</td>
	    <td>'.$correo.'</td>
	  </tr>
	   <tr>
	    <td>Telefono:</td>
	    <td>'.$tel.'</td>
	  </tr>	  
	  <tr>
	    <td valign="top">Mensaje:</td>
	    <td>'.$mensaje.'</td>
	  </tr>
	</table>
	<p style="color:#4A4646;" class="tex">Saludos estamos a tus Ordenes para cualquier aclaración o duda.</p>
	<hr>

	<p align="center" class="tex">Información enviada a travez de <a href="http://www.grupoquack.com.mx" target="_blank">Grupo Quack Design and System</a></p> 
	</body> 
	</html>  
	';

	//para el envío en formato HTML 
	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

	//dirección del remitente 
	$headers .= "From: Instalacionescontrafuego  <info@instalacionescontrafuego.com> \r\n"; 

	mail($correos,'Contacto de Pagina Web',$message, $headers);

	Header ("Location: $thank"); 
}
?> 