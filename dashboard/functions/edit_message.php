<?php
require_once '../../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['id'];
    $reply = $_POST['reply'];

    $sql = "update message set reply = '" . $reply . "' where id = " . $id;

    $conn->query($sql);

    $conn->close();

    header('Location: ../admin_message.php?reply=' . $id);
}