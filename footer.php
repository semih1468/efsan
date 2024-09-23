
<section id="footer">
    <model-viewer style="opacity: 0;" disable-zoom src="dist/assests/model/model_efsan.glb"
                  tone-mapping="aces" disable-pan disable-tap shadow-intensity="0" auto-rotate rotation-per-second=".4rad"
                  camera-orbit="-279.7deg 91.15deg 299.6m" field-of-view="30deg">
    </model-viewer>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-3">
                <a href="index.html" class="footerlogo"><img class="img-fluid" src="dist/assests/img/logowhite.webp" alt=""></a>
                <p class="footertext">Müşterilerimizin rahatlığı ve konforu için hazırlanmış mimari atmosferinde, canlı müzik, çılgın
                    partiler, konserler ve profesyonel ustalarımızın ürettiği eşsiz dünya mutfağında lezzetler
                    sunmaktayız</p>
            </div>
            <div class="col-md-3">
                <div class="sechead">İletişim Bilgileri</div>
                <ul class="contactlist">
                    <li><i class="ri-phone-line"></i><a href="tel: <?php echo $ayar['ayar_tel']?>"> <?php echo $ayar['ayar_tel']?></a></li>
                    <li><i class="ri-mail-send-line"></i><a href="mailto: <?php echo $ayar['ayar_mail']?>"> <?php echo $ayar['ayar_mail']?></a></li>
                    <li><i class="ri-time-line"></i> <span>Haftanın her günü 8:00-02:00</span></li>
                </ul>
            </div>
            <div class="col-md-3">
                <div class="sechead">Bizi Sosyal Medyada Takip Edin</div>
                <ul class="socialmedia">
                    <li> <a href="<?php echo $ayar['ayar_ins']?>" title="instagram" target="_blank"><i class="ri-instagram-fill"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<a target="_blank" href="https://wa.me/+90<?php echo $ayar['ayar_wptel']?>" class="whatsappbtn"><i class="ri-whatsapp-line"></i></a>

<input type="hidden" class="base_url" value="<?php echo $ayar['ayar_site']?>">
<script src="dist/assests/js/jquery.min.js"></script>
<script src="dist/assests/js/jquerymask.min.js"></script>
<script src="dist/assests/js/sweetalert.js"></script>
<script type="module" src="assest/model-viewer/3.4.0/model-viewer.min.js"></script>
<script src="assest/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assest/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="assest/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="dist/assests/js/particles.min.js"></script>
<script src="dist/assests/js/app.js"></script>


</body>
</html>