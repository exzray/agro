<?php

if (isset($_GET['reply'])) {
    $id = $_GET['reply'];

    $sql = 'select * from message where id = ' . $id;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
}

$conn->close();
?>

<div class="container">
    <br>
    <a href="admin_message.php" class="mt-5 alert-link"><p>view message list</p></a>
    <hr class="my-4">
    <div class="row">
        <div class="col-md-5">
            <form method="post" action="functions/edit_message.php" class="clearfix">
                <div class="form-group row">
                    <label for="id_id" class="col-sm-2">ID</label>
                    <div class="col-sm-10">
                        <input id="id_id" name="id" readonly class="form-control" value="<?= $data['id'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_name" class="col-sm-2">Name</label>
                    <div class="col-sm-10">
                        <input id="id_name" name="name" readonly class="form-control" value="<?= $data['name'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_email" class="col-sm-2">Email</label>
                    <div class="col-sm-10">
                        <input id="id_email" name="email" readonly class="form-control" value="<?= $data['email'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_subject" class="col-sm-2">Subject</label>
                    <div class="col-sm-10">
                        <input id="id_subject" name="subject" readonly class="form-control"
                               value="<?= $data['subject'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_message" class="col-sm-2">Message</label>
                    <div class="col-sm-10">
                        <textarea rows="4" id="id_message" name="message" readonly
                                  class="form-control"><?= ucwords($data['message']) ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_reply" class="col-sm-2">Your reply</label>
                    <div class="col-sm-10">
                        <textarea rows="4" id="id_reply" name="reply"
                                  class="form-control"><?= $data['reply'] ?></textarea>
                    </div>
                </div>
                <hr class="my-4">
                <button type="submit" class="btn btn-outline-danger float-left" name="action" value="delete">Delete</button>
                <button type="submit" class="btn btn-outline-info float-right" name="action" value="update">Update</button>
            </form>
        </div>
    </div>
</div>
