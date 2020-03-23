<?php
$activities = array();

if (isset($_GET['page_index'])) {
    $page_index = $_GET['page_index'];
} else {
    $page_index = 1;
}

$row_per_page = 10;
$offset = ($page_index - 1) * $row_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM activity";
$result = mysqli_query($conn, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $row_per_page);

$sql = "select * from activity order by id limit $offset, $row_per_page;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        array_push($activities, $row);
    }
}

$conn->close();
?>
<div class="container">
    <div class="clearfix">
        <a href="admin_activity.php?form=yes" class="float-right btn btn-primary btn-sm">Create New Activity</a>
    </div>
    <hr>
    <br>
    <?php if (!empty($activities)): ?>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">LABEL</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">IMAGE</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($activities as $activity): ?>
                <tr>
                    <th scope="row"><?= $activity['id'] ?></th>
                    <td><?= $activity['label'] ?></td>
                    <td><?= $activity['description'] ?></td>
                    <td style="width: 150px;">
                        <?php if (empty($activity['image'])): ?>
                            <div class="border d-flex justify-content-center align-items-center flex-column"
                                 style="height: 100px">
                                <span class="text-danger">No image yet!</span>
                            </div>
                        <?php else: ?>
                            <img src="../<?= $activity['image'] ?>" alt="" class="img-thumbnail"/>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="admin_activity.php?form=yes&id=<?= $activity['id'] ?>">edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <ul class="mt-5 list-unstyled">
        </ul>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($n = 1; $n < $total_pages; $n++): ?>
                    <li class="page-item"><a class="page-link"
                                             href="admin_activity.php?page_index=<?= $n ?>"><?= $n ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">Currently list is empty!</div>
    <?php endif; ?>
</div>
