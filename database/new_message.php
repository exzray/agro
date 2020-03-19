<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/PHPMailer.php';
require '../phpmailer/Exception.php';
require '../phpmailer/SMTP.php';

require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $statement = $conn->prepare('insert into message (name, email, subject, message, created) values (?, ?, ?, ?, ?);');
    $statement->bind_param('sssss', $name, $email, $subject, $message, $created);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $created = date("Y-m-d");

    $statement->execute();
    $statement->close();

    // send json response to ajax
    header("Content-Type: application/json");

    if ($conn->error) $data = ['message' => $conn->error];
    else {
        $email_error = '';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = 'nabila.developer@gmail.com';
        $mail->Password = '0123456789Aa';
        try {
            $mail->setFrom('no-reply@google.com');
        } catch (Exception $e) {
            $email_error .= '\n' . $e->errorMessage();
        }
        $mail->Subject = 'Enquire';
        $mail->Body = '<p>You receive your enquire copy url <a target="_blank" href="localhost/agro/check_message.php?id=' . mysqli_insert_id($conn) . '">click here</a> to see your reply.</p>';
        try {
            $mail->addAddress('pythorevolution@gmail.com');
        } catch (Exception $e) {
            $email_error .= '\n' . $e->errorMessage();
        }

        try {
            $mail->send();
        } catch (Exception $e) {
            $email_error .= '\n' . $e->errorMessage();
        }

        $data = ['message' => 'Your enquire success deliver, our staff will email your later.', 'mail_error' => $email_error];
    }

    echo json_encode($data);
}

$conn->close();
