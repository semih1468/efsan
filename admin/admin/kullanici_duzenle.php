<?php include 'header.php'; include 'sidebar.php'; include 'ust.php'; include'baglan/baglan.php';
$kullanicicek=$db->prepare('select * from giris ');
$kullanicicek->execute();
$kullanici=$kullanicicek->fetch(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Admin Ayar</h2>
                <?php if ($_GET['duzenle']){ echo '<h2 style="color:green;" >&nbsp;Başarı ile Güncellenmiştir </h2>';}?>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="demo-form2" method="get" data-parsley-validate class="form-horizontal form-label-left" action="islem/islem.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Kullanıcı Adı:<br>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last-name" name="admin_adi" value="<?php echo $kullanici['admin_adi'];?>" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Şifre:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $kullanici['admin_sifre'];?>" type="text" name="admin_sifre">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" name="admin_duzenle" class="btn btn-success">Güncelle</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
