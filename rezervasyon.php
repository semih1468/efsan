<?php include 'headerust.php';
$etkinlikcek = $db->prepare('select * from etkinlikler where id=:id');
$etkinlikcek->execute(array('id' => $_GET['etkinlik_id']));
$etkinlik = $etkinlikcek->fetch(PDO::FETCH_ASSOC);
?>
    <title><?php echo $ayar['ayar_title'] ?></title>
    <meta name="Description" content="<?php echo $ayar['ayar_description'] ?>">

<?php include 'headeralt.php'; ?>
    <div id="reservation">
        <div class="container">

            <div class="masasecimihead"><?php echo $etkinlik['baslik'] ?> -
                <div class="kisisayisi"><?php echo $_GET['kisi_sayisi'] ?> KİŞİ <a href="kisisayisi/<?php echo seo($etkinlik['baslik'])?>/<?php echo  $etkinlik['id']?>">Değiştir</a>
                </div>
            </div>
            <div class="reservationwrapper">
                <?php
                $masalar = $db->query('select * from masalar');
                foreach ($masalar as $masa) { ?>
                    <div class="masa<?php echo $masa['id'] ?>  masabutton
<?php


                    if ($masa['kisi_sayisi_enaz'] > $_GET['kisi_sayisi']) {
                        echo 'reserved ';
                    }
                    if ($masa['kisi_sayisi'] < $_GET['kisi_sayisi']) {
                        echo 'reserved ';
                    }
                    $rezerveEdilmis=$db->prepare('select * from rezervasyonlar where masa=:masa and etkinlik_id=:etkinlik_id and durum=:durum');
                    $rezerveEdilmis->execute(array(
                            'masa' => $masa['masa_no'],
                            'etkinlik_id' => $_GET['etkinlik_id'],
                            'durum'=>1
                    ));
                    $sayisiRezerve = $rezerveEdilmis->rowCount();
                    if ($sayisiRezerve > 0) {
                        echo 'reserved ';
                    }
                    //    if ($masa['kisi_sayisi']<$_GET['kisi_sayisi']&&$masa['kisi_sayisi_enaz']>$_GET['kisi_sayisi']){
                    //        echo 'reserved';
                    //    }
                    ?>

" data-masaid="<?php echo $masa['id'] ?>" data-masakonum="<?php echo $masa['masa_konum'] ?>"
                         data-masano="<?php echo $masa['masa_no'] ?>">
                        <span><?php echo $masa['masa_no'] ?></span>
                        <?php
                        if ($masa['kisi_sayisi'] == 2) {
                            ?>

                            <img src="dist/assests/img/masa/ikili-green.webp"
                                 class="img-fluid ikilimasaimg" alt="">
                        <?php }
                        ?>
                        <?php
                        if ($masa['kisi_sayisi'] == 0) {
                            ?>

                            <img src="dist/assests/img/masa/ikili-green.webp"
                                 class="img-fluid ikilimasaimg" alt="">
                        <?php }
                        ?>

                        <?php
                        if ($masa['kisi_sayisi'] == 5) {
                            ?>

                            <img src="dist/assests/img/masa/dortlu-green.webp"
                                 class="img-fluid dortlumasaimg" alt="">
                        <?php }
                        ?>
                        <?php
                        if ($masa['kisi_sayisi'] == 9) {
                            ?>

                            <img src="dist/assests/img/masa/loca-green.webp"
                                 class="img-fluid locamasaimg" alt="">
                        <?php }
                        ?>
                    </div>
                <?php }
                ?>

                <img src="dist/assests/img/floorplan.webp" class="floorplan img-fluid" alt="">
            </div>
        </div>
    </div>


    <div class="rezervasyonformmodal">
        <div class="container">
            <form action="#" class="rezervasyonform">
                <div class="modalclosebutton"><i class="ri-close-line"></i></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="modalhead"><?php echo $etkinlik['baslik']?></div>
                        <div class="modaltableinfo">
                            <div class=""><?php echo $_GET['kisi_sayisi']?></div>
                            KİŞİ, MASA
                            <div class="modalmasano"></div>
                        </div>
                    </div>
                    <div class="col-md-5">

                        <div class="menuselection">
                            <select class="menuselect" name="#" id="">
                                <option value="-1">Seçiniz</option>
                            </select>
                            <div class="menudetail d-none">
                                <div class="menudetailhead">Menü İçeriği <span class="kisibasifiyat"></span></div>
                                <div class="menudetailcont">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex flex-column">
                        <input type="text" name="name" placeholder="Adınız Soyadınız">
                        <input type="text" name="phone" class="telinput" placeholder="Telefon Numaranız">
                        <input type="text" name="email" class="mailinput" placeholder="E-Posta Adresiniz">
                        <input type="hidden" name="kisisayisi" value="<?php echo $_GET['kisi_sayisi']?>" class="kisisayisimodalinput">
                        <input type="hidden" name="etkinlikid" value="<?php echo $_GET['etkinlik_id']?>" class="etkinlikid">
                        <input type="hidden" name="masano" value="" class="masano">
                        <input type="hidden" name="toplamfiyat" value="" class="toplamfiyatform">
                        <input type="hidden" name="kaporafiyat" value="" class="kaporafiyatform">
                        <input type="hidden" name="rezervasyon_onay" value="1">
                        <textarea rows="3" name="not" id=""
                                  placeholder="Notunuz varsa buraya yazabilirsiniz"></textarea>
                        <div class="inputdiv">
                            <span>Geliş Saati</span>
                            <input type="time" name="arrival">
                        </div>
                        <div class="checkboxgroup">
                            <input type="checkbox" name="rezervasyonsozlesmesi" id="rezervasyonsozlesmesi">
                            <div class="checklabel"><span data-type="rezervasyonsozlesmesi">Kullanıcı ve rezervasyon sözleşmesi</span>'ni
                                onaylıyorum.
                            </div>
                        </div>
                        <div class="checkboxgroup">
                            <input type="checkbox" name="kvkkformu" id="kvkkformu">
                            <div class="checklabel"><span data-type="kvkkmetni">KVKK Aydınlatma Metni</span>'ni okudum
                                ve onaylıyorum.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="rezervasyonsummary d-none">
                            <div class="toplamfiyat"></div>
                            <div class="kaporafiyat"></div>
                            <!--<div class="bankabilgileri">
                                <div class="aliciadi">İNCİM RESTAURANT TURİZM OTOMOTİV TİC.LTD.ŞTİ.</div>
                                <div class="ibanno">TR71 0004 6007 6288 8000 1868 69</div>
                            </div>-->
                            <button class="rezervasyonsubmit" type="button">Rezervasyonu Tamamla</button>
                            <p class="rezervasyonwarning">Saat 10'dan sonra gelirseniz rezervasyonunuz iptal olur</p>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="rezervasyonformmodalbg"></div>
    </div>

    <div class="sozlesmemodal rezervasyonsozlesmesi">
        <div class="container">
            <div class="sozlesmemodalclosebutton"><i class="ri-close-line"></i></div>

            <p><b>Rezervasyon Sözleşmesi:</b></p>
            <p>- Kapı Açılış Saati 20:00 / Konser : 22:00-22:30</p>
            <p>- Damsız Alım Yoktur.</p>
            <p>- 18 yaş altı alım yoktur</p>
            <p>- Yapılan Rezervasyonlarda:</p>
            <p>KONSERE 5 GÜN KALA YAPILAN İPTALLERDE KAPORANIN TAMAMI İADE EDİLİR.</p>
            <p>KONSERE 5 GÜNDEN AZ KALA YAPILAN İPTALLERDE KAPORANIN YARISI İADE EDİLİR..</p>
            <p>KONSERE 2 GÜNDEN AZ KALA YAPILAN İPTALLERDE KAPORA İADESİ YOKTUR.</p>
            <p>- Kapora ödemesini 24 saat içinde yapmadığınız taktirde rezervasyonunuz otomatik olarak iptal
                edilecektir.</p>
            <p>- Efşan Sahne etkinlik için uygun görmediği kişileri bilet ücretini iade etmek kaydı ile içeri almama
                hakkına sahiptir.</p>
            <p>- Efşan Sahne, öngörülmeyen ve kaçınılmaz nedenlerden ötürü programda her türlü değişiklik yapma hakkını
                saklı tutar.</p>
            <p>- Efşan Sahne, rezervasyon fiyatlarında değişiklik yapma hakkına sahiptir.</p>
            <p>- Efşan Sahne biletinizi ve/ veya bilekliğinizi saklayınız.</p>
            <p>- Efşan Sahne ye dışarıdan yiyecek ve içecek alınmamaktadır.</p>
            <p>- Efşan Sahne ye Selfie Stick ve GoPro çubukları ile girilmemektedir.</p>
            <p>- Efşan Sahne ye kesici ve delici olarak kullanılabilecek her türlü aletin sokulmasına izin
                verilmeyecektir.</p>
            <p>- Efşan Sahne olarak yanınızda bulunan eşyaların sorumluluğunun size ait olduğunu hatırlatmak
                isteriz.</p>
            <p>- Güvenlik personeli, Efşan Sahne ye giren herkesi güvenlik aramasına tabii tutacaktır.</p>
            <p>- Etkinlik rezervasyonları devredilemez.</p>
            <p>- Etkinliğe katılan kişilerin fotoğraf ve video çekimlerinin tanıtım materyallerinde kullanım hakkı Efşan
                Sahne ye ait olup katılımcı, etkinliğe katılarak bu hakkın kullanılmasını kabul etmektedir.</p>
            <button class="sozlesmebtn" data-sozlesmebtn="rezervasyonsozlesmesi">Okudum ve onaylıyorum</button>
        </div>
        <div class="sozlesmemodalbg"></div>
    </div>

    <div class="sozlesmemodal kvkkmetni">
        <div class="container">
            <div class="sozlesmemodalclosebutton"><i class="ri-close-line"></i></div>

            <p><b>Rezervasyon Formu Kişisel Verileri Koruma Kanunu Aydınlatma Metni</b></p>
            <p>a) Veri Sorumlusu 6698 sayılı Kişisel Verilerin Korunması Kanunu (“Kanun”) uyarınca, kişisel verileriniz;
                veri sorumlusu olarak Money Cafe Gıda San. Tic. A.ş (Bundan böyle “Efşan Sahne” olarak anılacaktır)
                tarafından aşağıda açıklanan kapsamda işlenebilecektir.</p>
            <p>b) Kişisel Verilerin Hangi Amaçla İşleneceği Efşan Sahne internet sitesi üzerinden Rezervasyon Formunu
                doldurmanız durumunda elde edilen kişisel verileriniz iletişim faaliyetlerinin yürütülmesi, müşteri
                ilişkileri süreçlerinin yürütülmesi, iletişim faaliyetlerinin yürütülmesi ve talep/şikâyetlerin takibi
                amaçları ile sınırlı ve bağlantılı olarak Efşan Sahne tarafından işlenmektedir.</p>
            <p>c) Kişisel Verileri Toplama Yöntemleri ve Hukuki Sebepleri Efşan Sahne internet sitesi üzerinden
                Rezervasyon Formunu doldurmanız durumunda elde edilen kişisel verileriniz; KVKK’nın 5. maddesinde
                belirtilen “İlgili kişinin temel hak ve özgürlüklerine zarar vermemek kaydıyla, veri sorumlusunun meşru
                menfaatleri için veri işlenmesinin zorunlu olması” hukuki sebebine dayanılarak elektronik ortamda
                otomatik olarak işlenmektedir.</p>
            <p>d) Veri Kategorileri ve Örnek Veri Türleri Kimlik Bilgileri; ad, soy ad İletişim Bilgileri; e-posta
                adresi, telefon numarası Diğer; mesaj içerisinde iletmiş olabileceğiniz başkaca kişisel verileriniz.</p>
            <p>e) İşlenen Kişisel Verilerin Kimlere ve Hangi Amaçla Aktarılabileceği Efşan Sahne internet sitesi
                üzerinden Rezervasyon Formunu doldurmanız durumunda elde edilen kişisel verilerinizden kimlik ve
                iletişim bilgileriniz ile paylaşma ihtimaliniz bulunan diğer bilgileriniz, Kanun’un 8. Maddesi uyarınca
                gerekli teknik ve idari tedbirler alınarak rezervasyon yaptırmak istediğiniz yurt içinde yerleşik iş
                ortaklarına aktarılmaktadır.</p>
            <p>h) Kişisel Veri Sahibi Olarak Kanun’un 11. Maddesinde Sayılan Haklarımız Kişisel verisi işlenen kişi
                olarak, Kanunun ilgili kişinin haklarını düzenleyen 11. maddesi kapsamındaki haklarınızı (kişisel veri
                işlemeyi öğrenme, işlemeyle ilgili bilgi talep etme, işlemenin amaca uygunluğunu öğrenme, aktarım
                yapılan kişileri bilme, eksik veya yanlış işlemelerin düzeltilmesini isteme, silme veya yok edilmesini
                isteme, otomatik tüm işlemlerin üçüncü kişilere bildirilmesini isteme, analize itiraz etme, zararın
                giderilmesini talep etme) Veri Sorumlusuna Başvuru Usul ve Esasları Hakkında Tebliğ’e göre kullanmak
                için Efşan Sahne’in Barış Mah. Sakarya Cad. No:1/1/Z1 Beylidüzü / İstanbul adresine yazılı olarak
                iletebilirsiniz veya daha önce tarafımıza bildirdiğiniz elektronik posta adresi üzerinden
                info@efsan.com.tr e-posta adresine e-mail yoluyla iletebilirsiniz.</p>
            <button class="sozlesmebtn" data-sozlesmebtn="kvkkformu">Okudum ve onaylıyorum</button>
        </div>
        <div class="sozlesmemodalbg"></div>
    </div>


    <input type="hidden" value="<?php echo $_GET['kisi_sayisi'] ?>" class="kisi-sayisi-input">
    <input type="hidden" value="<?php echo $_GET['etkinlik_id'] ?>" class="etkinlikid">
