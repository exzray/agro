<?php
require_once '../database/connect.php';

$today = date("Y-m-d");
$size_message = 0;
$size_reservation = 0;
$size_activity = 0;

$sql = "select count(*) from message where created='$today';";
$result = $conn->query($sql);
if ($result) $size_message = $result->fetch_row()[0];

$sql = "select count(*) from reservation where created='$today';";
$result = $conn->query($sql);
if ($result) $size_reservation = $result->fetch_row()[0];

$sql = "select count(*) from activity;";
$result = $conn->query($sql);
if ($result) $size_activity = $result->fetch_row()[0];
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>Admin</title>
    </head>
    <body>
        <?php include_once 'navbar.php' ?>

        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card w-100">
                        <img class="card-img-top" src="../assets/img/card_image.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="text-center card-title"><?=$size_message?></h5>
                            <p class="card-text">Today messages</p>
                            <a href="admin_message.php" class="btn btn-warning">see messages</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card w-100">
                        <img class="card-img-top" src="../assets/img/card_image.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="text-center card-title"><?=$size_reservation?></h5>
                            <p class="card-text">New today reservation</p>
                            <a href="admin_reservation.php" class="btn btn-warning">see reservation</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card w-100">
                        <img class="card-img-top" src="../assets/img/card_image.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="text-center card-title"><?=$size_activity?></h5>
                            <p class="card-text">Available activity</p>
                            <a href="admin_activity.php" class="btn btn-warning">see activity</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>

<?php
$conn->close();
?>

