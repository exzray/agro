<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '';
$schema = 'agro';

$conn = new mysqli($host, $user, $pass, $schema);

if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
}
