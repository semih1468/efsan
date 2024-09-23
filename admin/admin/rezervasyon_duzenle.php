<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
$rezervasyon_id=$_GET['rezervasyon_id'];
$rezervasyonlar=$db->prepare('select * from rezervasyonlar where id=:id');
$rezervasyonlar->execute(array('id'=>$rezervasyon_id));
$rezervasyon=$rezervasyonlar->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ürün İçerik Sayfası</h2>
                <?php if ($_GET && $_GET['ok']) {
                    echo '<h2 style="color:green;" >&nbsp;Başarı ile Kaydedilmiştir. </h2>';
                } ?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br/>
                <form method="post" data-parsley-validate class="form-horizontal form-label-left"
                      action="islem/islem.php" enctype="multipart/form-data">
                    <input type="hidden" name="rezervasyon_id" value="<?php echo $_GET['rezervasyon_id'] ?>">
                    <input type="hidden" name="selfID" value="<?php echo $_GET['urunsss_id'] ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> İçerik
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea required name="aciklama" id="editor1" rows="15" cols="80">
<?php echo $rezervasyon['note'] ?>
                        </textarea>
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="rezervasyon_guncelle" class="btn btn-success">Güncelle</button>
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