<?php
$sahneonu_menuler = $db->prepare('SELECT * FROM etkinlik_menu_fiyat WHERE etkinlik_id = :etkinlik_id and tip=:tip');
$sahneonu_menuler->execute(array(
    'etkinlik_id' => $_GET['etkinlik_id'],
    'tip' => 1,
));

// Menü listesini başlat
$menu_listesi_sahne_onu = [];

// Veritabanından gelen sonuçları diziye ekle
while ($menusahne_onu = $sahneonu_menuler->fetch(PDO::FETCH_ASSOC)) {
    $menu_bilgileri = $db->prepare('select * from menuler where id=:id');
    $menu_bilgileri->execute(array('id' => $menusahne_onu['menu_id']));
    $menu_bilgi = $menu_bilgileri->fetch(PDO::FETCH_ASSOC);
    $menu_listesi_sahne_onu[] = [
        "id" => $menusahne_onu['menu_id'], // Veritabanındaki 'id' alanını kullan
        "name" => $menu_bilgi['baslik'], // Veritabanındaki 'name' alanını kullan
        "value" => $menusahne_onu['fiyat'] // Veritabanındaki 'value' alanını kullan
    ];
}

$sahneonu_menulerjson = json_encode($menu_listesi_sahne_onu, JSON_UNESCAPED_UNICODE);
$ortamasalar_menuler = $db->prepare('SELECT * FROM etkinlik_menu_fiyat WHERE etkinlik_id = :etkinlik_id and tip=:tip');
$ortamasalar_menuler->execute(array(
    'etkinlik_id' => $_GET['etkinlik_id'],
    'tip' => 3,
));

