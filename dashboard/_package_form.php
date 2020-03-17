<?php
require_once '../database/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "select * from package where id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $package = $result->fetch_assoc();
        }

        if ($conn->error) {
            echo $conn->error;
        }

        $conn->close();
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
<?php include_once 'navbar.php' ?>

<div class="container">
    <br>
    <a href="admin_package.php" class="mt-5 alert-link"><p>view package list</p></a>
    <hr>
    <br>
    <?php if (isset($id)): ?>
        <h2>Edit package: <?= ucwords($package['name']) ?></h2>
    <?php else: ?>
        <h2>New Package</h2>
    <?php endif; ?>
    <br>
    <div class="row">
        <div class="col-md-5">
            <form method="post" action="functions/edit_package.php" class="clearfix">
                <?php if (isset($id)): ?>
                    <input type="hidden" name="id" value="<?= $package['id'] ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="id_name">Name</label>
                    <input type="text" id="id_name" class="form-control" name="name"
                           value="<?= isset($package['name']) ? $package['name'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="id_price">Price</label>
                    <input type="text" id="id_price" class="form-control" name="price"
                           value="<?= isset($package['price']) ? $package['price'] : '' ?>">
                </div>
                <div class="form-group">
                    <label for="id_maximum">Maximum</label>
                    <input type="text" id="id_maximum" class="form-control" name="maximum"
                           value="<?= isset($package['maximum']) ? $package['maximum'] : '' ?>">
                </div>
                <br>
                <div>
                    <?php if (isset($id)): ?>
                        <button class="btn btn-outline-info float-right" name="action" value="update">Update</button>
                        <button class="btn btn-outline-danger" name="action" value="delete">Delete</button>
                    <?php else: ?>
                        <button class="btn btn-outline-info float-right" name="action" value="submit">Submit</button>
                    <?php endif; ?>
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