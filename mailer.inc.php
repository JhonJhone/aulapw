<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exeption;

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = '';
$mail->SMTPAuth = true;
$mail->Username = 'juavitor1@gmail.com';
//troxão
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port = 465;