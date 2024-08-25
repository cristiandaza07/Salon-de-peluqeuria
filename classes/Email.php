<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email, $token, $nombre;

    public function __construct($email, $token, $nombre)
    {
        $this->email=$email;
        $this->token=$token;
        $this->nombre=$nombre;
    }

    public function enviarConfirmacion(){
        //Crear el objeto de email 
        $mail = new PHPMailer();
        $mail-> isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '564b877b08897f';
        $mail->Password = '10009a16acd58e';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu correo';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola ". $this->nombre . "</strong>, Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=". $this->token ."'>Confirmar cuenta</a></p>";
        $contenido .= "<p>SI no solicitaste esta cuenta ignora el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body= $contenido;

        //Enviar mail
        $mail->send();
    }
}