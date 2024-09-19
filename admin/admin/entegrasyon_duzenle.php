<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
$entegrasyonbul = $db->prepare('select * from entegrasyon where id=:id');
$entegrasyonbul->execute(array('id' => $_GET['entegrasyon_id']));
$entegrasyon = $entegrasyonbul->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Entegrasyon Sayfası</h2>
                <?php if ($_GET['duzenle']) {
                    echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';
                } ?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br/>
                <form method="post" data-parsley-validate class="form-horizontal form-label-left"
                      action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Kategori
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="ust_id" class="form-control col-md-7 col-xs-12">
                                <?php $kategoricek = $db->query('select * from entegrasyon_kategori', PDO::FETCH_ASSOC);
                                foreach ($kategoricek as $kategori) { ?>
                                    <option <?php echo ($kategori['id'] == $entegrasyon['ust_id']) ? 'selected' : ''; ?>
                                            value="<?php echo $kategori['id'] ?>"
                                            ><?php echo $kategori['baslik'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Entegrasyon
                            Resmi<br><small>Genişlik:225xYükseklik:110</small>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="entegrasyon_resim" placeholder="Başlığı Yazınız"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Entegrasyon Baslik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="entegrasyon_baslik"
                                   value="<?php echo $entegrasyon['baslik'] ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Entegrasyon sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="entegrasyon_sira"
                                   value="<?php echo $entegrasyon['sira'] ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <input type="hidden" name="entegrasyon_id" value="<?php echo $entegrasyon['id'] ?>">

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="entegrasyon_duzenle" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
