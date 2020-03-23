<?php
require_once "../database/connect.php";

$id = "";
$label = "";
$description = "";
$image = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "select * from activity where id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $label = $row["label"];
            $description = $row["description"];
            $image = $row["image"];
        }
    }
}

if ($conn->error) echo $conn->error;

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
        <a href="admin_banner.php" class="btn btn-primary btn-sm">View banner list</a>
    </div>
    <hr>
    <br>
    <form method="post" action="functions/edit_activity.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <?php if (!empty($image)): ?>
                    <img src="../<?= $image ?>" alt="" class="img-thumbnail mr-2"/>
                <?php else: ?>
                    <div class="d-flex flex-column justify-content-center align-items-center h-100 border">
                        <span class="text-muted">No image set yet</span>
                    </div>
                <?php endif; ?>
                <input type="file" name="file" class="mt-4">
            </div>
            <div class="col-md-8">
                <h2 class="mb-4"><?= empty($id) ? 'Create Activity' : "Edit: $label" ?></h2>

                <?php if (!empty($id)): ?>
                    <div class="mb-4 form-group">
                        <label for="id_id">ID</label>
                        <input id="id_id" type="text" name="id" class="form-control" value="<?= $id ?>" readonly>
                    </div>
                <?php endif; ?>

                <div class="mb-4 form-group">
                    <label for="id_label">Label</label>
                    <input id="id_label" type="text" placeholder="My label" name="label" class="form-control" required
                           value="<?= $label ?>">
                </div>

                <div class="mb-4 form-group">
                    <label for="id_description">Description</label>
                    <textarea rows="4" id="id_description" type="text" placeholder="My description" name="description"
                              required
                              class="form-control"><?= $description ?></textarea>
                </div>

                <input type="hidden" name="image" value="<?= $image ?>">

                <div class="clearfix">
                    <?php if (empty($id)): ?>
                        <button type="submit" name="action" value="create" class="btn btn-info btn-sm float-right">
                            Create
                        </button>
                    <?php else: ?>
                        <button type="submit" name="action" value="delete" class="btn btn-outline-danger btn-sm">
                            Delete
                        </button>
                        <button type="submit" name="action" value="update" class="btn btn-info btn-sm float-right">
                            Update
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>
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