<?php

$to = "recepcion@creditmas.com.mx"; //recepcion@creditmas.com.mx
$subject = ($_POST["type"] == "message") ? "Mensaje enviado desde el Website" : "Solicitud de Saldo";

if ($_POST["type"] == "saldo") {
    $message = "
    <html>
    <head>
    <title>Mensaje desde el Sitio Web</title>
    </head>
    <body>
    <p>Una persona ha enviado sus datos para solicitar su saldo.</p>
    <table border='1'>
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
    $message = "
    <html>
    <head>
    <title>Solicitud de Saldo</title>
    </head>
    <body>
    <p>Una persona ha enviado sus datos para obtener más información.</p>
    <table border='1'>
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

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <'.$_POST["email"].'>' . "\r\n";

mail($to,$subject,$message,$headers);

header("location:index.php");
?>