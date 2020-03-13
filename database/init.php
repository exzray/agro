<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
}

$sql = 'create database if not exists agro;';

if (!$conn->query($sql)){
    echo 'fail create database agro';
}

$sql = 'use agro;';
$conn->query($sql);

$sql = 'create table if not exists reservation
(
	id int auto_increment,
	name varchar(120) not null,
	email varchar(40) not null,
	contact varchar(12) not null,
	size int not null,
	activity varchar(30) not null,
	booking_date date not null,
	payment varchar(20) not null,
	constraint agro_pk
		primary key (id)
);';

if (!$conn->query($sql)){
    echo 'fail create table reservation';
}

mysqli_close($conn);

