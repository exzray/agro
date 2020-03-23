<?php require_once "database/connect.php"
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
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
        <link href="assets/css/magnific-popup.css" rel="stylesheet">
        <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">

        <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>


        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    </head>
    <body>
    <a class="scrollToTop" href="#">
        <i class="fa fa-angle-up"></i>
    </a>

    <?php include_once '_navbar.php' ?>

    <?php include_once '_slider.php' ?>

    <?php include_once '_about_us.php' ?>

    <?php include_once '_counter.php' ?>

    <?php include_once '_package.php' ?>

    <?php include_once '_reservation.php' ?>

    <?php include_once '_gallery.php' ?>

    <?php include_once '_testimony.php' ?>

    <?php include_once '_contact.php' ?>

    <!-- Start Map section -->
    <section id="mu-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9207.358598888495!2d-85.64847801496286!3d30.183918972289003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x2320479d70eb6202!2sDillard&#39;s!5e0!3m2!1sbn!2sbd!4v1462359735720"
                width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
    </section>
    <!-- End Map section -->

    <!-- Start Footer -->
    <footer id="mu-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-footer-area">
                        <div class="mu-footer-social">
                            <a href="#"><span class="fa fa-facebook"></span></a>
                            <a href="#"><span class="fa fa-twitter"></span></a>
                            <a href="#"><span class="fa fa-google-plus"></span></a>
                            <a href="#"><span class="fa fa-linkedin"></span></a>
                            <a href="#"><span class="fa fa-youtube"></span></a>
                        </div>
                        <div class="mu-footer-copyright">
                            <p>&copy; Copyright <a rel="nofollow" href="http://markups.io">markups.io</a>. All right
                                reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <div style="position: fixed; margin: 50px; bottom: 0; left: 0;">
        <a id="bookingReminder" href="index.php" class="btn btn-warning btn-lg">See My Booking</a>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/slick.js"></script>
    <script type="text/javascript" src="assets/js/simple-animated-counter.js"></script>
    <script type="text/javascript" src="assets/js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script src="assets/js/custom.js"></script>

    </body>
    </html>

<?php $conn->close() ?>