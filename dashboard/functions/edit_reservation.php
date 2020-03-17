<?php
require_once '../../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $people = $_POST['people'];
    $id_package = $_POST['id_package'];
    $status = $_POST['status'];
    $action = $_POST['action'];

    if ($action === 'update') {
        $sql = "update reservation set name='$name', email='$email', contact='$contact', people=$people, id_package=$id_package, status='$status' where id=$id";
        $conn->query($sql);

        header('Location: ../_reservation_form.php?id=' . $id);
    }

    if ($action === 'delete') {
        $sql = "delete from reservation where id=$id";
        $conn->query($sql);

        header('Location: ../admin_reservation.php');
    }

    if ($conn->error) echo $conn->error;

    $conn->close();
}