<?php
require_once '../../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $file = $_FILES["file"];
    $file_name = $file["name"];
    $file_tmp_name = $file["tmp_name"];
    $file_destination = "../../upload/$file_name";
    move_uploaded_file($file_tmp_name, $file_destination);

    $label = $_POST['label'];
    $description = $_POST['description'];
    $image = empty($file_name) ? $_POST['image_name']:"upload/$file_name";
    $action = $_POST['action'];

    if (!isset($_POST['id'])) {
        // do insert
        $sql = "insert into activity (label, description, image) values ('$label', '$description', '$image')";

        if ($conn->query($sql)) {
            header('Location: ../admin_activity.php?form=yes&id=' . mysqli_insert_id($conn));
        }
    } else {
        $id = $_POST['id'];

        if ($action === 'delete') {
            $sql = "delete from activity where id = " . $id;

            $conn->query($sql);

            header('Location: ../admin_activity.php');

        } else {
            $sql = "update activity set label = '$label', description = '$description', image = '$image' where id = $id";

            if ($conn->query($sql)) {
                header('Location: ../admin_activity.php?form=yes&id=' . $id);
            }
        }
    }

    if ($conn->error) echo $conn->error;
}

$conn->close();
