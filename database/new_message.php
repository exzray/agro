<?php
require_once 'connect.php';
require_once "mailer.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = "";

    $statement = $conn->prepare('insert into message (name, email, subject, message, created) values (?, ?, ?, ?, ?);');
    $statement->bind_param('sssss', $name, $email, $subject, $message, $created);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $created = date("Y-m-d");

    if ($statement->execute()) {

        try {
            $mail->addAddress($email);
        } catch (Exception $e) {
            $error .= "\n" . $e->getMessage();
        }
        $mail->Body = '<p>You receive your enquire copy url <a target="_blank" href="localhost/agro/check_message.php?id=' . $statement->insert_id . '">click here</a> to see your reply.</p>';
        try {
            $mail->send();
        } catch (Exception $e) {
            $error .= "\n" . $e->getMessage();
        }
    }

    if ($conn->error) $error .= "\n" . $conn->error;

    $data = ['message' => 'Your enquire success deliver, our staff will email your later.', $error];

    header("Content-Type: application/json");
    echo json_encode($data);

    $statement->close();
}

$conn->close();
