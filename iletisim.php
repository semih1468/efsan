<?php include 'headerust.php'; ?>
    <title><?php echo $ayar['ayar_title'] ?></title>
    <meta name="Description" content="<?php echo $ayar['ayar_description'] ?>">
<?php include 'headeralt.php'; ?>
    <section id="contactpage">
        <div class="container">
            <div class="sechead">İLETİŞİM</div>

            <form action="#" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <input name="name" required type="name" placeholder="Adınız">
                    </div>
                    <div class="col-md-6">
                        <input name="surname" required type="surname" placeholder="Soyadınız">
                    </div>
                    <div class="col-md-6">
                        <input name="email" required type="email" placeholder="E-Posta Adresiniz">
                    </div>
                    <div class="col-md-6">
                        <input name="tel" required type="tel" placeholder="Telefon Numaranız">
                    </div>
                    <div class="col-md-12">
                        <textarea name="note"  id="" rows="4" placeholder="Mesajınız"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button name="iletisimekle">GÖNDER</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php
if (isset($_POST['iletisimekle'])&&isset($_POST['name'])&&isset($_POST['surname'])&&isset($_POST['tel'])) {

    $ekle = $db->prepare('insert into iletisim set 
ad=:ad,
soyad=:soyad,
mail=:mail,
tel=:tel,
note=:note
');
    $ekle->execute(array(
        'ad' => $_POST['name'],
        'soyad' => $_POST['surname'],
        'mail' => $_POST['email'],
        'tel' => $_POST['tel'],
        'note' => $_POST['note']

    ));


}
?>
<?php include 'footer.php'; ?>