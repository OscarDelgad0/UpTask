<?php

    namespace Clases;

    use PHPMailer\PHPMailer\PHPMailer;

    class Email {

        protected static $email;
        protected static $nombre;
        protected static $token;

        public function __construct($email, $nombre, $token){
            $this->email = $email;
            $this->nombre = $nombre;
            $this->token = $token;
        }

        public function enviarConfirmacion(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'b8f983dc51afc3';
            $mail->Password = 'ab3d432e7b4a40';

            $mail->setFrom('cuentas@uptask.com');
            $mail->addAddress('cuentas@uptask.com', 'uptask.com');
            $mail->Subject = 'Confirma tu cuenta';
            $mail->isHTML(TRUE);
            $mail->CharSeT= 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p><strong> Hola: ". $this->nombre ."</strong> Has creado tu cuenta
            en L'oress, solo debes confirmar en el siguiente enlace</p>";
            $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar?token="  . $this->token .  "'>Confirmar cuenta</a> </p>";
            $contenido .=  "<p>Si tu no creaste esta cuenta, ignora este mensaje</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;

            // Enviar email 
            $mail->send();
        }

        public function enviarInstrucciones(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'b8f983dc51afc3';
            $mail->Password = 'ab3d432e7b4a40';

            $mail->setFrom('cuentas@uptask.com');
            $mail->addAddress('cuentas@uptask.com', 'uptask.com');
            $mail->Subject = 'Restablece tu password';
            $mail->isHTML(TRUE);
            $mail->CharSeT= 'UTF-8';

            $contenido = "<html>";
            $contenido .= "<p><strong> Hola: ". $this->nombre ."</strong> Has olvidado tu password
            sigue las siguientes instrucciones:</p>";
            $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/restablecer?token=" 
            . $this->token .  "'>Restablece tu password</a> </p>";
            $contenido .=  "<p>Si tu no creaste esta cuenta, ignora este mensaje</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;

            // Enviar email 
            $mail->send();
        }
    }