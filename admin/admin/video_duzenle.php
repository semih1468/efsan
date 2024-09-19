<?php include 'header.php'; include 'sidebar.php'; include 'ust.php';
$videocek=$db->prepare('select * from video where video_id=:id');
$videocek->execute(array('id'=>$_GET['video_id']));
$video=$videocek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Video Düzenle Sayfası</h2>
                <?php if ($_GET['duzenle']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir. </h2>';}?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  method="post" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Resim <br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" id="last-name" name="video_resim"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> URL
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="video_url" value="<?php echo $video['video_url']?>"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sıra
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input required type="text" id="last-name" name="sira" value="<?php echo $video['sira']?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <input type="hidden" name="video_id" value="<?php echo $video['video_id']?>">
                    <input type="hidden" name="eski_resim" value="<?php echo $video['video_resim']?>">

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="video_duzenle" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
