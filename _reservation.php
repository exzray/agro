<?php
$packages = array();

require 'database/connect.php';

$sql = "select * from package";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) array_push($packages, $row);
}

if ($conn->error) echo $conn->error;
?>

<section id="mu-reservation">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-reservation-area">

                    <div class="mu-title">
                        <span class="mu-subtitle">Membuat</span>
                        <h2>Tempahan</h2>
                    </div>

                    <div class="mu-reservation-content">
                        <p>Sila membuat tempahan sebelum datang untuk penyediaan tempat rekreasi dan makanan.</p>

                        <div class="col-md-6">
                            <div class="mu-reservation-left">
                                <form class="mu-reservation-form" id="id_form_reservation" method="post" action="database/new_reservation.php">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="id_name_reserve" type="text" class="form-control" placeholder="Full Name"
                                                       name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="id_email_reserve" type="email" class="form-control" placeholder="Email"
                                                       name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="id_contact_reserve" type="text" class="form-control" placeholder="Phone Number"
                                                       name="contact">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select id="id_people_reserve" class="form-control" name="people">
                                                    <option value="0">How Many?</option>
                                                    <option value="1">1 Person</option>
                                                    <option value="2">2 People</option>
                                                    <option value="3">3 People</option>
                                                    <option value="4">4 People</option>
                                                    <option value="5">5 People</option>
                                                    <option value="6">6 People</option>
                                                    <option value="7">7 People</option>
                                                    <option value="8">8 People</option>
                                                    <option value="9">9 People</option>
                                                    <option value="10">10 People</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select id="id_package_reserve" class="form-control" name="package">
                                                    <?php foreach ($packages as $package): ?>
                                                        <option value="<?= $package['id'] ?>"><?= $package['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="datepicker"
                                                       placeholder="Date" name="start">
                                            </div>
                                        </div>
                                        <button type="submit" class="mu-readmore-btn">Make Reservation</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-5 col-md-offset-1">
                            <div class="mu-reservation-right">
                                <div class="mu-opening-hour">
                                    <h2>Opening Hours</h2>
                                    <ul class="list-unstyled">
                                        <li>
                                            <p>Monday &amp; Tuesday</p>
                                            <p>9:00 AM - 4:00 PM</p>
                                        </li>
                                        <li>
                                            <p>Wednesday &amp; Thursday</p>
                                            <p>9:00 AM - Midnight</p>
                                        </li>
                                        <li>
                                            <p>Friday &amp; Saturday</p>
                                            <p>9:00 AM - Midnight</p>
                                        </li>
                                        <li>
                                            <p>Sunday</p>
                                            <p>9:00 AM - 11:00 PM</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
