<?php  include 'header.php'; include'sidebar.php';include 'ustbar.php';
$ayarcek=$db->prepare('SELECT * from ayar');
$ayarcek->execute();
$ayarbitir=$ayarcek->fetch(PDO::FETCH_ASSOC);

?>
<!-- page content -->


<div class="right_col" role="main">


    <h4>AYARLARA HOŞGELDİNİZ</h4>
    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ayarlar Kısmını Doldurunuz </h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="demo-form2"  method="POST" action="islem/islem.php" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon Numaranız <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" id="telefon" name="telefon" required="required" value="<?php echo $ayarbitir['ayar_tel'] ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gsm Numaranız</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarbitir['ayar_gsm'] ?>" type="text" name="gsm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adresiniz<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea  id="middle-name" class="form-control col-md-7 col-xs-12"  required="required" type="text" name="adres"><?php echo $ayarbitir['ayar_adres'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">E-posta Adresiniz <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="eposta" required="required" value="<?php echo $ayarbitir['ayar_mail'] ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Facebook Adresiniz</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $ayarbitir['ayar_face'] ?>" name="face">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Twitter Adresiniz</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $ayarbitir['ayar_twitter'] ?>" name="twitter">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">İnstagram Adresiniz</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $ayarbitir['ayar_ins'] ?>" name="instagram">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Youtube Adresiniz</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $ayarbitir['ayar_youtube'] ?>" name="youtube">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Hafta İçi Çalışma Saati</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $ayarbitir['ayar_hici'] ?>" name="calismahici">
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Cumartesi Çalışma Saati</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $ayarbitir['ayar_cumartesi'] ?>" name="calismact">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Pazar Çalışma</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text"value="<?php echo $ayarbitir['ayar_pazar'] ?>" name="calismapz">
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Logo</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12 btn btn-primary" type="file"   name="logo">
                        </div>
                    </div>
                    <input type="hidden" name="ayar_logo" value="<?php echo $ayarbitir['ayar_logo']?>">
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Cancel</button>
                            <button type="submit" name="ayarkaydet" class="btn btn-success">Kaydet</button>
                        </div>
                    </div>

                </form>
                <div class="col-md-12"><h4>Çalışma Saatlerini:08:00-20:00 şeklinde yazınız.</h4></div>
            </div>
        </div>
    </div>
</div>

    <!-- /page content -->
</div>
<?php include 'footer.php';?>
