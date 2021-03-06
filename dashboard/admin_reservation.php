<?php
?>

<?php
require_once '../database/connect.php';

$packages = array();
$reservations = array();

$sql = "select * from package";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) array_push($packages, $row);
}

// default sql for all row in reservation
$sql = "select * from reservation order by start desc;";

$filter_array = array();

if (isset($_GET['packages'])) {
    $str_package = join(',', $_GET['packages']);
    $id_filter = "id_package in ($str_package)";
    array_push($filter_array, $id_filter);
}

if (isset($_GET['status'])) {
    $str = $_GET['status'];
    $status_filter = "status = '$str'";
    array_push($filter_array, $status_filter);
}

$filter = join(' and ', $filter_array);
if (!empty($filter)) $sql = "select * from reservation where $filter order by start desc";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) array_push($reservations, $row);
}

if ($conn->error) echo $conn->error;
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
<br>
<div class="container">
    <div class="clearfix">
        <a href="../" class="btn btn-primary btn-sm">View Website</a>
    </div>
    <hr>
    <br>
    <?php if (!empty($reservations)): ?>
        <div class="row">
            <div class="col-md-3">
                <div>
                    <form method="get" action="admin_reservation.php">
                        <div class="form-group">
                            <label for="id_status">Status Filter</label>
                            <select class="form-control" id="id_status" name="status">
                                <?php foreach (['pending', 'success', 'cancel'] as $status): ?>
                                    <?php
                                    if (isset($_GET['status'])) $get_status = $_GET['status'];
                                    else $get_status = 'pending';
                                    ?>
                                    <?php if ($get_status === $status): ?>
                                        <option value="<?= $status ?>" selected="selected"><?= $status ?></option>
                                    <?php else: ?>
                                        <option value="<?= $status ?>"><?= $status ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_package">Package Filter</label>
                            <select multiple class="form-control" id="id_package" name="packages[]">
                                <?php foreach ($packages as $package): ?>
                                    <option value="<?= $package['id'] ?>"><?= ucwords($package['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-block">Filter</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">PEOPLE</th>
                        <th scope="col">PACKAGE</th>
                        <th scope="col">BOOKING</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <?php
                        foreach ($packages as $package) {
                            if ($package['id'] === $reservation['id_package']) $package_name = $package['name'];
                        }
                        ?>
                        <tr>
                            <?php
                            $status_highlight = '';
                            if ($reservation['status'] === 'pending') $status_highlight = 'text-info';
                            elseif ($reservation['status'] === 'success') $status_highlight = 'text-success';
                            elseif ($reservation['status'] === 'cancel') $status_highlight = 'text-danger';
                            ?>
                            <td><?= ucwords($reservation['name']) ?></td>
                            <td><?= $reservation['people'] ?></td>
                            <td><?= $package_name ?></td>
                            <td><?= $reservation['start'] ?></td>
                            <td class="<?= $status_highlight ?>"><?= $reservation['status'] ?></td>
                            <td><a href="_reservation_form.php?id=<?= $reservation['id'] ?>">edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">Currently list is empty!</div>
    <?php endif; ?>
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
