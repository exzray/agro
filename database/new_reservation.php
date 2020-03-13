<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $statement = $conn->prepare("insert into reservation (name, email, contact, size, activity, booking_date, payment) values (?,?,?,?,?,?,?)");
    $statement->bind_param("sssisss", $name, $email, $contact, $size, $activity, $booking_date, $payment);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $size = $_POST['size'];
    $activity = $_POST['activity'];
    $booking_date = date_format(date_create_from_format('m/d/Y', $_POST['booking_date']), 'Y-m-d');
    $payment = 'deposit';

    $statement->execute();

    header("Content-Type: application/json");
    $data = ['status' => 'success', 'msg' => $conn->error];

    echo json_encode($data);

    $statement->close();
}

$conn->close();