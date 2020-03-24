<?php
require_once 'database/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" and isset($_GET["id"])) {
    $id = $_GET["id"];

    $reservation = null;
    $package = null;
    $activities = array();


    $sql = "select * from reservation where id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $reservation = $result->fetch_assoc();
    }

    $package_id = $reservation["id_package"];
    $sql = "select * from package where id=$package_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
    }

    $activities_ids = array();
    $sql = "select id_activity from service where id_package=$package_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) array_push($activities_ids, $row["id_activity"]);
    }

    $activities_ids_str = join(",", $activities_ids);
    $sql = "select * from activity where id in ($activities_ids_str)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) array_push($activities, $row);
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Admin</title>
</head>
<body>

<div class="container">
    <h2 class="my-5">Booking View</h2>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-7">
            <div class="bg-white p-3 rounded">
                <form method="get" action="payment.php">
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <div class="form-group row">
                        <label for="id_name" class="col-sm-3 col-form-label">Name Customer</label>
                        <div class="col-sm-9">
                            <input id="id_name" type="text" readonly class="form-control"
                                   value="<?= $reservation["name"] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input id="id_email" type="text" readonly class="form-control"
                                   value="<?= $reservation["email"] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_contact" class="col-sm-3 col-form-label">Contact</label>
                        <div class="col-sm-9">
                            <input id="id_contact" type="text" readonly class="form-control"
                                   value="<?= $reservation["contact"] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_people" class="col-sm-3 col-form-label">People</label>
                        <div class="col-sm-9">
                            <input id="id_people" type="text" readonly class="form-control"
                                   value="<?= $reservation["people"] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_package_name" class="col-sm-3 col-form-label">Package</label>
                        <div class="col-sm-9">
                            <input id="id_package_name" type="text" readonly class="form-control"
                                   value="<?= $package["name"] ?>">

                            <?php if (empty($activities)): ?>
                                <p class="text-muted">Your selected package do not has any activity yet!</p>
                            <?php else: ?>
                                <ul class="p-2 bg-light rounded my-3">
                                    <?php foreach ($activities as $activity): ?>
                                        <li><?= $activity["label"] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_created" class="col-sm-3 col-form-label">Book Date</label>
                        <div class="col-sm-9">
                            <input id="id_created" type="text" readonly class="form-control"
                                   value="<?= $reservation["created"] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_start" class="col-sm-3 col-form-label">Book Start</label>
                        <div class="col-sm-9">
                            <input id="id_start" type="text" readonly class="form-control"
                                   value="<?= $reservation["start"] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_status" class="col-sm-3 col-form-label">Status Deposit</label>
                        <div class="col-sm-9">
                            <input id="id_status" type="text" readonly class="form-control"
                                   value="<?= $reservation["status"] ?>">
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>

                    <div class="row">
                        <div class="col-sm-3">Total payment</div>
                        <?php if ($reservation["status"] !== "success"): ?>
                            <div class="col-sm-9 mb-2">RM<?= $reservation["people"] * $package["price"] ?></div>
                        <?php else: ?>
                            <div class="col-sm-9 mb-2">RM<?= ($reservation["people"] * $package["price"]) * 0.75 ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">Deposit(25%)</div>
                        <div class="col-sm-9 mb-4">
                            RM<?= ($reservation["people"] * $package["price"]) * 0.25 ?>
                            <?php if ($reservation["status"] === "success"): ?>
                                <span class="text-info ml-2">Already paid</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($reservation["status"] !== "success"): ?>
                        <div class="clearfix">
                            <button type="submit" class="btn btn-danger btn-sm float-right">Pay deposit now?</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>

