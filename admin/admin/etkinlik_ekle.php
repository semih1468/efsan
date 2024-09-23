<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Etkinlik Ekleme Sayfası</h2>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">  Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="baslik"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">  Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sira"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">  Tarih
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="tarih"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                           Örn: 02 Ekim Salı
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                           Etkinlik Resmi<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="file" id="last-name" name="etkinlik_resim" placeholder="Başlığı Yazınız"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                           Anasayfa Etkinlik Resmi<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="file" id="last-name" name="anasayfa_resim" placeholder="Başlığı Yazınız"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:black;" for="last-name">  Sahne Önü Menu Fiyat :
                        </label>
                    </div>
                    <?php
                    $menuler=$db->query("SELECT * FROM menuler order by id desc");

                    foreach ($menuler as $menu) {?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"><?php echo $menu['baslik']?>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input  type="text" id="last-name" name="sahneonu_menu[<?php echo $menu['id']?>]" placeholder="Fiyat Yazınız"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="sahneonu_menu_active[<?php echo $menu['id']?>]" class="form-control col-md-7 col-xs-12">
                                    <option value="0" selected>Pasif</option>
                                    <option value="1" >Aktif</option>
                                </select>
                            </div>
                        </div>

                    <?php }
                    ?>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:black;" for="last-name">  Orta Masalar Menu Fiyat :
                        </label>
                    </div>
                    <?php
                    $menuler=$db->query("SELECT * FROM menuler order by id desc");

                    foreach ($menuler as $menu) {?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"><?php echo $menu['baslik']?>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input  type="text" id="last-name" name="ortamasalar_menu[<?php echo $menu['id']?>]" placeholder="Fiyat Yazınız"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="ortamasalar_menu_active[<?php echo $menu['id']?>]" class="form-control col-md-7 col-xs-12">
                                    <option value="0" selected>Pasif</option>
                                    <option value="1" >Aktif</option>
                                </select>
                            </div>
                        </div>

                    <?php }
                    ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:black;" for="last-name">  Arka Masalar Menu Fiyat :
                        </label>
                    </div>
                    <?php
                    $menuler=$db->query("SELECT * FROM menuler order by id desc");

                    foreach ($menuler as $menu) {?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"><?php echo $menu['baslik']?>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input  type="text" id="last-name" name="arkamasalar_menu[<?php echo $menu['id']?>]" placeholder="Fiyat Yazınız"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="arkamasalar_menu_active[<?php echo $menu['id']?>]" class="form-control col-md-7 col-xs-12">
                                    <option value="0" selected>Pasif</option>
                                    <option value="1" >Aktif</option>
                                </select>
                            </div>
                        </div>

                    <?php }
                    ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:black;" for="last-name">  Localar Menu Fiyat :
                        </label>
                    </div>
                    <?php
                    $menuler=$db->query("SELECT * FROM menuler order by id desc");

                    foreach ($menuler as $menu) {?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"><?php echo $menu['baslik']?>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input  type="text" id="last-name" name="localar_menu[<?php echo $menu['id']?>]" placeholder="Fiyat Yazınız"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="localar_menu[<?php echo $menu['id']?>]" class="form-control col-md-7 col-xs-12">
                                    <option value="0" selected>Pasif</option>
                                    <option value="1" >Aktif</option>
                                </select>
                            </div>
                        </div>

                    <?php }
                    ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> İçerik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea  name="aciklama" id="editor1" rows="15" cols="80">

                        </textarea>
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="etkinlik_ekle" class="btn btn-success">Kaydet</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script>
    CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
</script>