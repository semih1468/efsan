<?php include 'headerust.php'; ?>
    <title><?php echo $ayar['ayar_title'] ?></title>
    <meta name="Description" content="<?php echo $ayar['ayar_description'] ?>">
<?php include 'headeralt.php'; ?>

    <section id="reservationpage">
        <div class="container">

            <div class="sechead">Etkinlikler</div>

            <div class="row">
                <?php
                $etkinlikler = $db->query('select * from etkinlikler order by sira asc ');
                foreach ($etkinlikler as $etkinlik) {
                    ?>

                    <div class="col-md-3">
                        <div class="etkinlikcard">
                            <a class="etkinlikcardimg"
                               href="rezervasyon/inci-mercan-konseri-17-eylul-sali/kisisayisi.html"><img
                                        src="upload/etkinlik/<?php echo $etkinlik['etkinlik_resim']?>"class="img-fluid"
                                        alt=""></a>
                            <a href="rezervasyon/inci-mercan-konseri-17-eylul-sali/kisisayisi.html"
                               class="etkinlikcardtitle"><?php echo $etkinlik['baslik']?></a>
                            <div class="etkinlikcarddate"><?php echo $etkinlik['tarih']?></div>
                        </div>
                    </div>


                <?php }
                ?>


            </div>
        </div>
    </section>
<?php include 'footer.php'; ?>