// Menü listesini başlat
$menu_listesi_orta_masalar = [];

// Veritabanından gelen sonuçları diziye ekle
while ($menuorta_masalar = $ortamasalar_menuler->fetch(PDO::FETCH_ASSOC)) {
    $menu_bilgileri = $db->prepare('select * from menuler where id=:id');
    $menu_bilgileri->execute(array('id' => $menuorta_masalar['menu_id']));
    $menu_bilgi = $menu_bilgileri->fetch(PDO::FETCH_ASSOC);
    $menu_listesi_orta_masalar[] = [
        "id" => $menuorta_masalar['menu_id'], // Veritabanındaki 'id' alanını kullan
        "name" => $menu_bilgi['baslik'], // Veritabanındaki 'name' alanını kullan
        "value" => $menuorta_masalar['fiyat'] // Veritabanındaki 'value' alanını kullan
    ];
}

$ortamasalar_menulerjson = json_encode($menu_listesi_orta_masalar, JSON_UNESCAPED_UNICODE);
$arkamasalar_menuler = $db->prepare('SELECT * FROM etkinlik_menu_fiyat WHERE etkinlik_id = :etkinlik_id and tip=:tip');
$arkamasalar_menuler->execute(array(
    'etkinlik_id' => $_GET['etkinlik_id'],
    'tip' => 2,
));

