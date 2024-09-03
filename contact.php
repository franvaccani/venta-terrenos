<?php
/**
 * @version 1.0
 */

require("formulario/class.phpmailer.php");
require("formulario/class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["name"]) || !isset($_POST["mail"]) || !isset($_POST["message"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}
$nombre = $_POST["name"];
$email = $_POST["mail"];
$mensaje = $_POST["message"];



// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "terrenos-fernandezoro.netlify.app";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "franciscovaccani08@gmail.com";  // Mi cuenta de correo
$smtpClave = "franDorrego11";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "franciscovaccani08@gmail.com";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";


// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario


$mail->WordWrap = 50; 
$mail->IsHTML(true);     
$mail->Subject  =  "Enviado desde CoreFusion"; // Asunto del mensaje.
$mail->Body     =  "Nombre: $nombre \n<br />". // Nombre del usuario
"Email: $email \n<br />"    // Email del usuario
"Mensaje: $mensaje \n<br />"; // Mensaje del usuario
// FIN - VALORES A MODIFICAR //

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    header('location:sienviado.html');
} else {
    echo "Ocurrió un error inesperado.";
}