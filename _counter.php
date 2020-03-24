<?php
require_once "database/connect.php";

$activity_count = 0;
$package_count = 0;
$reservation_count = 0;
$customer_count = 0;

$sql = "select count(*) as as_count from activity";
$result = $conn->query($sql);
if ($result->num_rows > 0) $activity_count = $result->fetch_assoc()["as_count"];

$sql = "select count(*) as as_count from package";
$result = $conn->query($sql);
if ($result->num_rows > 0) $package_count = $result->fetch_assoc()["as_count"];

$sql = "select count(*) as as_count from reservation";
$result = $conn->query($sql);
if ($result->num_rows > 0) $reservation_count = $result->fetch_assoc()["as_count"];

$sql = "select count(*) as as_count from reservation where status='success'";
$result = $conn->query($sql);
if ($result->num_rows > 0) $customer_count = $result->fetch_assoc()["as_count"];

?>

    <!-- Start Counter Section -->
    <section id="mu-counter">
        <div class="mu-counter-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mu-counter-area">

                            <ul class="mu-counter-nav">

                                <li class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="mu-single-counter">
                                        <span>Fresh</span>
                                        <h3>
                                            <span class="counter-value"
                                                  data-count="<?= $activity_count ?>">0</span><sup>+</sup>
                                        </h3>
                                        <p>Aktiviti</p>
                                    </div>
                                </li>

                                <li class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="mu-single-counter">
                                        <span>Delicious</span>
                                        <h3>
                                            <span class="counter-value" data-count="<?= $package_count ?>">0</span><sup>+</sup>
                                        </h3>
                                        <p>Pakej</p>
                                    </div>
                                </li>

                                <li class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="mu-single-counter">
                                        <span>Hot</span>
                                        <h3><span class="counter-value"
                                                  data-count="<?= $reservation_count ?>">0</span><sup>+</sup></h3>
                                        <p>Tempahan</p>
                                    </div>
                                </li>

                                <li class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="mu-single-counter">
                                        <span>Satisfied</span>
                                        <h3><span class="counter-value"
                                                  data-count="<?= $customer_count ?>">0</span><sup>+</sup></h3>
                                        <p>Pelanggan</p>
                                    </div>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Counter Section -->

<?php
