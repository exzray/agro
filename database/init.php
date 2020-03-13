<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
}

$sql = 'create or replace database if not exists agro';
if (!$conn->query($sql)) echo 'fail create database agro!';

$sql = 'use agro';
$conn->query($sql);

$sql = '
create or replace table activity
(
    id int auto_increment
    primary key,
    label varchar (30) null,
    description varchar (300) null,
    image varchar (120) null,
)';
if (!$conn->query($sql)) echo 'Fail create table activity!';

$sql = '
create or replace table message
(
    id int auto_increment
    primary key,
    name varchar (60) null,
    email varchar (60) null,
    subject varchar (60) null,
    message varchar (300) null,
    reply varchar (300) null,
    created date null
)';
if (!$conn->query($sql)) echo 'Fail create table message!';

$sql = '
create or replace table package
(
    id int auto_increment
    primary key,
    name varchar (30) null,
    price double null,
    maximum int null
)';
if (!$conn->query($sql)) echo 'Fail create table package!';

$sql = '
create or replace table service
(
    id int auto_increment
    primary key,
    id_package int not null,
    id_activity int not null,
    constraint service_activity_id_fk
    foreign key (id_activity) references activity (id)
    on delete cascade,
    constraint service_package_id_fk
    foreign key (id_package) references package (id)
    on delete cascade
)';
if (!$conn->query($sql)) echo 'Fail create table service!';


mysqli_close($conn);

