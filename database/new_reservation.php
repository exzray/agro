<?php
require_once 'connect.php';
require_once "mailer.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = "";
    $booking_id = null;

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

    // booking condition filter
    $size_limit = false;
    $date_limit = false;
    $total_people = 0;

    $sql = "select sum(people) as total_people from reservation where id_package=$id_package and start='$booking_date';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $total_people = $result->fetch_assoc()['total_people'];
    }

    if (($total_people + $size) > $maximum_people) {
        $error .= "\n" . "$booking_date your group size is exceeding limit! Please change number of people or book another day. Thank you.";
        $size_limit = true;
    }

    if ($created_date > $booking_date) {
        $error .= "\n" . "You cannot choose today as booking date.";
        $date_limit = true;
    }

    if (!$date_limit and !$size_limit) {
        $statement->execute();

        $booking_id = $statement->insert_id;
        try {
            $mail->addAddress($email);
        } catch (Exception $e) {
            $error .= "\n" . $e->getMessage();
        }
        $mail->Body = '<p>You receive your enquire copy url <a target="_blank" href="localhost/agro/check_reservation.php?id=' . $booking_id . '">click here</a> to see your reply.</p>';
        try {
            $mail->send();
        } catch (Exception $e) {
            $error .= $e->getMessage();
        }
    }

    if ($conn->error) $error .= "\n" . $conn->error;

    $data = ["id" => $booking_id, "error" => $error];

    header("Content-Type: application/json");
    echo json_encode($data);

    $statement->close();
}

$conn->close();