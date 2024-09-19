<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
$hizmet_id=$_GET['hizmet_id'];
$hizmetcek=$db->prepare('select * from hizmet where hizmet_id=:id');
$hizmetcek->execute(array('id'=>$hizmet_id));
$hizmetbitir=$hizmetcek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Hizmet Sayfalar</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Hizmet Sayfa Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="hizmet_baslik" value="<?php echo $hizmetbitir['hizmet_baslik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Hizmet Sol Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="hizmet_title" value="<?php echo $hizmetbitir['hizmet_title']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Hizmet Sayfa Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="hizmet_unvan" value="<?php echo $hizmetbitir['hizmet_unvan']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <input type="hidden" name="hizmet_id" value="<?php echo $hizmet_id?>">
                    <input type="hidden" name="eski_resim" value="<?php echo $hizmetbitir['hizmet_resim']?>">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Hizmet Sayfa Resim<br> <small>Resim seçilmezse eski resim geçerli olur</small>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="hizmet_resim" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group" align="center">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Hizmet Sayfa İçerik
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12" aling="center">
                        <textarea  name="hizmet_icerik" id="editor1" rows="15" cols="80">
<?php echo $hizmetbitir['hizmet_icerik']?>
                        </textarea>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="hizmet_guncelle" class="btn btn-primary">Guncelle</button>
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
