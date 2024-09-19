<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
$ozellikler=$db->prepare('select * from ozellikler where ozellik_id=:id');
$ozellikler->execute(array(
   'id'=>$_GET['program_ozellik_id']
));
$ozellik=$ozellikler->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Program Özellikleri Sayfalar</h2>
                <?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Kaydedilmiştir. </h2>';}?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Program Özellikleri Sayfa Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="program_ozellik_baslik" value="<?php echo $ozellik['ozellik_baslik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Program Özellikleri Sayfa Resim<br><small>Genişlik:640xYükseklik:425</small>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="program_ozellik_resim" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Program Özellikleri Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="program_ozellik_sira" value="<?php echo $ozellik['sira']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Program Özellikleri Boyut
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="program_ozellik_boyut" class="form-control col-md-7 col-xs-12">
                                <option value="6" <?php if ($ozellik['ozellik_boyut']==6){echo ' selected ';}?>>2 Li Yer Kaplasın</option>
                                <option value="4"  <?php if ($ozellik['ozellik_boyut']==4){echo ' selected ';}?>>3 Lü Yer Kaplasın</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" align="center">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Program Özellikleri Sayfa İçerik
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12" aling="center">
                        <textarea  name="program_ozellik_icerik" id="editor1" rows="15" cols="80">
<?php echo $ozellik['ozellik_icerik']?>
                        </textarea>
                        </div>
                    </div>

                    <input type="hidden" value="<?php echo $_GET['program_ozellik_id']?>" name="ozellik_id">
                    <input type="hidden" value="<?php echo $ozellik['ozellik_resim']?>" name="program_ozellik_resim">
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="program_ozellik_duzenle" class="btn btn-success">Kaydet</button>
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
