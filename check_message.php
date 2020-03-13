<?php
    require_once 'database/connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET'){

        if (isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = 'select * from messages where id = ' . $id;

            $result = $conn->query($sql);

            if ($result->num_rows === 1){
                $row = $result->fetch_assoc();
            }
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AgroFarm | Home</title>

        <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
        <link href="assets/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div class="p-5 min-vh-100">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 p-5 rounded bg-white shadow-sm">
                    <div class="text-center mb-4"><h3>Your reply</h3></div>
                    <p>Name: <?php echo ucwords($row['name'])?></p>
                    <p>Message: <?php echo ucwords($row['message'])?></p>
                    <p>Reply: <?php echo empty($row['reply']) ? 'No reply yet':$row['reply']?></p>
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

