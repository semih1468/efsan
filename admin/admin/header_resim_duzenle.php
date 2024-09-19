<?php include 'header.php'; include 'sidebar.php'; include 'ust.php'; include'baglan/baglan.php';
$header_resimcek=$db->prepare('select * from header_resim ');
$header_resimcek->execute();
$header=$header_resimcek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sabit Resimler</h2>
                <?php if ($_GET&&$_GET['duzenle']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir </h2>';}?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <h2 class="text-center">Entegrasyon Background</h2>
                <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Entegrasyonlar Resim</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="file" name="entegrasyon_resim" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Entegrasyonlar Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="entegrasyon_baslik" value="<?php echo $header['entegrasyon_baslik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Entegrasyonlar Açıklama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="entegrasyon_icerik" value="<?php echo $header['entegrasyon_icerik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="entegrasyon_header_guncelle" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="x_content">
                <br />
                <h2 class="text-center">Referans Background</h2>
                <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Referans Resim</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="file" name="referans_resim" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Referans Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="referans_baslik" value="<?php echo $header['referans_baslik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Referans Açıklama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="referans_icerik" value="<?php echo $header['referans_icerik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="referans_header_guncelle" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>

                </form>
                <div class="x_content">
                    <br />
                    <h2 class="text-center">Blog Background</h2>
                    <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Blog Resim</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="file" name="blog_resim" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Blog Başlık
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="blog_baslik" value="<?php echo $header['blog_baslik']?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Blog Açıklama
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="blog_icerik" value="<?php echo $header['blog_icerik']?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" name="blog_header_guncelle" class="btn btn-success">Güncelle</button>
                            </div>
                        </div>

                    </form>
            </div>
                <div class="x_content">
                    <br />
                    <h2 class="text-center">İletişim Background</h2>
                    <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">İletişim Resim</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="file" name="iletisim_resim" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">İletişim Başlık
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="iletisim_baslik" value="<?php echo $header['iletisim_baslik']?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">İletişim Açıklama
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="iletisim_icerik" value="<?php echo $header['iletisim_icerik']?>" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" name="iletisim_header_guncelle" class="btn btn-success">Güncelle</button>
                            </div>
                        </div>

                    </form>
                </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
