<?php
require_once '../../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_package = $_POST['id_package'];
    $id_activity = $_POST['id_activity'];
    $action = $_POST['action'];

    if ($action === "add") {
        $sql = "insert into service (id_package, id_activity) select $id_package, $id_activity
        where not exists (select id_package, id_activity from service where id_package=$id_package and id_activity=$id_activity)";

        if ($conn->query($sql)) {
            header("Location: ../admin_package.php?id=$id_package");
        }
    }

    if ($action === "remove") {
        $sql = "delete from service where id in (select id from service where id_package=$id_package and id_activity=$id_activity)";

        if ($conn->query($sql)) {
            header("Location: ../admin_package.php?id=$id_package");
        }
    }

    if ($conn->error){
        echo $conn->error;
    }
}

$conn->close();
