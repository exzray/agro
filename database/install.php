<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
}

$sql = "create or replace database agro";
if (!$conn->query($sql)) echo $conn->connect_error;

$sql = "use agro";
$conn->query($sql);

$sql = "
create or replace table reservation
(
    id int auto_increment
    primary key,
    name varchar (60) null,
    email varchar (60) null,
    contact varchar (12) null,
    people int null,
    id_package int not null,
    start date null,
    created date null,
    constraint reservation_package_id_fk
    foreign key (id_package) references package (id)
    on delete cascade
)";
$conn->query($sql);
if ($conn->connect_error) echo $conn->connect_error;

$sql = "
create or replace table activity
(
    id int auto_increment primary key,
    label varchar (30) null,
    description varchar (300) null,
    image varchar (120) null
)";
$conn->query($sql);
if ($conn->connect_error) echo $conn->connect_error;

$sql = "
create or replace table message
(
    id int auto_increment primary key,
    name varchar (60) null,
    email varchar (60) null,
    subject varchar (60) null,
    message varchar (300) null,
    reply varchar (300) null,
    created date null
)";
$conn->query($sql);
if ($conn->connect_error) echo $conn->connect_error;

$sql = "
create or replace table package
(
    id int auto_increment
    primary key,
    name varchar (30) null,
    price double null,
    maximum int null
);";
$conn->query($sql);
if ($conn->connect_error) echo $conn->connect_error;

$sql = "
create or replace table reservation
(
    id int auto_increment
    primary key,
    name varchar (60) null,
    email varchar (60) null,
    contact varchar (12) null,
    people int null,
    id_package int not null,
    start date null,
    created date null,
    status varchar (20) default 'pending' null,
    constraint reservation_package_id_fk
    foreign key (id_package) references package (id)
    on delete cascade
)";
$conn->query($sql);
if ($conn->connect_error) echo $conn->connect_error;

$sql = "
create or replace table service
(
    id int auto_increment
    primary key,
    id_package int null,
    id_activity int null,
    constraint service_activity_id_fk
    foreign key (id_activity) references activity (id)
    on delete cascade,
    constraint service_package_id_fk
    foreign key (id_package) references package (id)
    on delete cascade
);";
$conn->query($sql);
if ($conn->connect_error) echo $conn->connect_error;

$sql = "
create or replace table banner
(
    id int auto_increment
    primary key,
    title varchar (120) null,
    subtitle varchar (120) null,
    description varchar (500) null,
    image varchar (200) null
);";
$conn->query($sql);
if ($conn->connect_error) echo $conn->connect_error;

echo "Executing script is finish";

mysqli_close($conn);

