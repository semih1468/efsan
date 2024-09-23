<?php include'headerust.php';?>
<title><?php echo $ayar['ayar_title']?></title>
<meta name="Description" content="<?php echo $ayar['ayar_description']?>">
<?php include'headeralt.php';?>

<div id="gallery">

    <div class="container">
        <div class="sechead">GALERİ</div>

        <div class="row">
            <?php
            $resimler=$db->query("SELECT * FROM resim ORDER BY resim_id DESC");
            foreach ($resimler as $resim) { ?>

                <div class="col-md-3 mb-5">
                    <a href="upload/resim/<?php echo $resim['resim_baslik']?>" data-fancybox="galeri">
                        <img class="img-fluid" src="upload/resim/<?php echo $resim['resim_baslik']?>" alt="1">
                    </a>
                </div>

                <?php

            }
            ?>

        </div>
    </div>

</div>
<?php include'footer.php';?>
