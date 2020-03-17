<?php

require_once "../../database/connect.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $maximum = $_POST["maximum"];
    $action = $_POST["action"];

    if ($action === 'submit') {
        $sql = "insert into package (name, price, maximum) values ('$name', $price, $maximum)";

        if ($conn->query($sql)) {
            $id = $conn->insert_id;
            header("Location: ../admin_package.php?id=$id");
        }
    }

    if ($action === 'update') {
        $id = $_POST["id"];
        $sql = "update package set name='$name', price=$price, maximum=$maximum where id=$id";

        if ($conn->query($sql)) {
            header("Location: ../admin_package.php?id=$id");
        }
    }

    if ($action === 'delete') {
        $id = $_POST["id"];
        $sql = "delete from package where id=$id";

        if ($conn->query($sql)) {
            header("Location: ../admin_package.php?id=$id");
        }
    }

    if ($conn->error) {
        echo $conn->error;
    }
}

$conn->close();
