<?php
require_once '../database/connect.php';

$packages = array();
$activities = array();
$services = array();

$default_package = null;

$sql = "select * from package";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($packages, $row);

        if (isset($_GET['id'])) {
            if ($row['id'] === $_GET['id']) {
                $default_package = $row;
            }
        }

        if (!isset($default_package)) $default_package = $row;
    }
}

$sql = "select * from activity";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($activities, $row);
    }
}

if (isset($default_package)) {
    $sql = "select * from service where id_package = " . $default_package['id'];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($services, $row['id_activity']);
        }
    }
}


$conn->close();
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
        <a href="_package_form.php" class="float-right btn btn-primary btn-sm">Create New Package</a>
    </div>
    <hr>
    <br>
    <?php if (!empty($packages)): ?>
        <div class="row">
            <div class="col-md-3 mb-4">
                <ul class="list-group">
                    <?php foreach ($packages as $package): ?>
                        <li class="list-group-item">
                            <a href="admin_package.php?id=<?= $package['id'] ?>"><?= $package['name'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-9">
                <?php if (isset($default_package)): ?>
                    <h3>View: <?= $default_package['name'] ?> <small class="ml-3"><a
                                    href="_package_form.php?id=<?= $default_package['id'] ?>">Edit</a></small></h3>
                    <hr>
                    <br>
                    <h5>Price per pax: RM<?= $default_package['price'] ?>, Limit
                        people: <?= $default_package['maximum'] ?></h5>
                    <br>
                    <table class="table">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th scope="row">LABEL</th>
                            <th scope="row">DESCRIPTION</th>
                            <th scope="row">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($activities as $activity): ?>
                            <tr>
                                <td><?= $activity['label'] ?></td>
                                <td><?= $activity['description'] ?></td>
                                <td>
                                    <form method="post" action="functions/edit_service.php">
                                        <input type="hidden" name="id_package" value="<?= $default_package['id'] ?>">
                                        <input type="hidden" name="id_activity" value="<?= $activity['id'] ?>">
                                        <?php if (!in_array($activity['id'], $services)): ?>
                                            <button name="action" value="add" class="btn btn-info btn-sm btn-block">Add
                                            </button>
                                        <?php else: ?>
                                            <button name="action" value="remove"
                                                    class="btn btn-danger btn-sm btn-block">
                                                Remove
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted">No package yet</p>
                <?php endif; ?>
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
