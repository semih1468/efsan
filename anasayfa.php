<section id="mainsection">
    <div class="owl-carousel owlmainsec">

        <?php
        $sliders = $db->query('select * from slider order by sira asc');

        foreach ($sliders as $slider) { ?>
            <div class="item ">
                <div class="container">

                    <?php
                    if (strlen($slider['slider_title']) > 0) { ?>
                        <div class="mainsectext animate__animated animate__fadeInDownBig"><?php echo $slider['slider_title'] ?></div>
                    <?php }
                    ?>
                    <?php
                    if (strlen($slider['slider_alt']) > 0) { ?>
                        <p class=" animate__animated animate__fadeIn"><?php echo $slider['slider_alt'] ?></p>
                    <?php }
                    ?>
                    <?php
                    if (strlen($slider['slider_button']) > 0) { ?>
                        <a class=" animate__animated animate__fadeInUpBig"
                           href="<?php echo $slider['slider_button_link'] ?>"><span><?php echo $slider['slider_button'] ?></span></a>
                        <a class="whatsapprez animate__animated animate__fadeInUpBig" target="_blank"
                           href="https://wa.me/+90<?php echo $ayar['ayar_wptel'] ?>?text=Merhaba%20rezervasyon%20yapmak%20istiyorum."><span>
                          <i class="ri-whatsapp-line"></i> WhatsApp Rezervasyon</span></a>
                    <?php }
                    ?>


                </div>
                <img src="upload/slider/<?php echo $slider['slider_resim'] ?>" alt="">
            </div>
        <?php }
        ?>


    </div>
    <a href="#nexteventssec" class="nextsectionbtn"><i class="ri-arrow-down-wide-line"></i></a>
</section>

<section id="nexteventssec">
    <div class="container">
        <div class="sechead">YAKLAŞAN ETKİNLİKLER</div>

        <div class="nexteventsdates">
            <?php
            $etkinlikler = $db->prepare("select * from etkinlikler order by sira asc limit 7");
            $etkinlikler->execute();
            foreach ($etkinlikler as $etkinlik) { ?>
                <div class="nexteventdatebtn "
                     data-image="upload/etkinlik/<?php echo $etkinlik['anasayfa_resim'] ?>"
                     data-date="<?php echo $etkinlik['tarih'] ?>" data-title="<?php echo $etkinlik['baslik'] ?>"
                     data-text=""
                     data-link="kisisayisi/<?php echo seo($etkinlik['baslik'])?>/<?php echo  $etkinlik['id']?>">
                    <?php
                    $tarih_bolunmus = explode(' ', $etkinlik['tarih']);
                    $birinci = $tarih_bolunmus[0] ?? '';
                    $ikinci = $tarih_bolunmus[1] ?? '';
                    ?>
                    <span><?php echo $birinci ?? ''; ?></span> <?php echo $ikinci ?? ''; ?>
                </div>
            <?php }
            ?>


        </div>
        <?php
        $etkinlikler2 = $db->prepare("SELECT * FROM etkinlikler ORDER BY sira ASC LIMIT 7");
        $etkinlikler2->execute();

        // İlk kayıt
        $ilk_etkinlik = $etkinlikler2->fetch(PDO::FETCH_ASSOC);

        ?>
        <div class="nexteventcont">
            <div class="row align-items-center">

                <div class="col-md-7">
                    <img src="upload/etkinlik/<?php echo $ilk_etkinlik['anasayfa_resim']?>" class="img-fluid nexteventimg"
                         alt="">
                </div>
                <div class="col-md-5">
                    <div class="nexteventname"><?php echo $ilk_etkinlik['baslik']?></div>
                    <div class="nexteventtext">
                    </div>
                    <div class="nexteventdate"><?php echo $ilk_etkinlik['tarih']?></div>
                    <a href="kisisayisi/<?php echo seo($ilk_etkinlik['baslik'])?>/<?php echo  $ilk_etkinlik['id']?>" class="rezervasyonbtn">REZERVASYON
                        YAP</a>
                </div>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</section>


<section id="partners">
    <div class="container-fluid">
        <div class="sechead">İŞ ORTAKLARIMIZ</div>
        <div class="owl-carousel owl-partners owl-theme">
            <?php
            $referanslar = $db->query("SELECT * FROM referans order by referans_sira asc");
            foreach ($referanslar as $referans) {
                ?>
                <div class="item">
                    <img src="upload/referans/<?php echo $referans['referans_resim'] ?>" class="img-fluid" alt="">
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>


<section id="eventgallery">
    <div class="container">
        <div class="sechead">ETKİNLİK GALERİSİ</div>
        <div class="owl-carousel owl-theme eventgalleryowl">
        </div>
    </div>
</section>

