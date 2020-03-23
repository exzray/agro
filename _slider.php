<?php
$banners = array();

$sql = "select * from banner";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) array_push($banners, $row);
}

if ($conn->error) echo $conn->error;

?>
<?php if (!empty($banners)): ?>
    <section id="mu-slider">
        <div class="mu-slider-area">
            <div class="mu-top-slider">
                <?php foreach ($banners as $banner): ?>
                    <div class="mu-top-slider-single">
                        <img src="<?= $banner['image'] ?>" alt="img" style="height: 850px">
                        <div class="mu-top-slider-content">
                            <span class="mu-slider-small-title"><?= $banner['title'] ?></span>
                            <h2 class="mu-slider-title"><?= $banner['subtitle'] ?></h2>
                            <p><?= $banner['description'] ?></p>
                            <a href="#mu-reservation" class="mu-readmore-btn mu-reservation-btn">Membuat Tempahan</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>