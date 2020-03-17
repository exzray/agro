<?php
?>

<?php
require_once '../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "select * from reservation where id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $reservation = $result->fetch_assoc();
        }
    } else header("Location: ../admin_reservation.php");
}

$packages = array();

$sql = "select * from package";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) array_push($packages, $row);
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
<?php include_once 'navbar.php' ?>

<div class="container">
    <br>
    <a href="admin_reservation.php" class="mt-5 alert-link"><p>view reservation list</p></a>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-5">
            <form method="post" action="functions/edit_reservation.php">
                <div class="form-group">
                    <label for="id_id">ID</label>
                    <input readonly id="id_id" type="text" name="id" class="form-control"
                           value="<?= ucwords($reservation['id']) ?>">
                </div>
                <div class="form-group">
                    <label for="id_name">Name</label>
                    <input id="id_name" type="text" name="name" class="form-control"
                           value="<?= ucwords($reservation['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="id_email">Email</label>
                    <input id="id_email" type="email" name="email" class="form-control"
                           value="<?= $reservation['email'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="id_contact">Contact</label>
                    <input id="id_contact" type="tel" name="contact" class="form-control"
                           value="<?= $reservation['contact'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="id_people">Size people</label>
                    <input id="id_people" type="number" name="people" class="form-control"
                           value="<?= $reservation['people'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="id_package">Package selected</label>
                    <select id="id_package" class="form-control" name="id_package">
                        <?php foreach ($packages as $package): ?>
                            <?php if ($package['id'] === $reservation['id_package']): ?>
                                <option value="<?= $package['id'] ?>"
                                        selected="selected"><?= $package['name'] ?></option>
                            <?php else: ?>
                                <option value="<?= $package['id'] ?>"><?= $package['name'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_start">Booking date</label>
                    <input id="id_start" type="text" class="form-control" value="<?= $reservation['start'] ?>" readonly
                           required>
                </div>
                <div class="form-group">
                    <label for="id_created">Booking created</label>
                    <input id="id_created" type="text" class="form-control" value="<?= $reservation['created'] ?>"
                           readonly required>
                </div>

                <div class="clearfix">
                    <button name="action" value="delete" class="btn btn-outline-danger mt-4">DELETE</button>
                    <button name="action" value="update" class="btn btn-outline-info float-right mt-4">UPDATE</button>
                </div>
            </form>
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