// Menü listesini başlat
$menu_listesi_arka_masalar = [];

// Veritabanından gelen sonuçları diziye ekle
while ($menuarka_masalar = $arkamasalar_menuler->fetch(PDO::FETCH_ASSOC)) {
    $menu_bilgileri = $db->prepare('select * from menuler where id=:id');
    $menu_bilgileri->execute(array('id' => $menuarka_masalar['menu_id']));
    $menu_bilgi = $menu_bilgileri->fetch(PDO::FETCH_ASSOC);
    $menu_listesi_arka_masalar[] = [
        "id" => $menuarka_masalar['menu_id'], // Veritabanındaki 'id' alanını kullan
        "name" => $menu_bilgi['baslik'], // Veritabanındaki 'name' alanını kullan
        "value" => $menuarka_masalar['fiyat'] // Veritabanındaki 'value' alanını kullan
    ];
}

$arkamasalar_menulerjson = json_encode($menu_listesi_arka_masalar, JSON_UNESCAPED_UNICODE);

$loca_menuler = $db->prepare('SELECT * FROM etkinlik_menu_fiyat WHERE etkinlik_id = :etkinlik_id and tip=:tip');
$loca_menuler->execute(array(
    'etkinlik_id' => $_GET['etkinlik_id'],
    'tip' => 4,
));

