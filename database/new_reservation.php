<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $statement = $conn->prepare("insert into reservation (name, email, contact, people, id_package, start, created) values (?,?,?,?,?,?,?)");
    $statement->bind_param("sssiiss", $name, $email, $contact, $size, $id_package, $booking_date, $created_date);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $size = $_POST['people'];
    $id_package = $_POST['package'];
    $booking_date = date_format(date_create_from_format('m/d/Y', $_POST['start']), 'Y-m-d');
    $created_date = date("Y-m-d");

    $sql = "select * from package where id=$id_package";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
        $maximum_people = $package['maximum'];
    }

    $msg = '';

    // booking condition filter
    $size_limit = false;
    $date_limit = false;

    $sql = "select sum(people) as total_people from reservation where id_package=$id_package and start='$booking_date';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $total_people = $result->fetch_assoc()['total_people'];
    }

    if (($total_people + $size) >= $maximum_people) {
        $msg .= "$booking_date your group size is exceeding limit! Please change number of people or book another day. Thank you.";
        $size_limit = true;
    }

    if ($created_date > $booking_date) {
        $msg .= "You cannot choose today as booking date.";
        $date_limit = true;
    }

    if (!$date_limit and !$size_limit) {
        $statement->execute();
        $msg .= 'Your booking is receive, our staff will contact you later.';
    }

    if ($conn->error) $msg = $conn->error;

    $data = ['status' => 'success', 'msg' => $msg];

    header("Content-Type: application/json");
    echo json_encode($data);

    $statement->close();
}

$conn->close();