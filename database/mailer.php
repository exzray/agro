<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../phpmailer/PHPMailer.php';
require '../phpmailer/Exception.php';
require '../phpmailer/SMTP.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->Subject = 'Enquire';
$mail->isHTML();
$mail->Username = 'nabila.developer@gmail.com';
$mail->Password = '0123456789Aa';
try {
    $mail->setFrom('nabila.developer@gmail.com');
} catch (Exception $e) {
    echo $e->errorMessage();
}

