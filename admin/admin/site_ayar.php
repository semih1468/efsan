<?php include 'header.php'; include 'sidebar.php'; include 'ust.php'; include'baglan/baglan.php';
$ayarcek=$db->prepare('select * from ayar ');
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
                <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">İletişim Harita Resim</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input accept="image/*" id="middle-name" class="form-control col-md-7 col-xs-12" type="file" name="iletisim_resim">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="eski_logo" value="<?php echo $ayarbitir['ayar_logo'];?>">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Site Logo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input accept="image/*" id="middle-name" class="form-control col-md-7 col-xs-12" type="file" name="ayar_logo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Whatsapp Numarası<br><small>örnek:05000000000</small>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="ayar_wptel" value="<?php echo $ayarbitir['ayar_wptel'];?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Telefon Numarası</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarbitir['ayar_tel'];?>" type="text" name="ayar_tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Mail Adresi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarbitir['ayar_mail'];?>" type="email" name="ayar_mail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adresi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="form-control col-md-7 col-xs-12"  id="" cols="30" rows="10" name="ayar_adres"><?php echo $ayarbitir['ayar_adres'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Site Başılığı</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarbitir['ayar_title'];?>" type="text" name="ayar_title">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Site Açıklaması</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarbitir['ayar_description'];?>" type="text" name="ayar_description">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Facebook</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['ayar_face'];?>" type="text" name="ayar_face">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">İnstagram</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['ayar_ins'];?>" type="text" name="ayar_ins">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Youtube</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['ayar_youtube'];?>" type="text" name="ayar_youtube">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Twitter</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['ayar_twitter'];?>" type="text" name="ayar_twitter">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Linkedin</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['ayar_linkedin'];?>" type="text" name="ayar_linkedin">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Google Map</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="form-control col-md-7 col-xs-12" name="ayar_googlemaps" id="" cols="30" rows="10"><?php echo $ayarbitir['ayar_googlemaps'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">İletişim Bilgileri</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="form-control col-md-7 col-xs-12" name="ayar_googlesearch" id="" cols="30" rows="10"><?php echo $ayarbitir['ayar_googlesearch'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Özel JS Alanı(Google Search vb Gibi kısımlar için)</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="form-control col-md-7 col-xs-12" name="ozel_js" id="" cols="30" rows="10"><?php echo $ayarbitir['ozel_js'];?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Site URL si</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12"value="<?php echo $ayarbitir['ayar_site'];?>" type="text" name="ayar_site">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="ayar_guncelle" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
