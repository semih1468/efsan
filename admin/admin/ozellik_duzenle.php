<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
$ozellik_id=$_GET['ozellik_id'];
$ozellikcek=$db->prepare('select * from ozellik where  ozellik_id=:id');
$ozellikcek->execute(array('id'=>$ozellik_id));
$ozellikbitir=$ozellikcek->fetch(PDO::FETCH_ASSOC);

?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Özellik Düzenleme Sayfası</h2>
                <?php if ($_GET['duzenle']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Düzenlenmiştir. </h2>';}?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Özellik Sayfa Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="ozellik_baslik" value="<?php echo $ozellikbitir['ozellik_baslik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Özellik Sayfa Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="ozellik_sira" value="<?php echo $ozellikbitir['ozellik_sira']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Özellik Sayfa Resim<br><small>Genişlik:97xYükseklik:97</small>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="ozellik_resim"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>


                    <input type="hidden" name="ozellik_id" value="<?php echo $ozellik_id?>">

                    <div class="form-group" align="center">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Özellik Sayfa İçerik
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12" aling="center">
                        <textarea  name="ozellik_icerik" id="editor1" rows="15" cols="80">
<?php echo $ozellikbitir['ozellik_icerik']?>
                        </textarea>
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="ozellik_duzenle" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('editor1',{
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
</script>
<?php include 'footer.php';?>
