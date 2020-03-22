<?php
require_once "../database/connect.php";

$banners = array();

$sql = "select * from banner";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) array_push($banners, $row);
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
        <a href="_banner_form.php" class="float-right btn btn-primary btn-sm">Add Banner</a>
    </div>
    <hr>
    <br>
    <?php if (!empty($banners)): ?>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="row">ID</th>
                <th scope="row">Title</th>
                <th scope="row">Subtitle</th>
                <th scope="row">Description</th>
                <th scope="row">Image</th>
                <th scope="row">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($banners as $banner): ?>
                <tr>
                    <td><?= $banner['id'] ?></td>
                    <td><?= $banner['title'] ?></td>
                    <td><?= $banner['subtitle'] ?></td>
                    <td><?= $banner['description'] ?></td>
                    <td style="width: 150px;">
                        <img src="../<?= $banner['image'] ?>" alt="" class="img-thumbnail"/>
                    </td>
                    <td><a href="_banner_form.php?id=<?= $banner['id'] ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">Currently no banner is added</div>
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