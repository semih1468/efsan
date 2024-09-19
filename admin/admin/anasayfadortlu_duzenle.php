<?php include 'header.php';
include 'sidebar.php';
include 'ust.php';
$dortlu_id=$_GET['dortlu_id'];
$dortlucek=$db->prepare('select * from anasayfadortlu where id=:id');
$dortlucek->execute(array('id'=>$dortlu_id));
$dortlu=$dortlucek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Anasayfa 4 Resim Ekle</h2>
                <?php if ($_GET && $_GET['ok']) {
                    echo '<h2 style="color:green;" >&nbsp;
Saved with success. </h2>';
                } ?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br/>
                <form method="post" data-parsley-validate class="form-horizontal form-label-left"
                      action="islem/islem.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Resim
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="file" id="last-name" name="resim" placeholder="Başlığı Yazınız" accept="image/*"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <input type="hidden" name="anasayfadortlu_id" value="<?php echo $dortlu_id?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Hover Resim
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="file" id="last-name" name="hoverplay" placeholder="Başlığı Yazınız"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Resim Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="baslik" value="<?php echo $dortlu['baslik']?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sira"value="<?php echo $dortlu['sira']?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tıklanınca Açılacak
                            Ürün
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="urun_id" class="form-control col-md-7 col-xs-12">
                                <?php $urunler = $db->query('select * from urunlerimiz', PDO::FETCH_ASSOC);
                                foreach ($urunler as $urun) { ?>
                                    <option <?php if ($urun['id'] == $dortlu['urun_id']) echo 'selected'; ?> value="<?php echo $urun['id'] ?>"><?php echo $urun['baslik'] ?></option>
                                <?php } ?>


                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="anasayfadortlu_duzenle" class="btn btn-success">Kaydet</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
