<?php
require_once 'database/connect.php';

$skip = false;

$select_package = 'select * from package;';
$select_activity = 'select * from activity;';

$activities = array();
$packages = array();
$services = array();

// get all activity row
$result = $conn->query($select_activity);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $activities[$row['id']] = $row;
    }
}

// get all package row
$result = $conn->query($select_package);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packages[$row['id']] = $row;
        $services[$row['id']] = [];
    }
}

foreach ($packages as $package) {
    $sql = 'select * from service where id_package=' . $package['id'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $services[$row['id_package']][] .= $row['id_activity'];
        }
    }
}

$conn->close();
?>

<section id="mu-restaurant-menu">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-restaurant-menu-area">

                    <div class="mu-title">
                        <span class="mu-subtitle">Terokaila</span>
                        <h2>Pakej Kami</h2>
                    </div>

                    <div class="mu-restaurant-menu-content">
                        <ul class="nav nav-tabs mu-restaurant-menu">
                            <?php foreach ($packages as $package): ?>
                                <li><a href="#<?= $package['id'] ?>"
                                       data-toggle="tab"><?= $package['name'] ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <?php foreach ($packages as $package): ?>
                                <div class="tab-pane fade in <?= $skip ? '' : 'active' ?>" id="<?= $package['id'] ?>">
                                    <?php $skip = true ?>
                                    <div class="mu-tab-content-area">
                                        <div>
                                            <h3>RM <?= $package['price'] ?> per pax, max <?= $package['maximum'] ?>
                                                person</h3>
                                            <br>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mu-tab-content-left">
                                                    <ul class="mu-menu-item-nav">
                                                        <?php for ($n = 0; $n < count($services[$package['id']]); $n += 2): ?>
                                                            <?php $activity = $activities[$services[$package['id']][$n]] ?>
                                                            <li>
                                                                <div class="media">
                                                                    <div class="media-left">
                                                                        <a href="#">
                                                                            <img class="media-object"
                                                                                 src="<?= $activity['image'] ?>"
                                                                                 alt="img">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h4 class="media-heading"><a
                                                                                    href="#"><?= $activity['label'] ?></a>
                                                                        </h4>
                                                                        <span class="mu-menu-price">@</span>
                                                                        <p><?= $activity['description'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endfor ?>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mu-tab-content-right">
                                                    <ul class="mu-menu-item-nav">
                                                        <?php for ($n = 1; $n < count($services[$package['id']]); $n += 2): ?>
                                                            <?php $activity = $activities[$services[$package['id']][$n]] ?>
                                                            <li>
                                                                <div class="media">
                                                                    <div class="media-left">
                                                                        <a href="#">
                                                                            <img class="media-object"
                                                                                 src="<?= $activity['image'] ?>"
                                                                                 alt="img">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h4 class="media-heading"><a
                                                                                    href="#"><?= $activity['label'] ?></a>
                                                                        </h4>
                                                                        <span class="mu-menu-price">@</span>
                                                                        <p><?= $activity['description'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endfor ?>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>