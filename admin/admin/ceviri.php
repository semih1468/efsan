<?php include 'header.php'; include 'sidebar.php'; include 'ust.php'; include'baglan/baglan.php';
$ayarcek=$db->prepare('select * from cevir ');
$ayarcek->execute();
$ayarbitir=$ayarcek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Site Ayar</h2>
                <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir </h2>';}?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="demo-form2" method="get" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Slider Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="slider_baslik" value="<?php echo $ayarbitir['slider_baslik'];?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Slider İçerik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarbitir['slider_icerik'];?>" type="text" name="slider_icerik">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Telefon Slogan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="middle-name" class="form-control col-md-7 col-xs-12"  type="text" name="telefon_slogan"><?php echo $ayarbitir['telefon_slogan'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Masaya Sipariş Yazı </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['masaya_siparis'];?>" type="text" name="masaya_siparis">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Masaya Sipariş Sayı</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['masaya_sayi'];?>" type="text" name="masaya_sayi">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Stok Rapor Yazı</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['stok_rapor'];?>" type="text" name="stok_rapor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Stok Rapor Sayı</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['stok_sayi'];?>" type="text" name="stok_sayi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Paket Servisi Yazı</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['paket_servis'];?>" type="text" name="paket_servis">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Paket Servisi Sayı</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['paket_sayi'];?>" type="text" name="paket_sayi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adisyon Yazı</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['adisyon'];?>" type="text" name="adisyon">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adisyon Sayı</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['adisyon_sayi'];?>" type="text" name="adisyon_sayi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Sayılar Slogan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['sayilar_slogan'];?>" type="text" name="sayilar_slogan">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="ceviri_guncelle" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
