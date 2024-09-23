<?php include'headerust.php';
$etkinlikcek = $db->prepare('select * from etkinlikler where id=:id');
$etkinlikcek->execute(array('id' => $_GET['etkinlik_id']));
$etkinlik = $etkinlikcek->fetch(PDO::FETCH_ASSOC);
ob_start();

?>
    <title><?php echo $ayar['ayar_title']?></title>
    <meta name="Description" content="<?php echo $ayar['ayar_description']?>">
<?php include'headeralt.php';?>
    <div id="kisisayisi">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img class="img-fluid" src="upload/etkinlik/<?php echo $etkinlik['etkinlik_resim']?>" alt="">
                </div>
                <div class="col-md-8 kisisayisicontcol">
                    <div class="etkinlikname"><?php echo $etkinlik['baslik']?></div>
                    <div class="kisisayisitext">Kaç kişilik rezervasyon yapacaksınız?</div>
                    <form id="myForm" action="" method="post">
                        <input type="hidden" name="etkinlik_id" value="<?php echo $etkinlik['id']?>">
                        <input name="kisi_sayisi" id="inputData" min="1" max="9" type="number" placeholder="Kişi Sayısı" class="masainput">
                        <button type="submit" class="masabulbtn">Masa Bul</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
if(isset($_POST['kisi_sayisi'])){

    header('location:rezervasyon/'.seo($etkinlik['baslik']).'/'.$_POST['etkinlik_id'].'/'.$_POST['kisi_sayisi']);
}
?>
<?php include'footer.php';?>