// Menü listesini başlat
$menu_listesi_loca = [];

// Veritabanından gelen sonuçları diziye ekle
while ($menuloca = $loca_menuler->fetch(PDO::FETCH_ASSOC)) {
    $menu_bilgileri = $db->prepare('select * from menuler where id=:id');
    $menu_bilgileri->execute(array('id' => $menuloca['menu_id']));
    $menu_bilgi = $menu_bilgileri->fetch(PDO::FETCH_ASSOC);
    $menu_listesi_loca[] = [
        "id" => $menuloca['menu_id'], // Veritabanındaki 'id' alanını kullan
        "name" => $menu_bilgi['baslik'], // Veritabanındaki 'name' alanını kullan
        "value" => $menuloca['fiyat'] // Veritabanındaki 'value' alanını kullan
    ];
}

$local_menulerjson = json_encode($menu_listesi_loca, JSON_UNESCAPED_UNICODE);
?>
    <input type="hidden"
           value='<?php echo $sahneonu_menulerjson ?>'
           class="etkinlik_sahneonu-menu">
    <input type="hidden"
           value='<?php echo $ortamasalar_menulerjson ?>'
           class="etkinlik_ortamasalar-menu">
    <input type="hidden"
           value='<?php echo $arkamasalar_menulerjson ?>'
           class="etkinlik_arkamasalar-menu">
    <input type="hidden" value='<?php echo $local_menulerjson ?>' class="etkinlik_localar-menu">
<?php include 'footer.php'; ?>