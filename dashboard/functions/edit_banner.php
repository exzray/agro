<?php
require_once "../../database/connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $file = $_FILES["file"];
    $title = $_POST["title"];
    $subtitle = $_POST["subtitle"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $action = $_POST["action"];

    // handle file upload
    $file_name = $file["name"];
    $file_tmp_name = $file["tmp_name"];
    $file_destination = "../../upload/$file_name";

    if (!empty($file_name)) {
        $status = move_uploaded_file($file_tmp_name, $file_destination);

        if ($status) $image = "upload/$file_name";
    }

    if ($action === "create") {
        $sql = "insert into banner (title, subtitle, description, image) values ('$title', '$subtitle', '$description', '$image')";
        $status = $conn->query($sql);

        $id = $conn->insert_id;

        if ($status) header("Location: ../_banner_form.php?id=$id");
    }

    if (isset($_POST["id"])) {
        $id = $_POST["id"];

        if ($action === "update") {
            $sql = "update banner set title='$title', subtitle='$subtitle', description='$description', image='$image' where id=$id";
            $status = $conn->query($sql);

            if ($status) header("Location: ../_banner_form.php?id=$id");
        }

        if ($action === "delete") {
            $sql = "delete from banner where id=$id";
            $status = $conn->query($sql);

            if ($status) header('Location: ../admin_banner.php');
        }

        if ($conn->error) echo $conn->error;
    }

    $conn->close();
}
