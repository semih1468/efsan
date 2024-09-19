<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
$hakkimizda_id=1;
$hakkimizdacek=$db->prepare('select * from hakkimizda where hakkimizda_id=:id');
$hakkimizdacek->execute(array('id'=>$hakkimizda_id));
$hakkimizdabitir=$hakkimizdacek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Hakkimizda Düzenleme</h2><?php if ($_GET&&$_GET['ok']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  method="POST" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Resim
                            <br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  type="file" id="last-name" name="resim" accept="image/*" placeholder="Başlığı Yazınız"
                                   class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Hakkimizda Sayfa Başlık
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="hakkimizda_baslik" value="<?php echo $hakkimizdabitir['hakkimizda_baslik']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>


                    <div class="form-group" align="center">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Hakkimizda İçerik
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12" aling="center">
                        <textarea  name="hakkimizda_icerik" id="editor1" rows="15" cols="80">
<?php echo $hakkimizdabitir['hakkimizda_icerik']?>
                        </textarea>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="hakkimizda_guncelle" class="btn btn-primary">Güncelle</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('editor1',{
        filebrowserBrowseUrl:'ckeditor/fileman/index.html', // Öntanımlı Dosya Yöneticisi
        filebrowserImageBrowseUrl:'ckeditor/fileman/index.html?type=image', // Sadece Resim Dosyalarını Gösteren Dosya Yöneticisi
        removeDialogTabs: 'link:upload;image:upload' // Upload işlermlerini dosya Yöneticisi ile yapacağımız için upload butonlarını kaldırıyoruz
    });

</script>
<?php include 'footer.php';?>
