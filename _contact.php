<!-- Start Contact section -->
<section id="mu-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-contact-area">

                    <div class="mu-title">
                        <span class="mu-subtitle">Kekal Berhubung</span>
                        <h2>Hubungi Kami</h2>
                    </div>

                    <div class="mu-contact-content">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mu-contact-left">
                                    <!-- Email message div -->
                                    <div id="form-messages"></div>
                                    <!-- Start contact form -->
                                    <form id="ajax-contact" method="post" class="mu-contact-form" action="database/new_message.php">
                                        <div class="form-group">
                                            <label for="name">Nama anda</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject"
                                                   placeholder="Subject" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Mesej</label>
                                            <textarea class="form-control" id="message" name="message" cols="30"
                                                      rows="10" placeholder="Taip mesej anda" required></textarea>
                                        </div>
                                        <button type="submit" class="mu-send-btn">Hantar mesej</button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mu-contact-right">
                                    <div class="mu-contact-widget">
                                        <h3>Alamat Tempat</h3>
                                        <p>71770 Pantai, Negeri Sembilan, Malaysia</p>
                                        <address>
                                            <p><i class="fa fa-phone"></i> 019-668 2039</p>
                                            <p><i class="fa fa-envelope-o"></i> sitifaezahrasit97@gmail.com</p>
                                            <p><i class="fa fa-map-marker"></i> 71770 Pantai, Negeri Sembilan, Malaysia</p>
                                        </address>
                                    </div>
                                    <div class="mu-contact-widget">
                                        <h3>Waktu Operasi</h3>
                                        <address>
                                            <p><span>Isnin - Jumaat</span> untuk tempahan sahaja</p>
                                            <p><span>Sabtu - Ahad</span> 8.30 am to 6.00 pm</p>
                                        </address>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact section -->

<?php
