<?php
require_once "../../database/connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $file = $_FILES["file"];
    $label = $_POST["label"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $action = $_POST["action"];

    // handle file upload
    $file_name = $file["name"];
    $file_tmp_name = $file["tmp_name"];
    $file_destination = "../../upload/activity_image/$file_name";

    if (!empty($file_name)) {
        $status = move_uploaded_file($file_tmp_name, $file_destination);

        if ($status) $image = "upload/activity_image/$file_name";
    }

    if ($action === "create") {
        $sql = "insert into activity (label, description, image) values ('$label', '$description', '$image')";
        $status = $conn->query($sql);

        $id = $conn->insert_id;

        if ($status) header("Location: ../_activity_form.php?id=$id");
    }

    if (isset($_POST["id"])) {
        $id = $_POST["id"];

        if ($action === "update") {
            $sql = "update activity set label='$label', description='$description', image='$image' where id=$id";
            $status = $conn->query($sql);

            if ($status) header("Location: ../_activity_form.php?id=$id");
        }

        if ($action === "delete") {
            $sql = "delete from activity where id=$id";
            $status = $conn->query($sql);

            if ($status) header('Location: ../admin_activity.php');
        }
    }

    if ($conn->error) echo $conn->error;

    $conn->close();
}
