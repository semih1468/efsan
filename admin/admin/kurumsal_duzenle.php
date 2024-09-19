<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
$kurumsal_id=$_GET['kurumsal_id'];
$kurumsalcek=$db->prepare('select * from kurumsal where kurumsal_id=:id');
$kurumsalcek->execute(array('id'=>$kurumsal_id));
$kurumsalbitir=$kurumsalcek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Kurumsal Sayfalar</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Blog Sayfa Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="kurumsal_baslik" value="<?php echo $kurumsalbitir['kurumsal_baslik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <input type="hidden" name="kurumsal_id" value="<?php echo $kurumsal_id?>">
                    <input type="hidden" name="eski_resim" value="<?php echo $kurumsalbitir['kurumsal_resim']?>">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Blog Sayfa Resim <small>Resim seçilmezse eski resim geçerli olur</small>
                            <br><small>Genişlik:640xYükseklik:425</small>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="kurumsal_resim" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Blog Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="kurumsal_sira" value="<?php echo $kurumsalbitir['sira']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group" align="center">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Blog Sayfa İçerik
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12" aling="center">
                        <textarea  name="kurumsal_icerik" id="editor1" rows="15" cols="80">
<?php echo $kurumsalbitir['kurumsal_icerik']?>
                        </textarea>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="kurumsal_guncelle" class="btn btn-primary">Guncelle</button>
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
