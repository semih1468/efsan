<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Entegrasyon Kategori Sayfası</h2>
                <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Kaydedilmiştir. </h2>';}?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  method="post" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Baslik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="entegrasyonk_baslik"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="entegrasyonk_sira"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="entegrasyonk_ekle" class="btn btn-success">Kaydet</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
