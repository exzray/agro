<?php

require_once "../../database/connect.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $maximum = $_POST["maximum"];

    $sql = "update package set name='$name', price=$price, maximum=$maximum where id=$id";

    if ($conn->query($sql)) {
        header("Location: ../admin_package.php?id=$id");
    }

    if ($conn->error) {
        echo $conn->error;
    }
}

$conn->close();
