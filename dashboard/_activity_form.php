<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = 'select * from activity where id = ' . $id;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
}

$conn->close();
?>

<div class="container">
    <br>
    <a href="admin_activity.php" class="mt-5 alert-link"><p>view activity list</p></a>
    <hr class="my-4">
    <div class="row">
        <div class="col-md-5">
            <form method="post" action="functions/edit_activity.php" class="clearfix">
                <?php if (isset($_GET['id'])): ?>
                    <div class="form-group row">
                        <label for="id_id" class="col-sm-2">ID</label>
                        <div class="col-sm-10">
                            <input id="id_id" readonly name="id" class="form-control" value="<?= $data['id'] ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group row">
                    <label for="id_label" class="col-sm-2">Label</label>
                    <div class="col-sm-10">
                        <input id="id_label" name="label" class="form-control"
                               value="<?= isset($data['label']) ? $data['label'] : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_image" class="col-sm-2">Image</label>
                    <div class="col-sm-10">
                        <input id="id_image" name="image" class="form-control"
                               value="<?= isset($data['image']) ? $data['image'] : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_description" class="col-sm-2">Desc</label>
                    <div class="col-sm-10">
                        <textarea rows="4" id="id_description" name="description"
                                  class="form-control"><?= isset($data['description']) ? $data['description'] : '' ?></textarea>
                    </div>
                </div>
                <hr class="my-4">
                <?php if (isset($_GET['id'])): ?>
                    <button type="submit" class="btn btn-outline-danger float-left" name="action" value="delete">Delete
                    </button>
                <?php endif; ?>
                <button type="submit" class="btn btn-outline-info float-right" name="action"
                        value="update"><?= isset($_GET['id']) ? 'Update' : 'Submit' ?>
                </button>
            </form>
        </div>
    </div>
</div>
