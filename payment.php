<?php
require_once 'database/connect.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET["id"];
    $total = $_GET["total"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $payment = $_POST["payment"];

    $sql = "update reservation set status='success' where id=$id";
    $result = $conn->query($sql);
    if ($result) header("Location: check_reservation.php?id=$id");
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Gateway</title>
</head>
<body>

<br>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h2 class="mt-5">Payment</h2>
            <br>
            <hr>
            <br>
            <form method="post" action="payment.php">

                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="payment" value="<?= $total * 0.25 ?>">

                <label for="id_merchant">Select your merchant</label>
                <select id="id_merchant" name="merchant" class="form-control mb-4">
                    <option value="maybank">Maybank</option>
                    <option value="bank_islam">Bank Islam</option>
                    <option value="bank_nasional">Bank Nasional</option>
                </select>

                <p>Total payment: <span class="text-info">RM <?= $total * 0.25 ?></span></p>
                <br>
                <hr>
                <br>
                <div class="clearfix">
                    <button type="submit" class="btn btn-outline-warning float-right">Pay Now</button>
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

