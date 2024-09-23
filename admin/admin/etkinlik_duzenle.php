<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';

$etkinlik_id = $_GET['etkinlik_id'];
$etkinlikcek = $db->prepare('select * from etkinlikler where  id=:id');
$etkinlikcek->execute(array('id' => $etkinlik_id));
$etkinlik = $etkinlikcek->fetch(PDO::FETCH_ASSOC);

?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Etkinlik Düzenle Sayfası</h2>
                <?php if ($_GET && $_GET['ok']) {
                    echo '<h2 style="color:green;" >&nbsp;Başarı ile Kaydedilmiştir. </h2>';
                } ?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br/>
                <form method="post" data-parsley-validate class="form-horizontal form-label-left"
                      action="islem/islem.php" enctype="multipart/form-data">
                    <input type="hidden" name="etkinlik_id" value="<?php echo $etkinlik_id ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="baslik"
                                   value="<?php echo $etkinlik['baslik'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">  Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sira"    value="<?php echo $etkinlik['sira'] ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Tarih
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="tarih"
                                   value="<?php echo $etkinlik['tarih'] ?>"
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
                            <input  type="file" id="last-name" name="etkinlik_resim"
                                   placeholder="Başlığı Yazınız"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">
                            Anasayfa Etkinlik Resmi<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="file" id="last-name" name="anasayfa_resim"
                                   placeholder="Başlığı Yazınız"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:black;" for="last-name"> Sahne Önü Menu Fiyat :
                        </label>
                    </div>
                    <?php
                    $menuler = $db->query("SELECT * FROM menuler order by id desc");

                    foreach ($menuler as $menu) {
                        $etkinlik_menuler = $db->prepare('select * from etkinlik_menu_fiyat where  
                                      menu_id=:menu_id AND 
                                      tip=:tip AND
                                      etkinlik_id=:etkinlik_id
                                      ');
                        $etkinlik_menuler->execute(array(
                            'menu_id' => $menu['id'],
                            'tip' => 1,
                            'etkinlik_id' => $etkinlik_id
                        ));
                        $etkinlik_menuler_active = $etkinlik_menuler->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                   for="last-name"><?php echo $menu['baslik'] ?>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="sahneonu_menu[<?php echo $menu['id'] ?>]"
                                       value="<?php echo $etkinlik_menuler_active['fiyat'] ?? 0; ?>"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="sahneonu_menu_active[<?php echo $menu['id'] ?>]"
                                        class="form-control col-md-7 col-xs-12">
                                    <option value="0" <?php echo !isset($etkinlik_menuler_active['fiyat']) ? 'selected' : ''; ?>>Pasif</option>
                                    <option value="1" <?php echo isset($etkinlik_menuler_active['fiyat']) ? 'selected' : ''; ?>>Aktif</option>
                                </select>
                            </div>
                        </div>

                    <?php }
                    ?>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:black;" for="last-name"> Orta Masalar Menu
                            Fiyat :
                        </label>
                    </div>
                    <?php
                    $menuler = $db->query("SELECT * FROM menuler order by id desc");

                    foreach ($menuler as $menu) {
                        $etkinlik_menuler = $db->prepare('select * from etkinlik_menu_fiyat where  
                                      menu_id=:menu_id AND 
                                      tip=:tip AND
                                      etkinlik_id=:etkinlik_id
                                      ');
                        $etkinlik_menuler->execute(array(
                            'menu_id' => $menu['id'],
                            'tip' => 2,
                            'etkinlik_id' => $etkinlik_id
                        ));
                        $etkinlik_menuler_active = $etkinlik_menuler->fetch(PDO::FETCH_ASSOC);

                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                   for="last-name"><?php echo $menu['baslik'] ?>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="ortamasalar_menu[<?php echo $menu['id'] ?>]"
                                       value="<?php echo $etkinlik_menuler_active['fiyat'] ?? 0; ?>"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="ortamasalar_menu_active[<?php echo $menu['id'] ?>]"
                                        class="form-control col-md-7 col-xs-12">
                                    <option value="0" <?php echo !isset($etkinlik_menuler_active['fiyat']) ? 'selected' : ''; ?>>Pasif</option>
                                    <option value="1" <?php echo isset($etkinlik_menuler_active['fiyat']) ? 'selected' : ''; ?>>Aktif</option>
                                </select>
                            </div>
                        </div>

                    <?php }
                    ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:black;" for="last-name"> Arka Masalar Menu
                            Fiyat :
                        </label>
                    </div>
                    <?php
                    $menuler = $db->query("SELECT * FROM menuler order by id desc");

                    foreach ($menuler as $menu) {
                        $etkinlik_menuler = $db->prepare('select * from etkinlik_menu_fiyat where  
                                      menu_id=:menu_id AND 
                                      tip=:tip AND
                                      etkinlik_id=:etkinlik_id
                                      ');
                        $etkinlik_menuler->execute(array(
                            'menu_id' => $menu['id'],
                            'tip' => 3,
                            'etkinlik_id' => $etkinlik_id
                        ));
                        $etkinlik_menuler_active = $etkinlik_menuler->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                   for="last-name"><?php echo $menu['baslik'] ?>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="arkamasalar_menu[<?php echo $menu['id'] ?>]"
                                       value="<?php echo $etkinlik_menuler_active['fiyat'] ?? 0; ?>"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="arkamasalar_menu_active[<?php echo $menu['id'] ?>]"
                                        class="form-control col-md-7 col-xs-12">
                                    <option value="0" <?php echo !isset($etkinlik_menuler_active['fiyat']) ? 'selected' : ''; ?>>Pasif</option>
                                    <option value="1" <?php echo isset($etkinlik_menuler_active['fiyat']) ? 'selected' : ''; ?>>Aktif</option>
                                </select>
                            </div>
                        </div>

                    <?php }
                    ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " style="color:black;" for="last-name"> Localar Menu Fiyat :
                        </label>
                    </div>
                    <?php
                    $menuler = $db->query("SELECT * FROM menuler order by id desc");

                    foreach ($menuler as $menu) {
                        $etkinlik_menuler = $db->prepare('select * from etkinlik_menu_fiyat where  
                                      menu_id=:menu_id AND 
                                      tip=:tip AND
                                      etkinlik_id=:etkinlik_id
                                      ');
                        $etkinlik_menuler->execute(array(
                            'menu_id' => $menu['id'],
                            'tip' => 4,
                            'etkinlik_id' => $etkinlik_id
                        ));
                        $etkinlik_menuler_active = $etkinlik_menuler->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                   for="last-name"><?php echo $menu['baslik'] ?>
                            </label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="localar_menu[<?php echo $menu['id'] ?>]"
                                       value="<?php echo $etkinlik_menuler_active['fiyat'] ?? 0; ?>"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="localar_menu[<?php echo $menu['id'] ?>]"
                                        class="form-control col-md-7 col-xs-12">
                                    <option value="0" <?php echo !isset($etkinlik_menuler_active['fiyat']) ? 'selected' : ''; ?>>Pasif</option>
                                    <option value="1" <?php echo isset($etkinlik_menuler_active['fiyat']) ? 'selected' : ''; ?>>Aktif</option>
                                </select>
                            </div>
                        </div>

                    <?php }
                    ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> İçerik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea name="aciklama" id="editor1" rows="15" cols="80">
<?php echo $etkinlik['aciklama'] ?>
                        </textarea>
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="etkinlik_duzenle" class="btn btn-success">Kaydet</button>
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