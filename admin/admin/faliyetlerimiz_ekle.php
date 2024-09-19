<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Faliyet Ekle Sayfası</h2>
                <?php if ($_GET && $_GET['ok']) {
                    echo '<h2 style="color:green;" >&nbsp;Başarı ile Kaydedilmiştir. </h2>';
                } ?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br/>
                <form method="post" data-parsley-validate class="form-horizontal form-label-left"
                      action="islem/islem.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                            Menü Icon<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="file" id="last-name" name="faliyet_icon" accept="image/*"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                            Video<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input   type="file" id="last-name" name="faliyet_video"  accept="video/*"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                            Yatay Resmi<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="file" id="last-name" name="faliyet_resim" placeholder="Başlığı Yazınız" accept="image/*"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Ana Ekranda Gözüksün
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="ana_ekran" class="form-control col-md-7 col-xs-12">
                                <option value="1">Gözüksün</option>
                                <option value="0">Gözükmesin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Menu Baslik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="faliyet_baslik"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sayfa Baslik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sayfa_baslik"

                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sayfa Açıklama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sayfa_aciklama"

                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="faliyet_sira"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="faliyet_ekle" class="btn btn-success">Kaydet</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
