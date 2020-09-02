<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.04 - Utilizando um componente");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ instance ] https://packagist.org/packages/phpmailer/phpmailer
 */
fullStackPHPClassSession("instance", __LINE__);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

$phpMailer = new PHPMailer();

var_dump($phpMailer instanceof PHPMailer);

/*
 * [ configure ]
 */
fullStackPHPClassSession("configure", __LINE__);

try {
    $mail = new PHPMailer(true);

    //CONFIG
    $mail->isSMTP();
    $mail->setLanguage("br");
    $mail->isHTML(true);
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->CharSet = 'utf-8';

    //AUTH
    $mail->Host = "smtp.sendgrid.net";
    $mail->Username = "apikey";
    $mail->Password = "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";
    $mail->Port = "587";

    //MAIL
    $mail->setFrom("developerfsphp@gmail.com", "Pedro Leandro");
    $mail->Subject = "Esse é meu envio de e-mail utilizando componente no FSPHP";
    $mail->msgHTML("<h1>Olá, Mundo! Realizando disparo de e-mail!!!</h1>");

    //SEND
    $mail->addAddress("pedro.leandrog@gmail.com", "Pedro Leandro");
    $send = $mail->send();

    var_dump($send);
} catch (MailException $exception) {
//    var_dump($exception);
    echo message()->error($exception->getMessage());
}