<?php
require_once '../../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['id'];
    $reply = $_POST['reply'];
    $action = $_POST['action'];

    if ($action === 'delete') {
        $sql = "delete from message where id = " . $id;

        $conn->query($sql);

        header('Location: ../admin_message.php');
    }

    if ($action === 'update') {
        $sql = "update message set reply = '" . $reply . "' where id = " . $id;

        $conn->query($sql);

        header('Location: ../admin_message.php?reply=' . $id);
    }

    $conn->close();
}