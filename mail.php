<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require 'vendor/phpmailer/Exception.php';
require 'vendor/phpmailer/PHPMailer.php';
require 'vendor/phpmailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $subject = ($_POST["type"] == "message") ? "Mensaje enviado desde el Website" : "Solicitud de Saldo";
    if ($_POST["type"] == "balance") {
    	$body = "
    	<html>
    	<head>
    	<title>Mensaje desde el Sitio Web</title>
    	</head>
    	<body>
    	<p>Una persona ha enviado sus datos para obtener más información.</p>
    	<table>
    	<tr>
    	<th>RFC</th>
    	<th>Correo electrónico</th>
    	</tr>
    	<tr>
    	<td>".$_POST["rfc"]."</td>
    	<td>".$_POST["email"]."</td>
    	</tr>
    	</table>
    	</body>
    	</html>
    	";
    } else {
    	$body = "
    	<html>
    	<head>
    	<title>Solicitud de Saldo</title>
    	</head>
    	<body>
    	<p>Una persona ha enviado sus datos para obtener más información.</p>
    	<table>
    	<tr>
    	<th>Nombre</th>
    	<th>Teléfono</th>
    	<th>Correo electrónico</th>
    	</tr>
    	<tr>
    	<td>".$_POST["name"]."</td>
    	<td>".$_POST["phone"]."</td>
    	<td>".$_POST["email"]."</td>
    	</tr>
    	</table>
    	</body>
    	</html>
    	";
    }
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'av.centro4@gmail.com';
    $mail->Password   = 'sistemas';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 465;
    $mail->setFrom($_POST["email"], ($_POST["name"]) ? $_POST["name"] : 'Cliente');
    $mail->addAddress('av.centro4@gmail.com', 'Credit Mas');
    $mail->isHTML(true);
    $mail->Subject = "asunto";
    $mail->Body    = "prueba";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
// echo "Hola";
?>