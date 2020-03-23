<?php
$messages = array();

if (isset($_GET['page_index'])) {
    $page_index = $_GET['page_index'];
} else {
    $page_index = 1;
}

$row_per_page = 10;
$offset = ($page_index - 1) * $row_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM message";
$result = mysqli_query($conn, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $row_per_page);

$sql = "select * from message order by id desc limit $offset, $row_per_page;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        array_push($messages, $row);
    }
}

$conn->close();
?>

<div class="container">
    <div class="clearfix">
        <a href="../" class="btn btn-primary btn-sm">View Website</a>
    </div>
    <hr>
    <br>
    <?php if (!empty($messages)): ?>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">EMAIl</th>
                <th scope="col">SUBJECT</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <th scope="row"><?= $message['id'] ?></th>
                    <td><?= $message['name'] ?></td>
                    <td><?= $message['email'] ?></td>
                    <td><?= $message['subject'] ?></td>
                    <td>
                        <a href="admin_message.php?reply=<?= $message['id'] ?>"><?= $message['reply'] === null ? 'reply' : 'edit' ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <ul class="mt-5 list-unstyled">
        </ul>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($n = 0; $n < $total_pages; $n++): ?>
                    <li class="page-item"><a class="page-link"
                                             href="admin_message.php?page_index=<?= $n + 1 ?>"><?= $n + 1 ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">Currently list is empty!</div>
    <?php endif; ?>
</div>
