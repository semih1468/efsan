<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
$basindabiz_id=$_GET['basindabiz_id'];
$basindacek=$db->prepare('select * from basindabiz where id=:id');
$basindacek->execute(array('id'=>$basindabiz_id));
$basinda=$basindacek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Basında Biz Düzenleme </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="baslik" value="<?php echo $basinda['baslik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <input type="hidden" name="basindabiz_id" value="<?php echo $basindabiz_id?>">
                    <input type="hidden" name="eski_resim" value="<?php echo $basinda['resim']?>">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Resim
                            <br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" accept="image/*" name="resim" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Blog Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="sira" value="<?php echo $basinda['sira']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group" align="center">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Blog Sayfa İçerik
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12" aling="center">
                        <textarea  name="icerik" id="editor1" rows="15" cols="80">
<?php echo $basinda['icerik']?>
                        </textarea>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="basindabiz_duzenle" class="btn btn-primary">Guncelle</button>
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
