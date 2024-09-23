<?php ob_start();
session_start();
include '../baglan/baglan.php';
include 'seo.php';
include 'resimseo.php';
include 'class.upload.php';

#giris
if (isset($_POST['giris'])) {
    function curl($response)
    {
        $fields = [
            'secret' => '6Lf5QtsUAAAAAE8CJcmaWP3GeoAtDcczS1pwvhQg',
            'response' => $response
        ];
        $user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt_array(
            $ch, [
                CURLOPT_POST => TRUE,
                CURLOPT_POSTFIELDS => http_build_query($fields),
                CURLOPT_RETURNTRANSFER => TRUE
            ]
        );

        $result = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
        header('location:../../index.php?dogrulama=no#k');
    } else {

        $result = curl($_POST['g-recaptcha-response']);

        if ($result['success'] == 1) {
            $girisyap = $db->prepare('select * from giris ');
            $girisyap->execute();
            $girisbitir = $girisyap->fetch(PDO::FETCH_ASSOC);
            $admin = $_POST['admin_adi'];
            $admin2 = $girisbitir['admin_adi'];

            $sifre = $_POST['admin_sifre'];
            $sifre2 = $girisbitir['admin_sifre'];

            if ($admin == $admin2) {
                if ($sifre2 == $sifre) {
                    $_SESSION['kadi'] = $girisbitir['admin_sifre'];
                    header('location:../index.php');
                } else {
                    header('location:../../index.php?sifre=no#k');
                }

            } else {
                header('location:../../index.php?sifre=no#s');
            }
        } else {

            echo 'Google Doğrulamada Sorun Var.';
        }

    }

}
echo $_SERVER['SERVER_NAME'];
if (!isset($_SESSION['kadi'])) {
    header('location:../index.php');
} else {
#ayarlar
    if (isset($_POST['ayar_guncelle'])) {
        $resimiletisim = new Upload($_FILES['iletisim_resim']);
        if ($resimiletisim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resimiletisim->allowed = array('image/*');
            $resimiletisim->image_convert = "webp";
            $resimiletisim->file_new_name_body = rseo('iletisim-' . $sayi . '-' . $_POST['ayar_title']);
            $resimiletisim->process('../../../upload/');
            $image = $resimiletisim->file_new_name_body = rseo('iletisim-' . $sayi . '-' . $_POST['ayar_title']);
            $ayarguncelle = $db->prepare('update ayar set
   iletisim_resim=:iletisim_resim

   ');
            $ayarguncelle->execute(array(
                'iletisim_resim' => $image . '.' . $resimiletisim->file_dst_name_ext,
            ));
        }
        $resim = new Upload($_FILES['ayar_logo']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo('logo-' . $sayi . '-' . $_POST['ayar_title']);
            $resim->process('../../../upload/');
            $image = $resim->file_new_name_body = rseo('logo-' . $sayi . '-' . $_POST['ayar_title']);
            $uzunluk = strlen($_FILES['ayar_logo']['name']);
            $uzanti = substr($_FILES['ayar_logo']['name'], -4, $uzunluk);
            $ayarguncelle = $db->prepare('update ayar set
   ayar_wptel=:wptel,
  ayar_wptell=:wptell,
   ayar_tel=:tel,
   ayar_tell=:tell,
   ayar_gsm=:gsm,
   ayar_mail=:mail,
   ayar_adres=:adres,
   ayar_title=:title,
   ayar_description=:des,
   ayar_keywords=:keywords,
   ayar_logo=:logo,
   ayar_googlemaps=:map,
   ayar_googlesearch=:search,
   ayar_googleanalytics=:analytics,
   ayar_ins=:ayar_ins,
   ayar_face=:ayar_face,
   ayar_youtube=:ayar_youtube,
   ayar_twitter=:ayar_twitter,
   ayar_linkedin=:ayar_linkedin,
   ozel_js=:ozel_js,
   ayar_site=:site
   ');
            $ayarguncelle->execute(array(
                'wptel' => $_POST['ayar_wptel'],
                'ayar_ins' => $_POST['ayar_ins'],
                'ayar_face' => $_POST['ayar_face'],
                'ayar_youtube' => $_POST['ayar_youtube'],
                'ayar_twitter' => $_POST['ayar_twitter'],
                'ayar_linkedin' => $_POST['ayar_linkedin'],
                'wptell' => $_POST['ayar_wptell'],
                'tel' => $_POST['ayar_tel'],
                'tell' => $_POST['ayar_tell'],
                'gsm' => $_POST['ayar_gsm'],
                'mail' => $_POST['ayar_mail'],
                'adres' => $_POST['ayar_adres'],
                'title' => $_POST['ayar_title'],
                'des' => $_POST['ayar_description'],
                'keywords' => $_POST['ayar_keywords'],
                'logo' => $image . '.' . $resim->file_dst_name_ext,
                'map' => $_POST['ayar_googlemaps'],
                'search' => $_POST['ayar_googlesearch'],
                'analytics' => $_POST['ayar_googleanalytics'],
                'ozel_js' => $_POST['ozel_js'],
                'site' => $_POST['ayar_site']
            ));
            if ($ayarguncelle) {
                header('location:../site_ayar.php?ok=ok');
            }
        } else {
            $ayarguncelle = $db->prepare('update ayar set
   ayar_wptel=:wptel,
   ayar_wptell=:wptell,
   ayar_tel=:tel,
   ayar_tell=:tell,
   ayar_gsm=:gsm,
   ayar_mail=:mail,
   ayar_adres=:adres,
   ayar_title=:title,
   ayar_description=:des,
   ayar_keywords=:keywords,
   ayar_googlemaps=:map,
   ayar_googlesearch=:search,
   ayar_googleanalytics=:analytics,
     ayar_ins=:ayar_ins,
   ayar_face=:ayar_face,
   ayar_youtube=:ayar_youtube,
   ayar_twitter=:ayar_twitter,
   ayar_linkedin=:ayar_linkedin,
   ozel_js=:ozel_js,
   ayar_site=:site
   ');
            $ayarguncelle->execute(array(
                'wptel' => $_POST['ayar_wptel'],
                'ayar_ins' => $_POST['ayar_ins'],
                'ayar_face' => $_POST['ayar_face'],
                'ayar_youtube' => $_POST['ayar_youtube'],
                'ayar_twitter' => $_POST['ayar_twitter'],
                'ayar_linkedin' => $_POST['ayar_linkedin'],
                'wptell' => $_POST['ayar_wptell'],
                'tel' => $_POST['ayar_tel'],
                'tell' => $_POST['ayar_tell'],
                'gsm' => $_POST['ayar_gsm'],
                'mail' => $_POST['ayar_mail'],
                'adres' => $_POST['ayar_adres'],
                'title' => $_POST['ayar_title'],
                'des' => $_POST['ayar_description'],
                'keywords' => $_POST['ayar_keywords'],
                'map' => $_POST['ayar_googlemaps'],
                'search' => $_POST['ayar_googlesearch'],
                'analytics' => $_POST['ayar_googleanalytics'],
                'ozel_js' => $_POST['ozel_js'],
                'site' => $_POST['ayar_site']
            ));
            if ($ayarguncelle) {
                header('location:../site_ayar.php?ok=ok');
            }
        }
    }

#kurumsal ekleme
    if (isset($_POST['kurumsal_ekle'])) {
        $resimboyut = $_FILES['kurumsal_resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            $resim = new Upload($_FILES['kurumsal_resim']);
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['kurumsal_baslik']);
            $resim->process('../../../upload/kurumsal');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['kurumsal_baslik']);
            $uzunluk = strlen($_FILES['hizmet_resim']['name']);
            $uzanti = '.jpg';
            date_default_timezone_set('Europe/Istanbul');
            $tarih = date('d.m.Y');
            $kurumsalekle = $db->prepare('insert into kurumsal set 
kurumsal_baslik=:baslik,
kurumsal_icerik=:icerik,
kurumsal_tarih=:tarih,
baslik_seo=:baslik_seo,

sira=:sira,
kurumsal_resim=:resim
');
            $kurumsalekle->execute(array(
                'baslik' => $_POST['kurumsal_baslik'],
                'icerik' => $_POST['kurumsal_icerik'],

                'sira' => $_POST['kurumsal_sira'],
                'baslik_seo' => seo($_POST['kurumsal_keywords']),
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'tarih' => $tarih
            ));
            if ($kurumsalekle) {
                header('location:../kurumsal_ekle.php?ok=ok');
            }
        } else {
            $kurumsalekle = $db->prepare('insert into kurumsal set 
kurumsal_baslik=:baslik,
baslik_seo=:baslik_seo,
sira=:sira,
kurumsal_icerik=:icerik

');
            $kurumsalekle->execute(array(
                'baslik' => $_POST['kurumsal_baslik'],
                'baslik_seo' => seo($_POST['kurumsal_keywords']),
                'sira' => $_POST['kurumsal_sira'],
                'icerik' => $_POST['kurumsal_icerik']
            ));
            if ($kurumsalekle) {
                header('location:../kurumsal_ekle.php?ok=ok');
            }
        }
    }
#kurumsal sil
    if (isset($_GET['kurumsal_sil'])) {
        $kurumsal_sil = $db->prepare('delete from kurumsal where kurumsal_id=:id');
        $kurumsal_sil->execute(array('id' => $_GET['kurumsal_id']));
        if ($kurumsal_sil) {
            header('location:../kurumsal_liste.php?sil=ok');
            unlink('../../../upload/kurumsal/' . $_GET['kurumsal_resim']);
        }
    }
#kurumsal düzenle
    if (isset($_POST['kurumsal_guncelle'])) {
        echo 'selam';
        $resimboyut = $_FILES['kurumsal_resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            $resim = new Upload($_FILES['kurumsal_resim']);
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['kurumsal_baslik']);
            $resim->process('../../../upload/kurumsal');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['kurumsal_baslik']);
            $uzunluk = strlen($_FILES['hizmet_resim']['name']);
            $uzanti = '.jpg';
            $kurumsalguncelle = $db->prepare('update kurumsal set 
kurumsal_baslik=:baslik,
kurumsal_icerik=:icerik,
kurumsal_keywords=:keywords,
kurumsal_description=:description,
baslik_seo=:baslik_seo,
kurumsal_reklam=:kurumsal_reklam,
sira=:sira,
kurumsal_resim=:resim
where kurumsal_id=:id
');
            $kurumsalguncelle->execute(array(
                'baslik' => $_POST['kurumsal_baslik'],
                'icerik' => $_POST['kurumsal_icerik'],
                'keywords' => $_POST['kurumsal_keywords'],
                'description' => $_POST['kurumsal_description'],
                'kurumsal_reklam' => $_POST['kurumsal_reklam'],
                'sira' => $_POST['kurumsal_sira'],
                'baslik_seo' => seo($_POST['kurumsal_keywords']),
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['kurumsal_id']
            ));
            if ($kurumsalguncelle) {
//                echo  rseo($resim);
                header('location:../kurumsal_duzenle.php?ok=ok&kurumsal_id=' . $_POST['kurumsal_id']);
                unlink('../../../upload/kurumsal/' . $_POST['eski_resim']);
            }

        } else {
            $kurumsalguncelle = $db->prepare('update kurumsal set 
kurumsal_baslik=:baslik,
kurumsal_keywords=:keywords,
kurumsal_description=:description,
baslik_seo=:baslik_seo,
kurumsal_reklam=:kurumsal_reklam,
sira=:sira,
kurumsal_icerik=:icerik
where kurumsal_id=:id
');
            $kurumsalguncelle->execute(array(
                'baslik' => $_POST['kurumsal_baslik'],
                'icerik' => $_POST['kurumsal_icerik'],
                'keywords' => $_POST['kurumsal_keywords'],
                'description' => $_POST['kurumsal_description'],
                'kurumsal_reklam' => $_POST['kurumsal_reklam'],
                'sira' => $_POST['kurumsal_sira'],
                'baslik_seo' => seo($_POST['kurumsal_keywords']),
                'id' => $_POST['kurumsal_id']
            ));
            if ($kurumsalguncelle) {
                header('location:../kurumsal_duzenle.php?ok=ok&kurumsal_id=' . $_POST['kurumsal_id']);

            }
        }
    }
    #entegrasyon kategori ekle
    if (isset($_POST['entegrasyonk_ekle'])) {

        $ekle = $db->prepare('insert into entegrasyon_kategori set 
baslik=:baslik,
sira=:sira
');
        $ekle->execute(array(
            'baslik' => $_POST['entegrasyonk_baslik'],
            'sira' => $_POST['entegrasyonk_sira'],

        ));
        if ($ekle) {
            header('location:../entegrasyonk_ekle.php?ok=ok');
        }


    }
    #entegrasyon kategori guncelle
    if (isset($_POST['entegrasyonk_duzenle'])) {
        $duzenle = $db->prepare('update entegrasyon_kategori set
    baslik=:baslik,
    sira=:sira
    where id=:id
    ');
        $duzenle->execute(array(
            'baslik' => $_POST['entegrasyonk_baslik'],
            'sira' => $_POST['entegrasyonk_sira'],
            'id' => $_POST['entegrasyonk_id']
        ));
        if ($duzenle) {
            header('location:../entegrasyonk_liste.php?ok=ok');
        }
    }
    #entegrasyon kategori sil
    if (isset($_GET['entegrasyonkategori_sil'])) {

        $hizmetsil = $db->prepare('delete from entegrasyon_kategori where id=:id');
        $hizmetsil->execute(array('id' => $_GET['entegrasyonk_id']));
        if ($hizmetsil) {
            header('location:../entegrasyonk_liste.php?sil=ok');
        }
    }
#hizmet ekle
    if (isset($_POST['hizmet_ekle'])) {
        $resim = new Upload($_FILES['hizmet_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['hizmet_baslik']);
            $resim->process('../../../upload/hizmet');
            #thumb
            $resim->allowed = array('image/*');
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_y = 374;
            $resim->image_x = 268;
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['hizmet_baslik']);
            $resim->process('../../../upload/hizmet/thumb');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['hizmet_baslik']);
            $uzunluk = strlen($_FILES['hizmet_resim']['name']);
            $uzanti = '.jpg';

            $hizmetekle = $db->prepare('insert into hizmet set 
hizmet_baslik=:baslik,
hizmet_icerik=:icerik,
hizmet_unvan=:unvan,
hizmet_resim=:resim,
hizmet_title=:title
');
            $hizmetekle->execute(array(
                'baslik' => $_POST['hizmet_baslik'],
                'icerik' => $_POST['hizmet_icerik'],
                'unvan' => $_POST['hizmet_unvan'],
                'title' => $_POST['hizmet_title'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($hizmetekle) {
                header('location:../hizmet_ekle.php?ok=ok');
            }

        } else {
            echo 'Bir Hata Oluştu';
        }
    }
#hizmet sil
    if (isset($_GET['hizmet_sil'])) {
        $eskiresim = $_GET['hizmet_resim'];
        echo $eskiresim;
        $hizmetsil = $db->prepare('delete from hizmet where hizmet_id=:id');
        $hizmetsil->execute(array('id' => $_GET['hizmet_id']));
        if ($hizmetsil) {
            unlink('../../../upload/hizmet/' . $eskiresim);
            header('location:../hizmet_liste.php?sil=ok');
        }
    }
#hizmet guncelle
    if (isset($_POST['hizmet_guncelle'])) {
        $resim = new Upload($_FILES['hizmet_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['hizmet_baslik']);
            $resim->process('../../../upload/hizmet');
            #thumb
            $resim->allowed = array('image/*');
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_y = 374;
            $resim->image_x = 268;
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['hizmet_baslik']);
            $resim->process('../../../upload/hizmet/thumb');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['hizmet_baslik']);
            $uzunluk = strlen($_FILES['hizmet_resim']['name']);
            $uzanti = '.jpg';
            $hizmetguncelle = $db->prepare('update hizmet set
    hizmet_baslik=:baslik,
    hizmet_icerik=:icerik,
    hizmet_unvan=:unvan,
    hizmet_resim=:resim
    hizmet_title=:title
    where hizmet_id=:id
    ');
            $hizmetguncelle->execute(array(
                'baslik' => $_POST['hizmet_baslik'],
                'icerik' => $_POST['hizmet_icerik'],
                'unvan' => $_POST['hizmet_unvan'],
                'title' => $_POST['hizmet_title'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['hizmet_id']
            ));
            if ($hizmetguncelle) {
                unlink('../../../upload/hizmet/' . $_POST['eski_resim']);
                header('location:../hizmet_liste.php?ok=ok');
            }
        } else {
            $hizmetguncelle = $db->prepare('update hizmet set
    hizmet_baslik=:baslik,
        hizmet_unvan=:unvan,
    hizmet_icerik=:icerik,
    hizmet_title=:title

    where hizmet_id=:id
    ');
            $hizmetguncelle->execute(array(
                'baslik' => $_POST['hizmet_baslik'],
                'icerik' => $_POST['hizmet_icerik'],
                'unvan' => $_POST['hizmet_unvan'],
                'title' => $_POST['hizmet_title'],
                'id' => $_POST['hizmet_id']
            ));
        }
        if ($hizmetguncelle) {
            header('location:../hizmet_liste.php?ok=ok');
        }
    }
#haber ekle
    if (isset($_POST['haber_ekle'])) {
        $resimboyut = $_FILES['haber_resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            echo $resimboyut;
            $update_dir = '../../../upload/haber';
            $tmp_name = $_FILES['haber_resim']["tmp_name"];
            $name = $_FILES['haber_resim']["name"];
            $benzersiz1 = rand(2500, 3000);
            $benzersiz2 = rand(2500, 3000);
            $benzersiz3 = rand(2500, 3000);
            $benzersiz4 = rand(2500, 3000);
            $benzersizad = $benzersiz1 . $benzersiz2 . $benzersiz3 . $benzersiz4;
            $resimyol = $update_dir . "/" . $benzersizad . $name;
            move_uploaded_file($tmp_name, "$update_dir/$benzersizad" . rseo($name) . "");
            $resim = $benzersizad . $name;
            $hizmetekle = $db->prepare('insert into haber set 
haber_baslik=:baslik,
haber_icerik=:icerik,
haber_keywords=:keywords,
haber_description=:description,
haber_resim=:resim
');
            $hizmetekle->execute(array(
                'baslik' => $_POST['haber_baslik'],
                'icerik' => $_POST['haber_icerik'],
                'keywords' => $_POST['haber_keywords'],
                'description' => $_POST['haber_description'],
                'resim' => rseo($resim)
            ));
            if ($hizmetekle) {
                header('location:../haber_ekle.php?ok=ok');
            }

        } else {
            $hizmetekle = $db->prepare('insert into haber set 
haber_baslik=:baslik,
haber_keywords=:keywords,
haber_description=:description,
haber_icerik=:icerik
');
            $hizmetekle->execute(array(
                'baslik' => $_POST['haber_baslik'],
                'keywords' => $_POST['haber_keywords'],
                'description' => $_POST['haber_description'],
                'icerik' => $_POST['haber_icerik']
            ));
            if ($hizmetekle) {
                header('location:../haber_ekle.php?ok=ok');
            }
        }
    }
#haber sil
    if (isset($_GET['haber_sil'])) {
        $eskiresim = $_GET['haber_resim'];
        echo $eskiresim;
        $habersil = $db->prepare('delete from haber where haber_id=:id');
        $habersil->execute(array('id' => $_GET['haber_id']));
        if ($habersil) {
            unlink('../../../upload/haber/' . $eskiresim);
            header('location:../haber_liste.php?sil=ok');
        }
    }
#haber guncelle
    if (isset($_POST['haber_guncelle'])) {
        $resimboyut = $_FILES['haber_resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            echo $resimboyut;
            $update_dir = '../../../upload/haber';
            $tmp_name = $_FILES['haber_resim']["tmp_name"];
            $name = $_FILES['haber_resim']["name"];
            $benzersiz1 = rand(2500, 3000);
            $benzersiz2 = rand(2500, 3000);
            $benzersiz3 = rand(2500, 3000);
            $benzersiz4 = rand(2500, 3000);
            $benzersizad = $benzersiz1 . $benzersiz2 . $benzersiz3 . $benzersiz4;
            $resimyol = $update_dir . "/" . $benzersizad . $name;
            move_uploaded_file($tmp_name, "$update_dir/$benzersizad" . rseo($name) . "");
            $resim = $benzersizad . $name;
            $haberguncelle = $db->prepare('update haber set
    haber_baslik=:baslik,
    haber_icerik=:icerik,
    haber_keywords=:keywords,
haber_description=:description,
    haber_resim=:resim
    where haber_id=:id
    ');
            $haberguncelle->execute(array(
                'baslik' => $_POST['haber_baslik'],
                'icerik' => $_POST['haber_icerik'],
                'keywords' => $_POST['haber_keywords'],
                'description' => $_POST['haber_description'],
                'resim' => rseo($resim),
                'id' => $_POST['haber_id']
            ));
            if ($haberguncelle) {
                unlink('../../../upload/haber/' . $_POST['eski_resim']);
                header('location:../haber_liste.php?ok=ok');
            }
        } else {
            $haberguncelle = $db->prepare('update haber set
    haber_baslik=:baslik,
    haber_keywords=:keywords,
haber_description=:description,
    haber_icerik=:icerik

    where haber_id=:id
    ');
            $haberguncelle->execute(array(
                'baslik' => $_POST['haber_baslik'],
                'icerik' => $_POST['haber_icerik'],
                'keywords' => $_POST['haber_keywords'],
                'description' => $_POST['haber_description'],
                'id' => $_POST['haber_id']
            ));
        }
        if ($haberguncelle) {
            header('location:../haber_liste.php?ok=ok');
        }
    }
#ekip ekle
    if (isset($_POST['ekip_ekle'])) {
        $resimboyut = $_FILES['ekip_resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            echo $resimboyut;
            $update_dir = '../../../upload/ekip';
            $tmp_name = $_FILES['ekip_resim']["tmp_name"];
            $name = $_FILES['ekip_resim']["name"];
            $benzersiz1 = rand(2500, 3000);
            $benzersiz2 = rand(2500, 3000);
            $benzersiz3 = rand(2500, 3000);
            $benzersiz4 = rand(2500, 3000);
            $benzersizad = $benzersiz1 . $benzersiz2 . $benzersiz3 . $benzersiz4;
            $resimyol = $update_dir . "/" . $benzersizad . $name;
            move_uploaded_file($tmp_name, "$update_dir/$benzersizad" . rseo($name) . "");
            $resim = $benzersizad . $name;
            $ekipekle = $db->prepare('insert into ekip set 
ekip_baslik=:baslik,
ekip_face=:face,
ekip_twitter=:twitter,
ekip_ins=:ins,
ekip_resim=:resim
');
            $ekipekle->execute(array(
                'baslik' => $_POST['ekip_baslik'],
                'face' => $_POST['ekip_face'],
                'twitter' => $_POST['ekip_twitter'],
                'ins' => $_POST['ekip_ins'],
                'resim' => rseo($resim)
            ));
            if ($ekipekle) {
                header('location:../ekip_ekle.php?ok=ok');
            }

        } else {
            $ekipekle = $db->prepare('insert into ekip set 
ekip_baslik=:baslik,
ekip_face=:face,
ekip_twitter=:twitter,
ekip_ins=:ins
');
            $ekipekle->execute(array(
                'baslik' => $_POST['ekip_baslik'],
                'face' => $_POST['ekip_face'],
                'twitter' => $_POST['ekip_twitter'],
                'ins' => $_POST['ekip_ins']
            ));
            if ($ekipekle) {
                header('location:../ekip_ekle.php?ok=ok');
            }
        }
    }
#ekip sil
    if (isset($_GET['ekip_sil'])) {
        $eskiresim = $_GET['ekip_resim'];
        echo $eskiresim;
        $ekipsil = $db->prepare('delete from ekip where ekip_id=:id');
        $ekipsil->execute(array('id' => $_GET['ekip_id']));
        if ($ekipsil) {
            unlink('../../../upload/ekip/' . $eskiresim);
            header('location:../ekip_liste.php?sil=ok');
        }
    }
#ekip Guncelle
    if (isset($_POST['ekip_guncelle'])) {
        $resimboyut = $_FILES['ekip_resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            echo $resimboyut;
            $update_dir = '../../../upload/ekip';
            $tmp_name = $_FILES['ekip_resim']["tmp_name"];
            $name = $_FILES['ekip_resim']["name"];
            $benzersiz1 = rand(2500, 3000);
            $benzersiz2 = rand(2500, 3000);
            $benzersiz3 = rand(2500, 3000);
            $benzersiz4 = rand(2500, 3000);
            $benzersizad = $benzersiz1 . $benzersiz2 . $benzersiz3 . $benzersiz4;
            $resimyol = $update_dir . "/" . $benzersizad . $name;
            move_uploaded_file($tmp_name, "$update_dir/$benzersizad" . rseo($name) . "");
            $resim = $benzersizad . $name;
            $ekipguncelle = $db->prepare('update ekip set
    ekip_baslik=:baslik,
    ekip_face=:face,
    ekip_twitter=:twitter,
    ekip_ins=:ins,
    ekip_resim=:resim
    where ekip_id=:id
    ');
            $ekipguncelle->execute(array(
                'baslik' => $_POST['ekip_baslik'],
                'face' => $_POST['ekip_face'],
                'twitter' => $_POST['ekip_twitter'],
                'ins' => $_POST['ekip_ins'],
                'resim' => rseo($resim),
                'id' => $_POST['ekip_id']
            ));
            if ($ekipguncelle) {
                unlink('../../../upload/ekip/' . $_POST['eski_resim']);
                header('location:../ekip_liste.php?ok=ok');
            }
        } else {
            $ekipguncelle = $db->prepare('update ekip set
    ekip_baslik=:baslik,
    ekip_face=:face,
    ekip_twitter=:twitter,
    ekip_ins=:ins
    where ekip_id=:id
    ');
            $ekipguncelle->execute(array(
                'baslik' => $_POST['ekip_baslik'],
                'face' => $_POST['ekip_face'],
                'twitter' => $_POST['ekip_twitter'],
                'ins' => $_POST['ekip_ins'],
                'id' => $_POST['ekip_id']
            ));
            if ($ekipguncelle) {
                header('location:../ekip_liste.php?ok=ok');
            }
        }

    }
#soru ekle
    if (isset($_GET['soru_ekle'])) {
        $soruekle = $db->prepare('insert into soru set 
soru_baslik=:baslik,
soru_icerik=:icerik
');
        $soruekle->execute(array(
            'baslik' => $_GET['soru_baslik'],
            'icerik' => $_GET['soru_icerik']
        ));
        if ($soruekle) {
            header('location:../soru_ekle.php?ok=ok');
        }
    }
#soru sil
    if (isset($_GET['soru_sil'])) {
        $sorusil = $db->prepare('delete from soru where soru_id=:id');
        $sorusil->execute(array('id' => $_GET['soru_id']));
        if ($sorusil) {
            header('location:../soru_liste.php?sil=ok');
        }
    }
#soru guncelle
    if (isset($_GET['soru_guncelle'])) {
        $soruguncelle = $db->prepare('update soru set
    soru_baslik=:baslik,
    soru_icerik=:icerik
    where soru_id=:id
    ');
        $soruguncelle->execute(array(
            'baslik' => $_GET['soru_baslik'],
            'icerik' => $_GET['soru_icerik'],
            'id' => $_GET['soru_id']
        ));
        if ($soruguncelle) {
            header('location:../soru_liste.php?ok=ok');
        }
    }
#resim kategori ekle
    if (isset($_GET['resimkategori_ekle'])) {
        echo 'selam';
        $kategoriekle = $db->prepare('insert into resim_kategori set 
resimkategori_baslik=:baslik,
resimkategori_seo=:seo
');
        $kategoriekle->execute(array(
            'baslik' => $_GET['resimkategori_baslik'],
            'seo' => seo($_GET['resimkategori_baslik'])
        ));
        if ($kategoriekle) {
            header('location:../resimk_ekle.php?ok=ok');
        }
    }
#resim kategori sil
    if (isset($_GET['kategori_sil'])) {
        $kategorisil = $db->prepare('delete from resim_kategori where resimkategori_id=:id');
        $kategorisil->execute(array('id' => $_GET['kategori_id']));
        if ($kategorisil) {
            header('location:../resimk_liste.php?ok=ok');
        }
    }
#resim kategori guncelle
    if (isset($_GET['kategori_guncelle'])) {
        $kategoriguncelle = $db->prepare('update resim_kategori set 
resimkategori_baslik=:baslik,
resimkategori_seo=:seo
where resimkategori_id=:id
');
        $kategoriguncelle->execute(array(
            'baslik' => $_GET['resimkategori_baslik'],
            'seo' => seo($_GET['resimkategori_baslik']),
            'id' => $_GET['resimkategori_id']

        ));
        if ($kategoriguncelle) {
            header('location:../resimk_liste.php?ok=ok');
        }
    }
#resim sil
    if (isset($_GET['resim_sil'])) {
        $resimsil = $db->prepare('delete from resim where resim_id=:id');
        $resimsil->execute(array('id' => $_GET['resim_id']));
        if ($resimsil) {
            unlink('../../../upload/resim/' . $_GET['resim_baslik']);
            header('location:../resim_liste.php');
        }
    }
#video ekle
    if (isset($_POST['video_ekle'])) {
        $resim = new Upload($_FILES['video_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $uniq = uniqid();
            $resim->file_new_name_body = $uniq;
            $resim->process('../../../upload/video');
            $image = $resim->file_new_name_body = $uniq;
            $videoekle = $db->prepare('insert into video set
    video_resim=:resim,
    sira=:sira,
    video_url=:url
   
    ');
            $videoekle->execute(array(
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'sira' => $_POST['sira'],
                'url' => $_POST['video_url']
            ));
            if ($videoekle) {
                header('location:../video_ekle.php?ok=ok');
            }
        }

    }
    #video ekle
    if (isset($_POST['video_duzenle'])) {
        $resim = new Upload($_FILES['video_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $uniq = uniqid();
            $resim->file_new_name_body = $uniq;
            $resim->process('../../../upload/video');
            $image = $resim->file_new_name_body = $uniq;
            $videoekle = $db->prepare('update video set
    video_resim=:resim,
    sira=:sira,
    video_url=:url
   where video_id=:id
    ');
            $videoekle->execute(array(
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'url' => $_POST['video_url'],
                'sira' => $_POST['sira'],
                'id' => $_POST['video_id'],
            ));
            if ($videoekle) {
                unlink('../../../upload/video/' . $_POST['eski_resim']);
                header('location:../video_liste.php?ok=ok');
            }
        } else {
            $videoekle = $db->prepare('update video set
    video_url=:url
    sira=:sira
   where video_id=:id
    ');
            $videoekle->execute(array(
                'url' => $_POST['video_url'],
                'sira' => $_POST['sira'],
                'id' => $_POST['video_id'],
            ));
            if ($videoekle) {
                header('location:../video_liste.php?ok=ok');
            }
        }

    }
#video sil
    if (isset($_GET['video_sil'])) {
        $videosil = $db->prepare('delete from video where video_id=:id');
        $videosil->execute(array('id' => $_GET['video_id']));
        if ($videosil) {
            unlink('../../../upload/video/' . $_GET['video_resim']);
            header('location:../video_liste.php?sil=ok');
        }
    }
#referans ekle
    if (isset($_POST['referans_ekle'])) {
        $resim = new Upload($_FILES['referans_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['referans_baslik']);
            $resim->process('../../../upload/referans');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['referans_baslik']);
            $uzunluk = strlen($_FILES['referans_resim']['name']);
            $uzanti = substr($_FILES['referans_resim']['name'], -4, $uzunluk);
            $referansekle = $db->prepare('insert into referans set 
referans_resim=:resim,
referans_sira=:sira

');
            $referansekle->execute(array(
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'sira' => $_POST['referans_sira']

            ));
            if ($referansekle) {

                header('location:../referans_ekle.php?ok=ok');
            }
        }

    }
#referans Duzenle
    if (isset($_POST['referans_duzenle'])) {
        $resim = new Upload($_FILES['referans_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['referans_baslik']);
            $resim->process('../../../upload/referans');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['referans_baslik']);
            $uzunluk = strlen($_FILES['referans_resim']['name']);
            $uzanti = substr($_FILES['referans_resim']['name'], -4, $uzunluk);
            $referansekle = $db->prepare('update referans set 
referans_resim=:resim,
referans_sira=:sira
where referans_id=:id

');
            $referansekle->execute(array(
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'sira' => $_POST['referans_sira'],

                'id' => $_POST['referans_id']

            ));
            if ($referansekle) {
                header('location:../referans_duzenle.php?ok=ok&referans_id=' . $_POST['referans_id']);
            }
        } else {
            $referansekle = $db->prepare('update referans set 

referans_sira=:sira
where referans_id=:id

');
            $referansekle->execute(array(
                'sira' => $_POST['referans_sira'],

                'id' => $_POST['referans_id']

            ));
            if ($referansekle) {
                header('location:../referans_duzenle.php?ok=ok&referans_id=' . $_POST['referans_id']);
            }
        }

    }
#referans sil
    if (isset($_GET['referans_sil'])) {
        $referanssil = $db->prepare('delete from referans where referans_id=:id');
        $referanssil->execute(array('id' => $_GET['referans_id']));
        if ($referanssil) {
            unlink('../../../upload/referans/' . $_GET['referans_resim']);
            header('location:../referans_liste.php?sil=ok');
        }
    }
#slider ekle
    if (isset($_POST['slider_ekle'])) {
        $resim = new Upload($_FILES['slider_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['slider_alt']);
            $resim->process('../../../upload/slider');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['slider_alt']);
            $uzunluk = strlen($_FILES['slider_resim']['name']);
            $uzanti = substr($_FILES['slider_resim']['name'], -4, $uzunluk);
            $sliderekle = $db->prepare('insert into slider set 
slider_resim=:resim,
slider_alt=:alt,
sira=:sira,
slider_button=:slider_button,
slider_button_link=:slider_button_link,
slider_title=:title
');
            $sliderekle->execute(array(
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'alt' => $_POST['slider_alt'],
                'slider_button' => $_POST['slider_button'],
                'slider_button_link' => $_POST['slider_button_link'],
                'sira' => $_POST['sira'],
                'title' => $_POST['slider_title']
            ));
            if ($sliderekle) {
                header('location:../slider_ekle.php?ok=ok');
            }
        }
    }
    #referans Duzenle
    if (isset($_POST['slider_duzenle'])) {
        $resim = new Upload($_FILES['slider_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['slider_alt']);
            $resim->process('../../../upload/slider');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['slider_alt']);
            $uzunluk = strlen($_FILES['slider_resim']['name']);
            $uzanti = substr($_FILES['slider_resim']['name'], -4, $uzunluk);
            $sliderekle = $db->prepare('update slider set 
slider_resim=:resim,
slider_alt=:alt,
sira=:sira,
slider_button=:slider_button,
slider_button_link=:slider_button_link,
slider_title=:title
where slider_id=:id
');
            $sliderekle->execute(array(
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'alt' => $_POST['slider_alt'],
                'slider_button' => $_POST['slider_button'],
                'slider_button_link' => $_POST['slider_button_link'],
                'title' => $_POST['slider_title'],
                'sira' => $_POST['sira'],
                'id' => $_POST['slider_id'],

            ));
            if ($sliderekle) {
                header('location:../slider_liste.php?ok=ok');
            }
        } else {
            $sliderekle = $db->prepare('update slider set 

slider_alt=:alt,
slider_title=:title,
slider_button=:slider_button,
slider_button_link=:slider_button_link,
sira=:sira
where slider_id=:id
');
            $sliderekle->execute(array(
                'slider_button' => $_POST['slider_button'],
                'slider_button_link' => $_POST['slider_button_link'],
                'alt' => $_POST['slider_alt'],
                'title' => $_POST['slider_title'],
                'id' => $_POST['slider_id'],
                'sira' => $_POST['sira'],

            ));
            if ($sliderekle) {
                header('location:../slider_liste.php?ok=ok');
            }
        }

    }
#slider sil
    if (isset($_GET['slider_sil'])) {
        $slidersil = $db->prepare('delete from slider where slider_id=:id');
        $slidersil->execute(array('id' => $_GET['slider_id']));
        if ($slidersil) {
            unlink('../../../upload/slider/' . $_GET['slider_resim']);
            header('location:../slider_liste.php?sil=ok');
        }
    }
#mesaj sil
    if (isset($_GET['mesaj_sil'])) {
        $mesajsil = $db->prepare('delete from mesaj where mesaj_id=:id');
        $mesajsil->execute(array('id' => $_GET['mesaj_id']));
        if ($mesajsil) {
            header('location:../mesaj_liste.php?sil=ok');
        }
    }
#giris
    if (isset($_POST['giris'])) {
        function curl($response)
        {
            $fields = [
                'secret' => '6Lf5QtsUAAAAAE8CJcmaWP3GeoAtDcczS1pwvhQg',
                'response' => $response
            ];
            $user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt_array(
                $ch, [
                    CURLOPT_POST => TRUE,
                    CURLOPT_POSTFIELDS => http_build_query($fields),
                    CURLOPT_RETURNTRANSFER => TRUE
                ]
            );

            $result = curl_exec($ch);
            echo curl_error($ch);
            curl_close($ch);

            return json_decode($result, true);
        }

        if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
            header('location:../../index.php?dogrulama=no#k');
        } else {

            $result = curl($_POST['g-recaptcha-response']);

            if ($result['success'] == 1) {
                $girisyap = $db->prepare('select * from giris ');
                $girisyap->execute();
                $girisbitir = $girisyap->fetch(PDO::FETCH_ASSOC);
                $admin = $_POST['admin_adi'];
                $admin2 = $girisbitir['admin_adi'];

                $sifre = $_POST['admin_sifre'];
                $sifre2 = $girisbitir['admin_sifre'];

                if ($admin == $admin2) {
                    if ($sifre2 == $sifre) {
                        $_SESSION['kadi'] = $girisbitir['admin_sifre'];
                        header('location:../index.php');
                    } else {
                        header('location:../../index.php?sifre=no#k');
                    }

                } else {
                    header('location:../../index.php?sifre=no#s');
                }
            } else {

                echo 'Google Doğrulamada Sorun Var.';
            }

        }

    }
#######yeni eklenen#####
#blog kategori ekle
    if (isset($_GET['blog_kategoriekle'])) {
        $kategoriekle = $db->prepare('insert into blog_kategori set 
blog_kategoribaslik=:baslik
');
        $kategoriekle->execute(array('baslik' => $_GET['blog_kategoribaslik']));
        if ($kategoriekle) {
            header('location:../blogkategori_ekle.php?ok=ok');
        }
    }
#blog kategori duzen
    if (isset($_GET['blog_kategoriguncelle'])) {
        $kategoriekle = $db->prepare('update blog_kategori set 
blog_kategoribaslik=:baslik
where blog_kategoriid=:id
');
        $kategoriekle->execute(array(
            'baslik' => $_GET['blog_kategoribaslik'],
            'id' => $_GET['kategori_id']
        ));
        if ($kategoriekle) {
            header('location:../blogkategori_liste.php?ok=ok');
        }
    }
#blog kategori sil
    if (isset($_GET['blog_kategorisil'])) {
        $sil = $db->prepare('delete from blog_kategori where blog_kategoriid=:id');
        $sil->execute(array('id' => $_GET['blog_kategoriid']));
        if ($sil) {
            header('location:../blogkategori_liste.php?sil=ok');
        }
    }
#blog ekle
    if (isset($_POST['blog_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_y = 500;
            $resim->image_x = 1170;
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['blog_baslik']);
            $resim->process('../../../upload/blog');
            #thumb
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_y = 420;
            $resim->image_x = 750;
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['blog_baslik']);
            $resim->process('../../../upload/blog/thumb');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['blog_baslik']);
            $uzunluk = strlen($_FILES['resim']['name']);
            $uzanti = substr($_FILES['resim']['name'], -4, $uzunluk);
            date_default_timezone_set('Europe/Istanbul');
            $tarih = date('d.m.Y H:i');
            $blogekle = $db->prepare('insert into blog set 
blog_baslik=:baslik,
blog_icerik=:icerik,
blog_keywords=:keywords,
blog_description=:description,
blog_tarih=:tarih,
resim=:resim,
blogust_id=:ust

');
            $blogekle->execute(array(
                'baslik' => $_POST['blog_baslik'],
                'icerik' => $_POST['blog_icerik'],
                'keywords' => $_POST['blog_keywords'],
                'tarih' => $tarih,
                'description' => $_POST['blog_description'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'ust' => $_POST['blogust_id']
            ));
            if ($blogekle) {
                header('location:../blog_ekle.php?ok=ok');
            }
        }
    }
#blog sil
    if (isset($_GET['blog_sil'])) {
        $sil = $db->prepare('delete from blog where blog_id=:id');
        $sil->execute(array('id' => $_GET['blog_id']));
        if ($sil) {
            unlink('../../../upload/blog/' . $_GET['blog_resim']);
            unlink('../../../upload/blog/thumb/' . $_GET['blog_resim']);
            header('location:../blog_liste.php?sil=ok');
        }
    }
#blog duzenle
    if (isset($_POST['blog_duzenle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_y = 500;
            $resim->image_x = 1170;
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['blog_baslik']);
            $resim->process('../../../upload/blog');
            #thumb
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_y = 420;
            $resim->image_x = 750;
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['blog_baslik']);
            $resim->process('../../../upload/blog/thumb');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['blog_baslik']);
            $uzunluk = strlen($_FILES['resim']['name']);
            $uzanti = substr($_FILES['resim']['name'], -4, $uzunluk);
            date_default_timezone_set('Europe/Istanbul');
            $tarih = date('d.m.Y H:i');
            $duzenle = $db->prepare('update blog set 
blog_baslik=:baslik,
blog_icerik=:icerik,
blog_keywords=:keywords,
blog_description=:description,
blog_tarih=:tarih,
resim=:resim,
blogust_id=:ust
where blog_id=:id

');
            $duzenle->execute(array(
                'baslik' => $_POST['blog_baslik'],
                'icerik' => $_POST['blog_icerik'],
                'keywords' => $_POST['blog_keywords'],
                'tarih' => $tarih,
                'description' => $_POST['blog_description'],
                'ust' => $_POST['blogust_id'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['blog_id']
            ));
            $eskiresim = $_POST['eski_resim'];
            if ($duzenle) {
                unlink('../../../upload/blog/' . $_POST['eski_resim']);
                unlink('../../../upload/blog/thumb/' . $_POST['eski_resim']);
                header('location:../blog_liste.php?ok=ok');
            }
        } else {
            date_default_timezone_set('Europe/Istanbul');
            $tarih = date('d.m.Y H:i');
            $duzenle = $db->prepare('update blog set 
blog_baslik=:baslik,
blog_icerik=:icerik,
blog_keywords=:keywords,
blog_tarih=:tarih,
blog_description=:description,
blogust_id=:ust
where blog_id=:id

');
            $duzenle->execute(array(
                'baslik' => $_POST['blog_baslik'],
                'icerik' => $_POST['blog_icerik'],
                'keywords' => $_POST['blog_keywords'],
                'tarih' => $tarih,
                'description' => $_POST['blog_description'],
                'ust' => $_POST['blogust_id'],

                'id' => $_POST['blog_id']
            ));

            if ($duzenle) {

                header('location:../blog_liste.php?ok=ok');
            }
        }
    }

#egitim ekle
    if (isset($_POST['egitim_ekle'])) {
        $ekle = $db->prepare('insert into egitim set 
egitim_baslik=:baslik,
egitim_icerik=:icerik,
egitim_keywords=:keywords,
egitim_description=:description


');
        $ekle->execute(array(
            'baslik' => $_POST['egitim_baslik'],
            'icerik' => $_POST['egitim_icerik'],
            'keywords' => $_POST['egitim_keywords'],
            'description' => $_POST['egitim_description']
        ));
        if ($ekle) {
            header('location:../egitim_ekle.php?ok=ok');
        }
    }
#egitim sil
    if (isset($_GET['egitim_sil'])) {
        $sil = $db->prepare('delete from egitim where egitim_id=:id');
        $sil->execute(array('id' => $_GET['egitim_id']));
        if ($sil) {
            header('location:../egitim_liste.php?sil=ok');
        }
    }
#egitim duzenle
    if (isset($_POST['egitim_duzenle'])) {
        $duzenle = $db->prepare('update egitim set 
egitim_baslik=:baslik,
egitim_icerik=:icerik,
egitim_keywords=:keywords,
egitim_description=:description

where egitim_id=:id
');
        $duzenle->execute(array(
            'baslik' => $_POST['egitim_baslik'],
            'icerik' => $_POST['egitim_icerik'],
            'keywords' => $_POST['egitim_keywords'],
            'description' => $_POST['egitim_description'],
            'id' => $_POST['egitim_id']
        ));
        if ($duzenle) {
            header('location:../egitim_liste.php?ok=ok');
        }
    }
#destek kategori ekle
    if (isset($_GET['destek_kategoriekle'])) {
        $ekle = $db->prepare('insert into destek_kategori set 
baslik=:baslik
');
        $ekle->execute(array('baslik' => $_GET['baslik']));
        if ($ekle) {
            header('location:../destekkategori_ekle.php?ok=ok');
        }
    }
#destek kategori sil
    if (isset($_GET['destek_kategorisil'])) {
        $sil = $db->prepare('delete from destek_kategori where kategori_id=:id');
        $sil->execute(array('id' => $_GET['destek_kategoriid']));
        if ($sil) {
            header('location:../destekkategori_liste.php?sil=ok');
        }
    }
#destek kategori duzenle
    if (isset($_GET['destek_kategoriguncelle'])) {
        $duzenle = $db->prepare('update destek_kategori set 
baslik=:baslik where kategori_id=:id
');
        $duzenle->execute(array('baslik' => $_GET['baslik'], 'id' => $_GET['kategori_id']));
        if ($duzenle) {
            header('location:../destekkategori_liste.php?ok=ok');
        }
    }
#destek ekle
    if (isset($_POST['destek_ekle'])) {
        $resimboyut = $_FILES['dosya']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            echo $resimboyut;
            $update_dir = '../../../upload/dosya';
            $tmp_name = $_FILES['dosya']["tmp_name"];
            $name = $_FILES['dosya']["name"];
            $benzersiz1 = rand(2500, 3000);
            $benzersiz2 = rand(2500, 3000);
            $benzersiz3 = rand(2500, 3000);
            $benzersiz4 = rand(2500, 3000);
            $benzersizad = $benzersiz1 . $benzersiz2 . $benzersiz3 . $benzersiz4;
            $resimyol = $update_dir . "/" . $benzersizad . $name;
            move_uploaded_file($tmp_name, "$update_dir/$benzersizad" . rseo($name) . "");
            $dosya = $benzersizad . $name;
            $ekle = $db->prepare('insert into destek set 
baslik=:baslik,
ust_id=:ust_id,
dosya=:dosya

');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'ust_id' => $_POST['ust_id'],
                'dosya' => rseo($dosya)
            ));
            if ($ekle) {
                header('location:../destek_ekle.php?ok=ok');
            }
        } else {
            $ekle = $db->prepare('insert into destek set 
baslik=:baslik,
link=:link,
ust_id=:ust_id

');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'link' => $_POST['link'],
                'ust_id' => $_POST['ust_id']
            ));
            if ($ekle) {
                header('location:../destek_ekle.php?ok=ok');
            }
        }
    }
#destek sil
    if (isset($_GET['destek_sil'])) {
        $sil = $db->prepare('delete from destek where id=:id');
        $sil->execute(array('id' => $_GET['destek_id']));
        if ($sil) {
            unlink('../../../upload/dosya/' . $_GET['destek_dosya']);
            header('location:../destek_liste.php?sil=ok');
        }
    }
#hakkımızda güncelle
    if (isset($_POST['hakkimizda_guncelle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/hakkimizda');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $hakkimizdaguncelle = $db->prepare('update hakkimizda set
    hakkimizda_baslik=:baslik,
    hakkimizda_icerik=:icerik,
    resim=:resim
    ');
            $hakkimizdaguncelle->execute(array(
                'baslik' => $_POST['hakkimizda_baslik'],

                'icerik' => $_POST['hakkimizda_icerik'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($hakkimizdaguncelle) {
                header('location:../hakkimizda_duzenle.php?ok=ok');
            }
        } else {
            $hakkimizdaguncelle = $db->prepare('update hakkimizda set
    hakkimizda_baslik=:baslik,
    hakkimizda_icerik=:icerik,
    resim=:resim
    ');
            $hakkimizdaguncelle->execute(array(
                'baslik' => $_POST['hakkimizda_baslik'],

                'icerik' => $_POST['hakkimizda_icerik'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($hakkimizdaguncelle) {
                header('location:../hakkimizda_duzenle.php?ok=ok');
            }
        }
    }
#Destek hatti güncelle
    if (isset($_GET['destekhatti_guncelle'])) {
        $duzenle = $db->prepare('update destek_hatti set
    baslik=:baslik,
    description=:description,
    keywords=:keywords,
    icerik=:icerik
    ');
        $duzenle->execute(array(
            'baslik' => $_GET['baslik'],
            'description' => $_GET['description'],
            'keywords' => $_GET['keywords'],
            'icerik' => $_GET['icerik']
        ));
        if ($duzenle) {
            header('location:../destekhatti_duzenle.php?ok=ok');
        }
    }
#urun kategori ekle
    if (isset($_POST['urun_kategoriekle'])) {
        echo 'semih';
        $resimboyut = $_FILES['resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {

            echo $resimboyut;
            $update_dir = '../../../upload/kategori';
            $tmp_name = $_FILES['resim']["tmp_name"];
            $name = $_FILES['resim']["name"];
            $benzersiz1 = rand(2500, 3000);
            $benzersiz2 = rand(2500, 3000);
            $benzersiz3 = rand(2500, 3000);
            $benzersiz4 = rand(2500, 3000);
            $benzersizad = $benzersiz1 . $benzersiz2 . $benzersiz3 . $benzersiz4;
            $resimyol = $update_dir . "/" . $benzersizad . $name;
            move_uploaded_file($tmp_name, "$update_dir/$benzersizad" . rseo($name) . "");
            $resim = $benzersizad . $name;

            $kategoriekle = $db->prepare('insert into urun_kategori set 
baslik=:baslik,
alt_kategori=:alt_kategori,
seo=:seo,
title=:title,
keywords=:keywords,
description=:description,
aciklama=:aciklama,
sira=:sira,
reklam=:reklam,
resim=:resim
');
            $kategoriekle->execute(array(
                'baslik' => $_POST['baslik'],
                'alt_kategori' => $_POST['alt_kategori'],
                'title' => $_POST['title'],
                'keywords' => $_POST['keywords'],
                'description' => $_POST['description'],
                'aciklama' => $_POST['aciklama'],
                'sira' => $_POST['sira'],
                'reklam' => $_POST['reklam'],
                'seo' => seo($_POST['baslik']),
                'resim' => rseo($resim)


            ));
            if ($kategoriekle) {
                header('location:../urunkategori_ekle.php?ok=ok');
            }
        } else {
            $kategoriekle = $db->prepare('insert into urun_kategori set 
baslik=:baslik,
alt_kategori=:alt_kategori,
seo=:seo,
title=:title,
keywords=:keywords,
description=:description,
aciklama=:aciklama,
sira=:sira,
reklam=:reklam

');
            $kategoriekle->execute(array(
                'baslik' => $_POST['baslik'],
                'alt_kategori' => $_POST['alt_kategori'],
                'title' => $_POST['title'],
                'keywords' => $_POST['keywords'],
                'description' => $_POST['description'],
                'aciklama' => $_POST['aciklama'],
                'sira' => $_POST['sira'],
                'reklam' => $_POST['reklam'],
                'seo' => seo($_POST['baslik'])


            ));
            if ($kategoriekle) {
                header('location:../urunkategori_ekle.php?ok=ok');
            }
        }
    }
#urun kategori sil
    if (isset($_GET['urun_kategorisil'])) {
        $sil = $db->prepare('delete from urun_kategori where id=:id');
        $sil->execute(array('id' => $_GET['urun_kategoriid']));
        if ($sil) {
            header('location:../urunkategori_liste.php?sil=ok');
        }
    }
#urun kategori duzenle

    if (isset($_POST['urun_kategoriduzenle'])) {
        echo 'semih';
        $resimboyut = $_FILES['resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {

            echo $resimboyut;
            $update_dir = '../../../upload/kategori';
            $tmp_name = $_FILES['resim']["tmp_name"];
            $name = $_FILES['resim']["name"];
            $benzersiz1 = rand(2500, 3000);
            $benzersiz2 = rand(2500, 3000);
            $benzersiz3 = rand(2500, 3000);
            $benzersiz4 = rand(2500, 3000);
            $benzersizad = $benzersiz1 . $benzersiz2 . $benzersiz3 . $benzersiz4;
            $resimyol = $update_dir . "/" . $benzersizad . $name;
            move_uploaded_file($tmp_name, "$update_dir/$benzersizad" . rseo($name) . "");
            $resim = $benzersizad . $name;

            $kategoriekle = $db->prepare('update urun_kategori set 
baslik=:baslik,
alt_kategori=:alt_kategori,
seo=:seo,
title=:title,
keywords=:keywords,
description=:description,
aciklama=:aciklama,
sira=:sira,
reklam=:reklam,
resim=:resim
where id=:id
');
            $kategoriekle->execute(array(
                'baslik' => $_POST['baslik'],
                'alt_kategori' => $_POST['alt_kategori'],
                'title' => $_POST['title'],
                'keywords' => $_POST['keywords'],
                'description' => $_POST['description'],
                'aciklama' => $_POST['aciklama'],
                'sira' => $_POST['sira'],
                'reklam' => $_POST['reklam'],
                'id' => $_POST['id'],
                'seo' => seo($_POST['baslik']),
                'resim' => rseo($resim)


            ));
            if ($kategoriekle) {
                header('location:../urunkategori_liste.php?ok=ok');
            }
        } else {
            $kategoriekle = $db->prepare('update urun_kategori set 
baslik=:baslik,
alt_kategori=:alt_kategori,
seo=:seo,
title=:title,
keywords=:keywords,
description=:description,
aciklama=:aciklama,
reklam=:reklam,
sira=:sira

where id=:id
');
            $kategoriekle->execute(array(
                'baslik' => $_POST['baslik'],
                'alt_kategori' => $_POST['alt_kategori'],
                'title' => $_POST['title'],
                'keywords' => $_POST['keywords'],
                'description' => $_POST['description'],
                'aciklama' => $_POST['aciklama'],
                'sira' => $_POST['sira'],
                'reklam' => $_POST['reklam'],
                'id' => $_POST['id'],
                'seo' => seo($_POST['baslik'])


            ));
            if ($kategoriekle) {
                header('location:../urunkategori_liste.php?ok=ok');
            }
        }
    }

#yazilim kategori ekle
    if (isset($_GET['yazilim_kategoriekle'])) {
        $kategoriekle = $db->prepare('insert into yazilim_kategori set 
baslik=:baslik,
icerik=:icerik,
alt_kategori=:alt_kategori
');
        $kategoriekle->execute(array(
            'baslik' => $_GET['baslik'],
            'icerik' => $_GET['icerik'],
            'alt_kategori' => $_GET['alt_kategori']


        ));
        if ($kategoriekle) {
            header('location:../yazilimkategori_ekle.php?ok=ok');
        }
    }
#yazilim kategori sil
    if (isset($_GET['yazilim_kategorisil'])) {
        $sil = $db->prepare('delete from yazilim_kategori where id=:id');
        $sil->execute(array('id' => $_GET['yazilim_kategoriid']));
        if ($sil) {
            header('location:../yazilimkategori_liste.php?sil=ok');
        }
    }
#yazilim kategori duzenle
    if (isset($_GET['yazilim_kategoriguncelle'])) {
        $kategoriekle = $db->prepare('update yazilim_kategori set 
baslik=:baslik,
alt_kategori=:alt_kategori,
icerik=:icerik
where id=:id
');
        $kategoriekle->execute(array(
            'baslik' => $_GET['baslik'],
            'alt_kategori' => $_GET['alt_kategori'],
            'icerik' => $_GET['icerik'],
            'id' => $_GET['kategori_id']
        ));
        if ($kategoriekle) {
            header('location:../yazilimkategori_liste.php?ok=ok');
        }
    }
#yazılım ekle
    if (isset($_POST['yazilim_ekle'])) {

        $ekle = $db->prepare('insert into yazilim set 
baslik=:baslik,
icerik=:icerik,
keywords=:keywords,
description=:description,
ust_id=:ust_id

');
        $ekle->execute(array(
            'baslik' => $_POST['baslik'],
            'icerik' => $_POST['icerik'],
            'keywords' => $_POST['keywords'],
            'description' => $_POST['description'],
            'ust_id' => $_POST['ust_id']

        ));
        if ($ekle) {
            header('location:../yazilim_ekle.php?ok=ok');
        }

    }
#yazılım sil
    if (isset($_GET['yazilim_sil'])) {
        $sil = $db->prepare('delete from yazilim where id=:id');
        $sil->execute(array('id' => $_GET['yazilim_id']));
        if ($sil) {
            header('location:../yazilim_liste.php?sil=ok');
        }
    }
#yazilim guncelle
    if (isset($_POST['yazilim_duzenle'])) {

        $duzenle = $db->prepare('update yazilim set
    baslik=:baslik,
    keywords=:keywords,
description=:description,
ust_id=:ust_id,
    icerik=:icerik

    where id=:id
    ');
        $duzenle->execute(array(
            'baslik' => $_POST['baslik'],
            'icerik' => $_POST['icerik'],
            'keywords' => $_POST['keywords'],
            'description' => $_POST['description'],
            'ust_id' => $_POST['ust_id'],
            'id' => $_POST['yazilim_id']
        ));

        if ($duzenle) {
            header('location:../yazilim_liste.php?ok=ok');
        }
    }

#kategori kategori ekle
    if (isset($_GET['kategorik_ekle'])) {
        $kategoriekle = $db->prepare('insert into kategori_kategori set 
baslik=:baslik,
tur=:tur
');
        $kategoriekle->execute(array(
            'baslik' => $_GET['baslik'],
            'tur' => $_GET['tur']

        ));
        if ($kategoriekle) {
            header('location:../kategorik_ekle.php?ok=ok');
        }
    }
#kategori kategori sil
    if (isset($_GET['kategori_kategorisil'])) {
        $sil = $db->prepare('delete from kategori_kategori where id=:id');
        $sil->execute(array('id' => $_GET['kategori_kategoriid']));
        if ($sil) {
            header('location:../kategorik_liste.php?sil=ok');
        }
    }
#kategori kategori duzenle
    if (isset($_GET['kategori_kategoriguncelle'])) {
        $kategoriekle = $db->prepare('update kategori_kategori set 
baslik=:baslik,
tur=:tur
where id=:id
');
        $kategoriekle->execute(array(
            'baslik' => $_GET['baslik'],
            'tur' => $_GET['tur'],
            'id' => $_GET['kategori_id']
        ));
        if ($kategoriekle) {
            header('location:../kategorik_liste.php?ok=ok');
        }
    }
#kategori ekle
    if (isset($_POST['kategori_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/kategori');

            #thumb
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_x = 374;
            $resim->image_y = 268;
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/kategori/thumb');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $uzunluk = strlen($_FILES['resim']['name']);
            $uzanti = substr($_FILES['resim']['name'], -4, $uzunluk);
            $ekle = $db->prepare('insert into kategori set 
baslik=:baslik,
icerik=:icerik,
keywords=:keywords,
description=:description,
ust_id=:ust_id,
resim=:resim
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'icerik' => $_POST['icerik'],
                'keywords' => $_POST['keywords'],
                'description' => $_POST['description'],
                'ust_id' => $_POST['ust_id'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($ekle) {
                header('location:../kategori_ekle.php?ok=ok');
            }

        } else {
            echo 'hata meydana geldi resim eksik olabilir.';
        }
    }
#kategori sil
    if (isset($_GET['kategori_sil'])) {
        $sil = $db->prepare('delete from kategori where id=:id');
        $sil->execute(array('id' => $_GET['kategori_id']));
        if ($sil) {
            unlink('../../../upload/kategori/' . $_GET['kategori_resim']);
            unlink('../../../upload/kategori/thumb/' . $_GET['kategori_resim']);
            header('location:../kategori_liste.php?sil=ok');
        }
    }
#kategori guncelle
    if (isset($_POST['kategori_duzenle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/kategori');

            #thumb
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_x = 374;
            $resim->image_y = 268;
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/kategori/thumb');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $uzunluk = strlen($_FILES['resim']['name']);
            $uzanti = substr($_FILES['resim']['name'], -4, $uzunluk);
            $duzenle = $db->prepare('update kategori set
    baslik=:baslik,
    icerik=:icerik,
    keywords=:keywords,
description=:description,
ust_id=:ust_id,
    resim=:resim
    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['baslik'],
                'icerik' => $_POST['icerik'],
                'keywords' => $_POST['keywords'],
                'description' => $_POST['description'],
                'ust_id' => $_POST['ust_id'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['kategori_id']
            ));
            if ($duzenle) {
                unlink('../../../upload/kategori/' . $_POST['eski_resim']);
                unlink('../../../upload/kategori/thumb/' . $_POST['eski_resim']);
                header('location:../kategori_liste.php?ok=ok');
            }
        } else {
            $duzenle = $db->prepare('update kategori set
    baslik=:baslik,
    keywords=:keywords,
description=:description,
ust_id=:ust_id,
    icerik=:icerik

    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['baslik'],
                'icerik' => $_POST['icerik'],
                'keywords' => $_POST['keywords'],
                'description' => $_POST['description'],
                'ust_id' => $_POST['ust_id'],
                'id' => $_POST['kategori_id']
            ));
        }
        if ($duzenle) {
            header('location:../kategori_liste.php?ok=ok');
        }
    }
#satis sil
    if (isset($_GET['satis_sil'])) {
        $sil = $db->prepare('delete from satis where id=:id');
        $sil->execute(array('id' => $_GET['satis_id']));
        if ($sil) {
            header('location:../satis_liste.php?sil=ok');
        }
    }
#satis düzenle
    if (isset($_GET['satis_ok'])) {
        $duzenle = $db->prepare('update satis set 
durum=:durum
where id=:id
');
        $duzenle->execute(array(
            'durum' => $_GET['satis_durum'],
            'id' => $_GET['satis_id']
        ));
        if ($duzenle) {
            header('location:../satis_liste.php?ok=ok');
        }
    }
#menu düzenle
    if (isset($_POST['menu_guncelle'])) {
        $menu_guncelle = $db->prepare('update menu set 
yazilim=:yazilim,
hakkimizda=:hakkimizda,
cozumlerimiz=:cozumlerimiz,
entegrasyonlar=:entegrasyonlar,
blog=:blog,
referans=:referans,
iletisim=:iletisim
');
        $menu_guncelle->execute(array(
            'yazilim' => $_POST['yazilim'],
            'hakkimizda' => $_POST['hakkimizda'],
            'cozumlerimiz' => $_POST['cozumlerimiz'],
            'entegrasyonlar' => $_POST['entegrasyonlar'],
            'blog' => $_POST['blog'],
            'referans' => $_POST['referans'],
            'iletisim' => $_POST['iletisim']
        ));
        if ($menu_guncelle) {
            header('location:../menu_duzenle.php?ok=ok');

        }


    }
#referans ekle
    if (isset($_POST['entegrasyon_ekle'])) {
        $resim = new Upload($_FILES['entegrasyon_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['entegrasyon_baslik']);
            $resim->process('../../../upload/entegrasyon');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['entegrasyon_baslik']);
            $uzunluk = strlen($_FILES['entegrasyon_resim']['name']);
            $uzanti = substr($_FILES['entegrasyon_resim']['name'], -4, $uzunluk);
            $entegrasyon_ekle = $db->prepare('insert into entegrasyon set 
resim=:resim,
sira=:sira,
ust_id=:ust_id,
baslik=:baslik

');
            $entegrasyon_ekle->execute(array(
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'baslik' => $_POST['entegrasyon_baslik'],
                'ust_id' => $_POST['ust_id'],
                'sira' => $_POST['entegrasyon_sira']

            ));
            if ($entegrasyon_ekle) {
                header('location:../entegrasyon_ekle.php?ok=ok');
            }
        }

    }
#referans Duzenle
    if (isset($_POST['entegrasyon_duzenle'])) {
        $resim = new Upload($_FILES['entegrasyon_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['entegrasyon_baslik']);
            $resim->process('../../../upload/entegrasyon');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['entegrasyon_baslik']);
            $uzunluk = strlen($_FILES['entegrasyon_resim']['name']);
            $uzanti = substr($_FILES['entegrasyon_resim']['name'], -4, $uzunluk);
            $referansekle = $db->prepare('update entegrasyon set 
resim=:resim,
sira=:sira,
ust_id=:ust_id,
baslik=:baslik
where id=:id

');
            $referansekle->execute(array(
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'sira' => $_POST['entegrasyon_sira'],
                'baslik' => $_POST['entegrasyon_baslik'],
                'ust_id' => $_POST['ust_id'],
                'id' => $_POST['entegrasyon_id']

            ));
            if ($referansekle) {
                header('location:../entegrasyon_duzenle.php?ok=ok&entegrasyon_id=' . $_POST['entegrasyon_id']);
            }
        } else {
            $referansekle = $db->prepare('update entegrasyon set 

sira=:sira,
ust_id=:ust_id,
baslik=:baslik
where id=:id

');
            $referansekle->execute(array(
                'sira' => $_POST['entegrasyon_sira'],
                'baslik' => $_POST['entegrasyon_baslik'],
                'ust_id' => $_POST['ust_id'],
                'id' => $_POST['entegrasyon_id']

            ));
            if ($referansekle) {
                header('location:../entegrasyon_duzenle.php?ok=ok&entegrasyon_id=' . $_POST['entegrasyon_id']);
            }
        }

    }
#entegrasyon sil
    if (isset($_GET['entegrasyon_sil'])) {
        $entegrasyonsil = $db->prepare('delete from entegrasyon where id=:id');
        $entegrasyonsil->execute(array('id' => $_GET['entegrasyon_id']));
        if ($entegrasyonsil) {
            unlink('../../../upload/entegrasyon/' . $_GET['entegrasyon_resim']);
            header('location:../entegrasyon_liste.php?sil=ok');
        }
    }
    if (isset($_GET['ceviri_guncelle'])) {
        $guncelle = $db->prepare('update cevir set
    slider_baslik=:slider_baslik,
    slider_icerik=:slider_icerik,
    destek=:destek,
    kasko=:kasko,
    rapor=:rapor,
    entegrasyon=:entegrasyon,
    kurulum=:kurulum,
    telefon_slogan=:telefon_slogan,
    masaya_siparis=:masaya_siparis,
    masaya_sayi=:masaya_sayi,
    stok_rapor=:stok_rapor,
    stok_sayi=:stok_sayi,
    paket_servis=:paket_servis,
    paket_sayi=:paket_sayi,
    adisyon=:adisyon,
    adisyon_sayi=:adisyon_sayi,
    sayilar_slogan=:sayilar_slogan
    ');
        $guncelle->execute(array(
            'slider_baslik' => $_GET['slider_baslik'],
            'slider_icerik' => $_GET['slider_icerik'],
            'destek' => $_GET['destek'],
            'kasko' => $_GET['kasko'],
            'rapor' => $_GET['rapor'],
            'entegrasyon' => $_GET['entegrasyon'],
            'kurulum' => $_GET['kurulum'],
            'telefon_slogan' => $_GET['telefon_slogan'],
            'masaya_siparis' => $_GET['masaya_siparis'],
            'masaya_sayi' => $_GET['masaya_sayi'],
            'stok_rapor' => $_GET['stok_rapor'],
            'stok_sayi' => $_GET['stok_sayi'],
            'paket_servis' => $_GET['paket_servis'],
            'paket_sayi' => $_GET['paket_sayi'],
            'adisyon' => $_GET['adisyon'],
            'adisyon_sayi' => $_GET['adisyon_sayi'],
            'sayilar_slogan' => $_GET['sayilar_slogan']

        ));
        if ($guncelle) {
            header('location:../ceviri.php?ok=ok');
        }
    }
    if (isset($_POST['ozellik_duzenle'])) {
        $resim = new Upload($_FILES['ozellik_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['ozellik_baslik']);
            $resim->process('../../../upload/ozellik');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['ozellik_baslik']);
            $uzunluk = strlen($_FILES['ozellik_resim']['name']);
            $uzanti = substr($_FILES['ozellik_resim']['name'], -4, $uzunluk);
            $duzenle = $db->prepare('update ozellik set 
ozellik_baslik=:baslik,
ozellik_icerik=:icerik,
ozellik_sira=:sira,
ozellik_resim=:resim
where ozellik_id=:id
');
            $duzenle->execute(array(
                'baslik' => $_POST['ozellik_baslik'],
                'icerik' => $_POST['ozellik_icerik'],
                'sira' => $_POST['ozellik_sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['ozellik_id']
            ));

            if ($duzenle) {
                header('location:../ozellik_duzenle.php?ozellik_id=' . $_POST['ozellik_id']);
            }
        } else {
            $duzenle = $db->prepare('update ozellik set 
ozellik_baslik=:baslik,
ozellik_sira=:sira,
ozellik_icerik=:icerik

where ozellik_id=:id
');
            $duzenle->execute(array(
                'baslik' => $_POST['ozellik_baslik'],
                'icerik' => $_POST['ozellik_icerik'],
                'sira' => $_POST['ozellik_sira'],
                'id' => $_POST['ozellik_id']
            ));
            if ($duzenle) {
                header('location:../ozellik_duzenle.php?duzenle=ok&ozellik_id=' . $_POST['ozellik_id']);
            }
        }
    }
    if (isset($_POST['ozellik_ekle'])) {
        $resim = new Upload($_FILES['ozellik_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['ozellik_baslik']);
            $resim->process('../../../upload/ozellik');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['ozellik_baslik']);
            $uzunluk = strlen($_FILES['ozellik_resim']['name']);
            $uzanti = substr($_FILES['ozellik_resim']['name'], -4, $uzunluk);
            $duzenle = $db->prepare('insert into ozellik set 
ozellik_baslik=:baslik,
ozellik_icerik=:icerik,
ozellik_sira=:sira,
ozellik_resim=:resim

');
            $duzenle->execute(array(
                'baslik' => $_POST['ozellik_baslik'],
                'icerik' => $_POST['ozellik_icerik'],
                'sira' => $_POST['ozellik_sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext

            ));

            if ($duzenle) {
                header('location:../ozellik_ekle.php?ekle=ok');
            }
        } else {
            $duzenle = $db->prepare('insert into ozellik set 
ozellik_baslik=:baslik,
ozellik_sira=:sira,
ozellik_icerik=:icerik


');
            $duzenle->execute(array(
                'baslik' => $_POST['ozellik_baslik'],
                'icerik' => $_POST['ozellik_icerik'],
                'sira' => $_POST['ozellik_sira']

            ));
            if ($duzenle) {
                header('location:../ozellik_ekle.php?ekle=ok');
            }
        }
    }
    if (isset($_GET['ozellik_sil'])) {
        $sil = $db->prepare('delete from ozellik where ozellik_id=:id ');
        $sil->execute(array('id' => $_GET['ozellik_id']));
        if ($sil) {
            header('location:../ozellik_liste.php');
        }
    }
    if (isset($_GET['mail_duzenle'])) {
        $duzenle = $db->prepare('update mail set
    mail=:mail,
    host=:host,
    sifre=:sifre,
    port=:port,
    gonderilen_mail=:gonderilen,
    konu=:konu,
    gonderici_adi=:gonderici_adi
    ');
        $duzenle->execute(array(
            'mail' => $_GET['mail'],
            'host' => $_GET['host'],
            'sifre' => $_GET['sifre'],
            'port' => $_GET['port'],
            'gonderilen' => $_GET['gonderilen'],
            'konu' => $_GET['konu'],
            'gonderici_adi' => $_GET['gonderici_adi']
        ));
        if ($duzenle) {
            header('location:../mail_ayar.php');
        }
    }
    if (isset($_POST['program_ozellik_ekle'])) {

        $resim = new Upload($_FILES['program_ozellik_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['program_ozellik_resim']);
            $resim->process('../../../upload/kurumsal');
            #thumb
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_y = 374;
            $resim->image_x = 268;
            $resim->image_convert = 'jpg';
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['program_ozellik_resim']);
            $resim->process('../../../upload/kurumsal/thumb');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['program_ozellik_resim']);
            $uzunluk = strlen($_FILES['program_ozellik_resim']['name']);
            $uzanti = '.jpg';
            date_default_timezone_set('Europe/Istanbul');
            $tarih = date('d.m.Y');
            $kurumsalekle = $db->prepare('insert into ozellikler set 
ozellik_baslik=:baslik,
ozellik_icerik=:icerik,
sira=:sira,
ozellik_boyut=:ozellik_boyut,
ozellik_resim=:resim
');
            $kurumsalekle->execute(array(
                'baslik' => $_POST['program_ozellik_baslik'],
                'icerik' => $_POST['program_ozellik_icerik'],
                'sira' => $_POST['program_ozellik_sira'],
                'ozellik_boyut' => $_POST['program_ozellik_boyut'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($kurumsalekle) {
                header('location:../programozellik_ekle.php?ok=ok');
            }
        } else {
            $kurumsalekle = $db->prepare('insert into ozellikler set 
ozellik_baslik=:baslik,
ozellik_icerik=:icerik,
sira=:sira,
ozellik_boyut=:ozellik_boyut

');
            $kurumsalekle->execute(array(
                'baslik' => $_POST['program_ozellik_baslik'],
                'icerik' => $_POST['program_ozellik_icerik'],
                'sira' => $_POST['program_ozellik_sira'],
                'ozellik_boyut' => $_POST['program_ozellik_boyut']

            ));
            if ($kurumsalekle) {
                header('location:../programozellik_ekle.php?ok=ok');
            }
        }
    }
    if (isset($_POST['program_ozellik_duzenle'])) {
        $resim = new Upload($_FILES['program_ozellik_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['program_ozellik_resim']);
            $resim->process('../../../upload/kurumsal');
            #thumb
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->image_resize = true;
            $resim->image_ratio_crop = true;
            $resim->image_y = 374;
            $resim->image_x = 268;
            $resim->image_convert = 'jpg';
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['program_ozellik_resim']);
            $resim->process('../../../upload/kurumsal/thumb');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['program_ozellik_resim']);
            $uzunluk = strlen($_FILES['program_ozellik_resim']['name']);
            $uzanti = '.jpg';
            date_default_timezone_set('Europe/Istanbul');
            $tarih = date('d.m.Y');
            $kurumsalekle = $db->prepare('update ozellikler set 
ozellik_baslik=:baslik,
ozellik_icerik=:icerik,
sira=:sira,
ozellik_boyut=:ozellik_boyut,
ozellik_resim=:resim
where ozellik_id=:id
');
            $kurumsalekle->execute(array(
                'baslik' => $_POST['program_ozellik_baslik'],
                'icerik' => $_POST['program_ozellik_icerik'],
                'sira' => $_POST['program_ozellik_sira'],
                'ozellik_boyut' => $_POST['program_ozellik_boyut'],
                'id' => $_POST['ozellik_id'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($kurumsalekle) {
                header('location:../programozellik_liste.php?ok=ok');
            }
        } else {
            $kurumsalekle = $db->prepare('update ozellikler set 
ozellik_baslik=:baslik,
ozellik_icerik=:icerik,
sira=:sira,
ozellik_boyut=:ozellik_boyut

where ozellik_id=:id
');
            $kurumsalekle->execute(array(
                'baslik' => $_POST['program_ozellik_baslik'],
                'icerik' => $_POST['program_ozellik_icerik'],
                'sira' => $_POST['program_ozellik_sira'],
                'ozellik_boyut' => $_POST['program_ozellik_boyut'],
                'id' => $_POST['ozellik_id']

            ));
            if ($kurumsalekle) {
                header('location:../programozellik_liste.php?ok=ok');
            }
        }
    }
    if (isset($_GET['program_ozellik_sil'])) {
        $sil = $db->prepare('delete from ozellikler where ozellik_id=:id');
        $sil->execute(array('id' => $_GET['ozellik_id']));
        if ($sil) {
            header('location:../programozellik_liste.php?sil=ok');
        }
    }
    if (isset($_GET['admin_duzenle'])) {
        $duzenle = $db->prepare('update giris set
    admin_adi=:adi,
    admin_sifre=:sifre
    ');
        $duzenle->execute(array('adi' => $_GET['admin_adi'], 'sifre' => $_GET['admin_sifre']));
        if ($duzenle) {
            header('location:../kullanici_duzenle.php?duzenle=ok');
        }
    }
    #urun ekle
    if (isset($_POST['urun_ekle'])) {
        $resim = new Upload($_FILES['urun_resim']);
        $resim_kare = new Upload($_FILES['urun_resim_kare']);
        $resim_icon = new Upload($_FILES['urun_icon']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            $sayikare = rand(0, 99999);
            $sayiicon = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['urun_baslik']);
            $resim->process('../../../upload/urun');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['urun_baslik']);
            $resim_kare->allowed = array('image/*');
            $resim_kare->image_convert = "webp";
            $resim_kare->file_new_name_body = rseo($sayikare . '-' . $_POST['urun_baslik']);
            $resim_kare->process('../../../upload/urun');
            $image_kare = $resim_kare->file_new_name_body = rseo($sayikare . '-' . $_POST['urun_baslik']);
            $resim_icon->allowed = array('image/*');
            $resim_icon->image_convert = "webp";
            $resim_icon->file_new_name_body = rseo($sayiicon . '-' . $_POST['urun_baslik']);
            $resim_icon->process('../../../upload/urun');
            $image_icon = $resim_icon->file_new_name_body = rseo($sayiicon . '-' . $_POST['urun_baslik']);
            $ekle = $db->prepare('insert into urunlerimiz set 
baslik=:baslik,
sira=:sira,
resim=:resim,
    sayfa_baslik=:sayfa_baslik,
    sayfa_aciklama=:sayfa_aciklama,
                         thumb_resim=:thumb_resim,
                         icon=:icon
');
            $ekle->execute(array(
                'baslik' => $_POST['urun_baslik'],
                'sira' => $_POST['urun_sira'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'thumb_resim' => $image_kare . '.' . $resim_kare->file_dst_name_ext,
                'icon' => $image_icon . '.' . $resim_icon->file_dst_name_ext
            ));
            if ($ekle) {

                // Son eklenen kaydın id'sini al
                $lastId = $db->lastInsertId();

                // Yönlendirme işlemi
                header('Location: ../urunlerimiz_duzenle.php?urun_id=' . $lastId . '&ok=ok');
            }

        }


    }
#urun sil
    if (isset($_GET['urun_sil'])) {
        $sil = $db->prepare('delete from urunlerimiz where id=:id');
        $sil->execute(array('id' => $_GET['urun_id']));
        if ($sil) {
            unlink('../../../upload/urun/' . $_GET['urun_resim']);
            header('location:../urunlerimiz_liste.php?sil=ok');
        }
    }
#urun guncelle
    if (isset($_POST['urun_duzenle'])) {
        $resim = new Upload($_FILES['urun_resim']);
        $resim_kare = new Upload($_FILES['urun_resim_kare']);
        if ($resim_kare->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim_kare->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim_kare->file_new_name_body = rseo($sayi . '-' . $_POST['urun_baslik']);
            $resim_kare->process('../../../upload/urun');
            $image_kare = $resim_kare->file_new_name_body = rseo($sayi . '-' . $_POST['urun_baslik']);
            $duzenle = $db->prepare('update urunlerimiz set
    baslik=:baslik,
    sayfa_baslik=:sayfa_baslik,
    sayfa_aciklama=:sayfa_aciklama,
    sira=:sira,
    thumb_resim=:thumb_resim
    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['urun_baslik'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'sira' => $_POST['urun_sira'],
                'thumb_resim' => $image_kare . '.' . $resim_kare->file_dst_name_ext,
                'id' => $_POST['urun_id']
            ));
        }
        $resim_icon = new Upload($_FILES['urun_icon']);
        if ($resim_icon->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim_icon->allowed = array('image/*');
            $resim_icon->image_convert = "webp";
            $resim_icon->file_new_name_body = rseo($sayi . '-' . $_POST['urun_baslik']);
            $resim_icon->process('../../../upload/urun');
            $image_icon = $resim_icon->file_new_name_body = rseo($sayi . '-' . $_POST['urun_baslik']);
            $duzenle = $db->prepare('update urunlerimiz set
                           baslik=:baslik,
    sayfa_baslik=:sayfa_baslik,
    sayfa_aciklama=:sayfa_aciklama,
    sira=:sira,
    icon=:icon
    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['urun_baslik'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'sira' => $_POST['urun_sira'],
                'icon' => $image_icon . '.' . $resim_icon->file_dst_name_ext,
                'id' => $_POST['urun_id']
            ));
        }
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['urun_baslik']);
            $resim->process('../../../upload/urun');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['urun_baslik']);
            $duzenle = $db->prepare('update urunlerimiz set
 baslik=:baslik,
    sayfa_baslik=:sayfa_baslik,
    sayfa_aciklama=:sayfa_aciklama,
    sira=:sira,
    resim=:resim
    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['urun_baslik'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'sira' => $_POST['urun_sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,

                'id' => $_POST['urun_id']
            ));

            if ($duzenle) {

                header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
            }
        } else {
            $duzenle = $db->prepare('update urunlerimiz set
 baslik=:baslik,
    sayfa_baslik=:sayfa_baslik,
    sayfa_aciklama=:sayfa_aciklama,
    sira=:sira
    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['urun_baslik'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'sira' => $_POST['urun_sira'],
                'id' => $_POST['urun_id']
            ));
            if ($duzenle) {
                header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
            }
            return;
        }
        if ($duzenle) {
            header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
        }
    }
    #urun icerik ekle
    if (isset($_POST['urunicerik_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999999999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi);
            $resim->process('../../../upload/urun');
            $image = $resim->file_new_name_body = rseo($sayi);
            $ekle = $db->prepare('insert into urun_icerik set 
baslik=:baslik,
aciklama=:aciklama,
urun_id=:urun_id,
sira=:sira,
resim=:resim
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'aciklama' => $_POST['aciklama'],
                'urun_id' => $_POST['urun_id'],
                'sira' => $_POST['sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($ekle) {

                // Yönlendirme işlemi
                header('Location: ../urunlerimiz_duzenle.php?urun_id=' . $_POST['urun_id'] . '&duzenle=ok');
            }

        }


    }
#urun sil
    if (isset($_GET['urunicerik_sil'])) {
        $sil = $db->prepare('delete from urun_icerik where id=:id');
        $sil->execute(array('id' => $_GET['urunicerik_id']));
        if ($sil) {
            unlink('../../../upload/urun/' . $_GET['urun_resim']);
            header('location:../urunlerimiz_duzenle.php?urun_id=' . $_GET['urun_id'] . '&sil=ok');
        }
    }
#urun guncelle
    if (isset($_POST['urunicerik_duzenleme'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/urun');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $duzenle = $db->prepare('update urun_icerik set
    sira=:sira,
    urun_id=:urun_id,
    aciklama=:aciklama,
    baslik=:baslik,
    resim=:resim
    where id=:id
    ');
            $duzenle->execute(array(

                'sira' => $_POST['sira'],
                'urun_id' => $_POST['urun_id'],
                'aciklama' => $_POST['aciklama'],
                'baslik' => $_POST['baslik'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['urunicerik_id']
            ));
            if ($duzenle) {
                unlink('../../../upload/urun/' . $_POST['eski_resim']);
                header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
            }
        } else {
            $duzenle = $db->prepare('update urun_icerik set
        baslik=:baslik,
        aciklama=:aciklama,
        urun_id=:urun_id,
    sira=:sira
    where id=:id
    ');
            echo $_POST['urunicerik_id'];
            $duzenle->execute(array(
                'sira' => $_POST['sira'],
                'urun_id' => $_POST['urun_id'],
                'aciklama' => $_POST['aciklama'],
                'baslik' => $_POST['baslik'],
                'id' => $_POST['urunicerik_id']
            ));
            if ($duzenle) {
                header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
            }
        }
    }
    #urun icerik ekle
    if (isset($_POST['urunozellik_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999999999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi);
            $resim->process('../../../upload/urun');
            $image = $resim->file_new_name_body = rseo($sayi);
            $ekle = $db->prepare('insert into urun_ozellik set 
baslik=:baslik,
aciklama=:aciklama,
urun_id=:urun_id,
sira=:sira,
resim=:resim
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'aciklama' => $_POST['aciklama'],
                'urun_id' => $_POST['urun_id'],
                'sira' => $_POST['sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($ekle) {

                // Yönlendirme işlemi
                header('Location: ../urunlerimiz_duzenle.php?urun_id=' . $_POST['urun_id'] . '&duzenle=ok');
            }

        }


    }
#urun sil
    if (isset($_GET['urunozellik_sil'])) {
        $sil = $db->prepare('delete from urun_ozellik where id=:id');
        $sil->execute(array('id' => $_GET['urunozellik_id']));
        if ($sil) {
            unlink('../../../upload/urun/' . $_GET['urun_resim']);
            header('location:../urunlerimiz_duzenle.php?urun_id=' . $_GET['urun_id'] . '&sil=ok');
        }
    }
#urun guncelle
    if (isset($_POST['urunozellik_duzenleme'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/urun');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $duzenle = $db->prepare('update urun_ozellik set
    sira=:sira,
    urun_id=:urun_id,
    aciklama=:aciklama,
    baslik=:baslik,
    resim=:resim
    where id=:id
    ');
            $duzenle->execute(array(

                'sira' => $_POST['sira'],
                'urun_id' => $_POST['urun_id'],
                'aciklama' => $_POST['aciklama'],
                'baslik' => $_POST['baslik'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['selfID']
            ));
            if ($duzenle) {
                unlink('../../../upload/urun/' . $_POST['eski_resim']);
                header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
            }
        } else {
            $duzenle = $db->prepare('update urun_ozellik set
        baslik=:baslik,
        aciklama=:aciklama,
        urun_id=:urun_id,
    sira=:sira
    where id=:id
    ');
            echo $_POST['urunicerik_id'];
            $duzenle->execute(array(
                'sira' => $_POST['sira'],
                'urun_id' => $_POST['urun_id'],
                'aciklama' => $_POST['aciklama'],
                'baslik' => $_POST['baslik'],
                'id' => $_POST['selfID']
            ));
            if ($duzenle) {
                header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
            }
        }
    }

    #urun SSS ekle
    if (isset($_POST['urunsss_ekle'])) {

        $ekle = $db->prepare('insert into urun_sss set 
baslik=:baslik,
aciklama=:aciklama,
urun_id=:urun_id,
sira=:sira
');
        $ekle->execute(array(
            'baslik' => $_POST['baslik'],
            'aciklama' => $_POST['aciklama'],
            'urun_id' => $_POST['urun_id'],
            'sira' => $_POST['sira'],

        ));
        if ($ekle) {

            // Yönlendirme işlemi
            header('Location: ../urunlerimiz_duzenle.php?urun_id=' . $_POST['urun_id'] . '&duzenle=ok');
        }


    }
#urun SSS sil
    if (isset($_GET['urunsss_sil'])) {
        $sil = $db->prepare('delete from urun_sss where id=:id');
        $sil->execute(array('id' => $_GET['selfId']));
        if ($sil) {

            header('location:../urunlerimiz_duzenle.php?urun_id=' . $_GET['urun_id'] . '&sil=ok');
        }
    }
#urun SSS guncelle
    if (isset($_POST['urunsss_duzenleme'])) {
        $resim = new Upload($_FILES['resim']);

        $duzenle = $db->prepare('update urun_sss set
        baslik=:baslik,
        aciklama=:aciklama,
        urun_id=:urun_id,
    sira=:sira
    where id=:id
    ');
        echo $_POST['urunicerik_id'];
        $duzenle->execute(array(
            'sira' => $_POST['sira'],
            'urun_id' => $_POST['urun_id'],
            'aciklama' => $_POST['aciklama'],
            'baslik' => $_POST['baslik'],
            'id' => $_POST['selfID']
        ));
        if ($duzenle) {
            header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
        }

    }
    #urun icerik ekle
    if (isset($_POST['urunnasil_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999999999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi);
            $resim->process('../../../upload/urun');
            $image = $resim->file_new_name_body = rseo($sayi);
            $ekle = $db->prepare('insert into urun_nasil_calisir set 
baslik=:baslik,

urun_id=:urun_id,
sira=:sira,
resim=:resim
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],

                'urun_id' => $_POST['urun_id'],
                'sira' => $_POST['sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($ekle) {

                // Yönlendirme işlemi
                header('Location: ../urunlerimiz_duzenle.php?urun_id=' . $_POST['urun_id'] . '&duzenle=ok');
            }

        }


    }
#urun sil
    if (isset($_GET['urunnasil_sil'])) {
        $sil = $db->prepare('delete from urun_nasil_calisir where id=:id');
        $sil->execute(array('id' => $_GET['selfId']));
        if ($sil) {
            unlink('../../../upload/urun/' . $_GET['urun_resim']);
            header('location:../urunlerimiz_duzenle.php?urun_id=' . $_GET['urun_id'] . '&sil=ok');
        }
    }
#urun guncelle
    if (isset($_POST['urunnasil_duzenleme'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/urun');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $duzenle = $db->prepare('update urun_nasil_calisir set
    sira=:sira,
    urun_id=:urun_id,

    baslik=:baslik,
    resim=:resim
    where id=:id
    ');
            $duzenle->execute(array(

                'sira' => $_POST['sira'],
                'urun_id' => $_POST['urun_id'],

                'baslik' => $_POST['baslik'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['selfID']
            ));
            if ($duzenle) {
                unlink('../../../upload/urun/' . $_POST['eski_resim']);
                header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
            }
        } else {
            $duzenle = $db->prepare('update urun_nasil_calisir set
        baslik=:baslik,

        urun_id=:urun_id,
    sira=:sira
    where id=:id
    ');
            echo $_POST['urunicerik_id'];
            $duzenle->execute(array(
                'sira' => $_POST['sira'],
                'urun_id' => $_POST['urun_id'],

                'baslik' => $_POST['baslik'],
                'id' => $_POST['selfID']
            ));
            if ($duzenle) {
                header('location:../urunlerimiz_duzenle.php?duzenle=ok&urun_id=' . $_POST['urun_id']);
            }
        }
    }
    #urun ekle
    if (isset($_POST['faliyet_ekle'])) {
        $resim = new Upload($_FILES['faliyet_resim']);
        $resim_kare = new Upload($_FILES['faliyet_video']);
        $resim_icon = new Upload($_FILES['faliyet_icon']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            $sayivideo = rand(0, 99999);
            $sayiyatay = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['faliyet_baslik']);
            $resim->process('../../../upload/faliyet');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['faliyet_baslik']);

            $resim_kare->file_new_name_body = rseo($sayivideo . '-' . $_POST['faliyet_baslik']);
            $resim_kare->process('../../../upload/faliyet');
            $image_kare = $resim_kare->file_new_name_body = rseo($sayivideo . '-' . $_POST['faliyet_baslik']);
            $resim_icon->allowed = array('image/*');
            $resim_icon->image_convert = "webp";
            $resim_icon->file_new_name_body = rseo($sayiyatay . '-' . $_POST['faliyet_baslik']);
            $resim_icon->process('../../../upload/faliyet');
            $image_icon = $resim_icon->file_new_name_body = rseo($sayiyatay . '-' . $_POST['faliyet_baslik']);
            $ekle = $db->prepare('insert into faliyetlerimiz set 
baslik=:baslik,
sira=:sira,
resim=:resim,
ana_ekran=:ana_ekran,
    sayfa_baslik=:sayfa_baslik,
    sayfa_aciklama=:sayfa_aciklama,
                         video=:video,
                         icon=:icon
');
            $ekle->execute(array(
                'baslik' => $_POST['faliyet_baslik'],
                'ana_ekran' => $_POST['ana_ekran'],
                'sira' => $_POST['faliyet_sira'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'video' => $image_kare . '.' . $resim_kare->file_dst_name_ext,
                'icon' => $image_icon . '.' . $resim_icon->file_dst_name_ext
            ));
            if ($ekle) {

                // Son eklenen kaydın id'sini al
                $lastId = $db->lastInsertId();

                // Yönlendirme işlemi
                header('Location: ../faliyetlerimiz_duzenle.php?faliyet_id=' . $lastId . '&ok=ok');
            }

        }


    }
#faliyet sil
    if (isset($_GET['faliyet_sil'])) {
        $sil = $db->prepare('delete from faliyetlerimiz where id=:id');
        $sil->execute(array('id' => $_GET['faliyet_id']));
        if ($sil) {
            unlink('../../../upload/faliyet/' . $_GET['faliyet_resim']);
            header('location:../faliyetlerimiz_liste.php?sil=ok');
        }
    }
#faliyet guncelle
    if (isset($_POST['faliyet_duzenle'])) {
        $resim = new Upload($_FILES['faliyet_resim']);
        $resim_kare = new Upload($_FILES['faliyet_video']);
        if ($resim_kare->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim_kare->file_new_name_body = rseo($sayi . '-' . $_POST['faliyet_baslik']);
            $resim_kare->process('../../../upload/faliyet');
            $image_kare = $resim_kare->file_new_name_body = rseo($sayi . '-' . $_POST['faliyet_baslik']);
            $duzenle = $db->prepare('update faliyetlerimiz set
    baslik=:baslik,
    sayfa_baslik=:sayfa_baslik,
    sayfa_aciklama=:sayfa_aciklama,
    ana_ekran=:ana_ekran,
    sira=:sira,
    video=:video
    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['faliyet_baslik'],
                'ana_ekran' => $_POST['ana_ekran'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'sira' => $_POST['faliyet_sira'],
                'video' => $image_kare . '.' . $resim_kare->file_dst_name_ext,
                'id' => $_POST['faliyet_id']
            ));
        }
        $resim_icon = new Upload($_FILES['faliyet_icon']);
        if ($resim_icon->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim_icon->allowed = array('image/*');
            $resim_icon->image_convert = "webp";
            $resim_icon->file_new_name_body = rseo($sayi . '-' . $_POST['faliyet_baslik']);
            $resim_icon->process('../../../upload/faliyet');
            $image_icon = $resim_icon->file_new_name_body = rseo($sayi . '-' . $_POST['faliyet_baslik']);
            $duzenle = $db->prepare('update faliyetlerimiz set
                           baslik=:baslik,
    sayfa_baslik=:sayfa_baslik,
    sayfa_aciklama=:sayfa_aciklama,
    ana_ekran=:ana_ekran,
    sira=:sira,
    icon=:icon
    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['faliyet_baslik'],
                'ana_ekran' => $_POST['ana_ekran'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'sira' => $_POST['faliyet_sira'],
                'icon' => $image_icon . '.' . $resim_icon->file_dst_name_ext,
                'id' => $_POST['faliyet_id']
            ));
        }
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['faliyet_baslik']);
            $resim->process('../../../upload/faliyet');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['faliyet_baslik']);
            $duzenle = $db->prepare('update faliyetlerimiz set
 baslik=:baslik,
    ana_ekran=:ana_ekran,
    sayfa_baslik=:sayfa_baslik,
    sayfa_aciklama=:sayfa_aciklama,
    sira=:sira,
    resim=:resim
    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['faliyet_baslik'],
                'ana_ekran' => $_POST['ana_ekran'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'sira' => $_POST['faliyet_sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,

                'id' => $_POST['faliyet_id']
            ));

            if ($duzenle) {

                header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
            }
        } else {
            $duzenle = $db->prepare('update faliyetlerimiz set
 baslik=:baslik,
    sayfa_baslik=:sayfa_baslik,
    ana_ekran=:ana_ekran,
    sayfa_aciklama=:sayfa_aciklama,
    sira=:sira
    where id=:id
    ');
            $duzenle->execute(array(
                'baslik' => $_POST['faliyet_baslik'],
                'ana_ekran' => $_POST['ana_ekran'],
                'sayfa_baslik' => $_POST['sayfa_baslik'],
                'sayfa_aciklama' => $_POST['sayfa_aciklama'],
                'sira' => $_POST['faliyet_sira'],
                'id' => $_POST['faliyet_id']
            ));
            if ($duzenle) {
                header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
            }
            return;
        }
        if ($duzenle) {
            header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
        }
    }
#faliyet icerik ekle
    if (isset($_POST['faliyeticerik_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999999999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi);
            $resim->process('../../../upload/faliyet');
            $image = $resim->file_new_name_body = rseo($sayi);
            $ekle = $db->prepare('insert into faliyet_icerik set 
baslik=:baslik,
aciklama=:aciklama,
faliyet_id=:faliyet_id,
sira=:sira,
resim=:resim
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'aciklama' => $_POST['aciklama'],
                'faliyet_id' => $_POST['faliyet_id'],
                'sira' => $_POST['sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($ekle) {

                // Yönlendirme işlemi
                header('Location: ../faliyetlerimiz_duzenle.php?faliyet_id=' . $_POST['faliyet_id'] . '&duzenle=ok');
            }

        }


    }
#faliyet sil
    if (isset($_GET['faliyeticerik_sil'])) {
        $sil = $db->prepare('delete from faliyet_icerik where id=:id');
        $sil->execute(array('id' => $_GET['faliyeticerik_id']));
        if ($sil) {
            unlink('../../../upload/faliyet/' . $_GET['faliyet_resim']);
            header('location:../faliyetlerimiz_duzenle.php?faliyet_id=' . $_GET['faliyet_id'] . '&sil=ok');
        }
    }
#faliyet guncelle
    if (isset($_POST['faliyeticerik_duzenleme'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/faliyet');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $duzenle = $db->prepare('update faliyet_icerik set
    sira=:sira,
    faliyet_id=:faliyet_id,
    aciklama=:aciklama,
    baslik=:baslik,
    resim=:resim
    where id=:id
    ');
            $duzenle->execute(array(

                'sira' => $_POST['sira'],
                'faliyet_id' => $_POST['faliyet_id'],
                'aciklama' => $_POST['aciklama'],
                'baslik' => $_POST['baslik'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['faliyeticerik_id']
            ));
            if ($duzenle) {
                unlink('../../../upload/faliyet/' . $_POST['eski_resim']);
                header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
            }
        } else {
            $duzenle = $db->prepare('update faliyet_icerik set
        baslik=:baslik,
        aciklama=:aciklama,
        faliyet_id=:faliyet_id,
    sira=:sira
    where id=:id
    ');
            echo $_POST['faliyeticerik_id'];
            $duzenle->execute(array(
                'sira' => $_POST['sira'],
                'faliyet_id' => $_POST['faliyet_id'],
                'aciklama' => $_POST['aciklama'],
                'baslik' => $_POST['baslik'],
                'id' => $_POST['faliyeticerik_id']
            ));
            if ($duzenle) {
                header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
            }
        }
    }
#faliyet icerik ekle
    if (isset($_POST['faliyetozellik_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999999999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi);
            $resim->process('../../../upload/faliyet');
            $image = $resim->file_new_name_body = rseo($sayi);
            $ekle = $db->prepare('insert into faliyet_ozellik set 
baslik=:baslik,
aciklama=:aciklama,
faliyet_id=:faliyet_id,
sira=:sira,
resim=:resim
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'aciklama' => $_POST['aciklama'],
                'faliyet_id' => $_POST['faliyet_id'],
                'sira' => $_POST['sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($ekle) {

                // Yönlendirme işlemi
                header('Location: ../faliyetlerimiz_duzenle.php?faliyet_id=' . $_POST['faliyet_id'] . '&duzenle=ok');
            }

        }


    }
#faliyet sil
    if (isset($_GET['faliyetozellik_sil'])) {
        $sil = $db->prepare('delete from faliyet_ozellik where id=:id');
        $sil->execute(array('id' => $_GET['faliyetozellik_id']));
        if ($sil) {
            unlink('../../../upload/faliyet/' . $_GET['faliyet_resim']);
            header('location:../faliyetlerimiz_duzenle.php?faliyet_id=' . $_GET['faliyet_id'] . '&sil=ok');
        }
    }
#faliyet guncelle
    if (isset($_POST['faliyetozellik_duzenleme'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/faliyet');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $duzenle = $db->prepare('update faliyet_ozellik set
    sira=:sira,
    faliyet_id=:faliyet_id,
    aciklama=:aciklama,
    baslik=:baslik,
    resim=:resim
    where id=:id
    ');
            $duzenle->execute(array(

                'sira' => $_POST['sira'],
                'faliyet_id' => $_POST['faliyet_id'],
                'aciklama' => $_POST['aciklama'],
                'baslik' => $_POST['baslik'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['selfID']
            ));
            if ($duzenle) {
                unlink('../../../upload/faliyet/' . $_POST['eski_resim']);
                header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
            }
        } else {
            $duzenle = $db->prepare('update faliyet_ozellik set
        baslik=:baslik,
        aciklama=:aciklama,
        faliyet_id=:faliyet_id,
    sira=:sira
    where id=:id
    ');
            echo $_POST['faliyeticerik_id'];
            $duzenle->execute(array(
                'sira' => $_POST['sira'],
                'faliyet_id' => $_POST['faliyet_id'],
                'aciklama' => $_POST['aciklama'],
                'baslik' => $_POST['baslik'],
                'id' => $_POST['selfID']
            ));
            if ($duzenle) {
                header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
            }
        }
    }

#faliyet SSS ekle
    if (isset($_POST['faliyetsss_ekle'])) {

        $ekle = $db->prepare('insert into faliyet_sss set 
baslik=:baslik,
aciklama=:aciklama,
faliyet_id=:faliyet_id,
sira=:sira
');
        $ekle->execute(array(
            'baslik' => $_POST['baslik'],
            'aciklama' => $_POST['aciklama'],
            'faliyet_id' => $_POST['faliyet_id'],
            'sira' => $_POST['sira'],

        ));
        if ($ekle) {

            // Yönlendirme işlemi
            header('Location: ../faliyetlerimiz_duzenle.php?faliyet_id=' . $_POST['faliyet_id'] . '&duzenle=ok');
        }


    }
#faliyet SSS sil
    if (isset($_GET['faliyetsss_sil'])) {
        $sil = $db->prepare('delete from faliyet_sss where id=:id');
        $sil->execute(array('id' => $_GET['selfId']));
        if ($sil) {

            header('location:../faliyetlerimiz_duzenle.php?faliyet_id=' . $_GET['faliyet_id'] . '&sil=ok');
        }
    }
#faliyet SSS guncelle
    if (isset($_POST['faliyetsss_duzenleme'])) {
        $resim = new Upload($_FILES['resim']);

        $duzenle = $db->prepare('update faliyet_sss set
        baslik=:baslik,
        aciklama=:aciklama,
        faliyet_id=:faliyet_id,
    sira=:sira
    where id=:id
    ');
        echo $_POST['faliyeticerik_id'];
        $duzenle->execute(array(
            'sira' => $_POST['sira'],
            'faliyet_id' => $_POST['faliyet_id'],
            'aciklama' => $_POST['aciklama'],
            'baslik' => $_POST['baslik'],
            'id' => $_POST['selfID']
        ));
        if ($duzenle) {
            header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
        }

    }
#faliyet icerik ekle
    if (isset($_POST['faliyetnasil_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999999999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi);
            $resim->process('../../../upload/faliyet');
            $image = $resim->file_new_name_body = rseo($sayi);
            $ekle = $db->prepare('insert into faliyet_nasil_calisir set 
baslik=:baslik,

faliyet_id=:faliyet_id,
sira=:sira,
resim=:resim
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],

                'faliyet_id' => $_POST['faliyet_id'],
                'sira' => $_POST['sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($ekle) {

                // Yönlendirme işlemi
                header('Location: ../faliyetlerimiz_duzenle.php?faliyet_id=' . $_POST['faliyet_id'] . '&duzenle=ok');
            }

        }


    }
#faliyet sil
    if (isset($_GET['faliyetnasil_sil'])) {
        $sil = $db->prepare('delete from faliyet_nasil_calisir where id=:id');
        $sil->execute(array('id' => $_GET['selfId']));
        if ($sil) {
            unlink('../../../upload/faliyet/' . $_GET['faliyet_resim']);
            header('location:../faliyetlerimiz_duzenle.php?faliyet_id=' . $_GET['faliyet_id'] . '&sil=ok');
        }
    }
#faliyet guncelle
    if (isset($_POST['faliyetnasil_duzenleme'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/faliyet');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $duzenle = $db->prepare('update faliyet_nasil_calisir set
    sira=:sira,
    faliyet_id=:faliyet_id,

    baslik=:baslik,
    resim=:resim
    where id=:id
    ');
            $duzenle->execute(array(

                'sira' => $_POST['sira'],
                'faliyet_id' => $_POST['faliyet_id'],

                'baslik' => $_POST['baslik'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['selfID']
            ));
            if ($duzenle) {
                unlink('../../../upload/faliyet/' . $_POST['eski_resim']);
                header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
            }
        } else {
            $duzenle = $db->prepare('update faliyet_nasil_calisir set
        baslik=:baslik,

        faliyet_id=:faliyet_id,
    sira=:sira
    where id=:id
    ');
            echo $_POST['faliyeticerik_id'];
            $duzenle->execute(array(
                'sira' => $_POST['sira'],
                'faliyet_id' => $_POST['faliyet_id'],

                'baslik' => $_POST['baslik'],
                'id' => $_POST['selfID']
            ));
            if ($duzenle) {
                header('location:../faliyetlerimiz_duzenle.php?duzenle=ok&faliyet_id=' . $_POST['faliyet_id']);
            }
        }
    }

    if (isset($_POST['entegrasyon_header_guncelle'])) {
        $resim = new Upload($_FILES['entegrasyon_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['entegrasyon_baslik']);
            $resim->process('../../../upload/headersbg');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['entegrasyon_baslik']);
            $duzenle = $db->prepare('update header_resim set
    entegrasyon_baslik=:entegrasyon_baslik,
    entegrasyon_icerik=:entegrasyon_icerik,
    entegrasyon_resim=:entegrasyon_resim
    ');
            $duzenle->execute(array(

                'entegrasyon_baslik' => $_POST['entegrasyon_baslik'],
                'entegrasyon_icerik' => $_POST['entegrasyon_icerik'],
                'entegrasyon_resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($duzenle) {

                header('location:../header_resim_duzenle.php?duzenle=ok');

            }
        } else {
            $duzenle = $db->prepare('update header_resim set
          entegrasyon_baslik=:entegrasyon_baslik,
    entegrasyon_icerik=:entegrasyon_icerik
    ');

            $duzenle->execute(array(
                'entegrasyon_baslik' => $_POST['entegrasyon_baslik'],
                'entegrasyon_icerik' => $_POST['entegrasyon_icerik']
            ));
            if ($duzenle) {
                header('location:../header_resim_duzenle.php?duzenle=ok');
            }
        }
    }
    if (isset($_POST['referans_header_guncelle'])) {
        $resim = new Upload($_FILES['referans_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['referans_baslik']);
            $resim->process('../../../upload/headersbg');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['referans_baslik']);
            $duzenle = $db->prepare('update header_resim set
    referans_baslik=:referans_baslik,
    referans_icerik=:referans_icerik,
    referans_resim=:referans_resim
    ');
            $duzenle->execute(array(

                'referans_baslik' => $_POST['referans_baslik'],
                'referans_icerik' => $_POST['referans_icerik'],
                'referans_resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($duzenle) {

                header('location:../header_resim_duzenle.php?duzenle=ok');

            }
        } else {
            $duzenle = $db->prepare('update header_resim set
          referans_baslik=:referans_baslik,
    referans_icerik=:referans_icerik
    ');

            $duzenle->execute(array(
                'referans_baslik' => $_POST['referans_baslik'],
                'referans_icerik' => $_POST['referans_icerik']
            ));
            if ($duzenle) {
                header('location:../header_resim_duzenle.php?duzenle=ok');
            }
        }
    }
    if (isset($_POST['blog_header_guncelle'])) {
        $resim = new Upload($_FILES['blog_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['blog_baslik']);
            $resim->process('../../../upload/headersbg');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['blog_baslik']);
            $duzenle = $db->prepare('update header_resim set
    blog_baslik=:blog_baslik,
    blog_icerik=:blog_icerik,
    blog_resim=:blog_resim
    ');
            $duzenle->execute(array(

                'blog_baslik' => $_POST['blog_baslik'],
                'blog_icerik' => $_POST['blog_icerik'],
                'blog_resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($duzenle) {

                header('location:../header_resim_duzenle.php?duzenle=ok');

            }
        } else {
            $duzenle = $db->prepare('update header_resim set
          blog_baslik=:blog_baslik,
    blog_icerik=:blog_icerik
    ');

            $duzenle->execute(array(
                'blog_baslik' => $_POST['blog_baslik'],
                'blog_icerik' => $_POST['blog_icerik']
            ));
            if ($duzenle) {
                header('location:../header_resim_duzenle.php?duzenle=ok');
            }
        }
    }
    if (isset($_POST['iletisim_header_guncelle'])) {
        $resim = new Upload($_FILES['iletisim_resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['iletisim_baslik']);
            $resim->process('../../../upload/headersbg');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['iletisim_baslik']);
            $duzenle = $db->prepare('update header_resim set
    iletisim_baslik=:iletisim_baslik,
    iletisim_icerik=:iletisim_icerik,
    iletisim_resim=:iletisim_resim
    ');
            $duzenle->execute(array(

                'iletisim_baslik' => $_POST['iletisim_baslik'],
                'iletisim_icerik' => $_POST['iletisim_icerik'],
                'iletisim_resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($duzenle) {

                header('location:../header_resim_duzenle.php?duzenle=ok');

            }
        } else {
            $duzenle = $db->prepare('update header_resim set
          iletisim_baslik=:iletisim_baslik,
    iletisim_icerik=:iletisim_icerik
    ');

            $duzenle->execute(array(
                'iletisim_baslik' => $_POST['iletisim_baslik'],
                'iletisim_icerik' => $_POST['iletisim_icerik']
            ));
            if ($duzenle) {
                header('location:../header_resim_duzenle.php?duzenle=ok');
            }
        }
    }

    #urun ekle
    if (isset($_POST['basindabiz_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/basin');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $ekle = $db->prepare('insert into basindabiz set 
baslik=:baslik,
sira=:sira,
icerik=:icerik,
resim=:resim
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'sira' => $_POST['sira'],
                'icerik' => $_POST['icerik'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($ekle) {

                // Son eklenen kaydın id'sini al
                $lastId = $db->lastInsertId();

                // Yönlendirme işlemi
                header('Location: ../basindabiz_ekle.php?ok=ok');
            }

        }


    }
    if (isset($_GET['basindabiz_sil'])) {
        $basindasil = $db->prepare('delete from basindabiz where id=:id');
        $basindasil->execute(array('id' => $_GET['basindabiz_id']));
        if ($basindasil) {
            header('location:../basindabiz_liste.php?sil=ok');
            unlink('../../../upload/basin/' . $_GET['resim']);
        }
    }
#basindabiz düzenle
    if (isset($_POST['basindabiz_duzenle'])) {
        echo 'selam';
        $resimboyut = $_FILES['resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            $resim = new Upload($_FILES['resim']);
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/basin');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $basindaduzenle = $db->prepare('update basindabiz set 
baslik=:baslik,
icerik=:icerik,
sira=:sira,
resim=:resim
where id=:id
');
            $basindaduzenle->execute(array(
                'baslik' => $_POST['baslik'],
                'icerik' => $_POST['icerik'],
                'sira' => $_POST['sira'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['basindabiz_id']
            ));
            if ($basindaduzenle) {
//                echo  rseo($resim);
                header('location:../basindabiz_duzenle.php?ok=ok&basindabiz_id=' . $_POST['basindabiz_id']);
                unlink('../../../upload/basin/' . $_POST['eski_resim']);
            }

        } else {
            $basindaduzenle = $db->prepare('update basindabiz set 
baslik=:baslik,
icerik=:icerik,
sira=:sira
where id=:id
');
            $basindaduzenle->execute(array(
                'baslik' => $_POST['baslik'],
                'icerik' => $_POST['icerik'],
                'sira' => $_POST['sira'],

                'id' => $_POST['basindabiz_id']
            ));
            if ($basindaduzenle) {
                header('location:../basindabiz_duzenle.php?ok=ok&basindabiz_id=' . $_POST['basindabiz_id']);

            }
        }
    }
    #urun ekle
    if (isset($_POST['anasayfadortlu_ekle'])) {
        $resim = new Upload($_FILES['resim']);
        $hoverplay = new Upload($_FILES['hoverplay']);
        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/anasayfadortlu');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $hoverplay->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $hoverplay->process('../../../upload/anasayfadortlu');
            $hoverplayimage = $hoverplay->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $ekle = $db->prepare('insert into anasayfadortlu set 
baslik=:baslik,
sira=:sira,
hoverplay=:hoverplay,
urun_id=:urun_id,
resim=:resim
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'sira' => $_POST['sira'],
                'hoverplay' => $hoverplayimage . '.' . $hoverplay->file_dst_name_ext,
                'urun_id' => $_POST['urun_id'],
                'resim' => $image . '.' . $resim->file_dst_name_ext
            ));
            if ($ekle) {
                // Yönlendirme işlemi
                header('Location: ../anasayfadortlu_ekle.php?ok=ok');
            }

        }


    }
    if (isset($_GET['anasayfadortlu_sil'])) {
        $basindasil = $db->prepare('delete from anasayfadortlu where id=:id');
        $basindasil->execute(array('id' => $_GET['dortlu_id']));
        if ($basindasil) {
            header('location:../anasayfadortlu_liste.php?sil=ok');
            unlink('../../../upload/anasayfadortlu/' . $_GET['resim']);
        }
    }
#basindabiz düzenle
    if (isset($_POST['anasayfadortlu_duzenle'])) {
        $resim = new Upload($_FILES['resim']);

        if ($resim->uploaded) {
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/anasayfadortlu');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $ekle = $db->prepare('update anasayfadortlu set 
baslik=:baslik,
sira=:sira,
urun_id=:urun_id,
resim=:resim
where id=:id
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'sira' => $_POST['sira'],
                'urun_id' => $_POST['urun_id'],
                'resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['anasayfadortlu_id']
            ));


        }
        $hoverplay = new Upload($_FILES['hoverplay']);
        if ($resim->uploaded) {
            $hoverplay->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $hoverplay->process('../../../upload/anasayfadortlu');
            $hoverplayimage = $hoverplay->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $ekle = $db->prepare('update anasayfadortlu set 
baslik=:baslik,
sira=:sira,
urun_id=:urun_id,
hoverplay=:hoverplay
where id=:id
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'sira' => $_POST['sira'],
                'urun_id' => $_POST['urun_id'],
                'hoverplay' => $hoverplayimage . '.' . $hoverplay->file_dst_name_ext,
                'id' => $_POST['anasayfadortlu_id']
            ));
        }

        $ekle = $db->prepare('update anasayfadortlu set 
baslik=:baslik,
sira=:sira,
urun_id=:urun_id
where id=:id
');
        $ekle->execute(array(
            'baslik' => $_POST['baslik'],
            'sira' => $_POST['sira'],
            'urun_id' => $_POST['urun_id'],
            'id' => $_POST['anasayfadortlu_id']
        ));
        if ($ekle) {
            header('location:../anasayfadortlu_liste.php?ok=ok');

        }

    }

    #urun ekle
    if (isset($_POST['menu_ekle'])) {

        $ekle = $db->prepare('insert into menuler set 
baslik=:baslik,
icerik=:icerik
');
        $ekle->execute(array(
            'baslik' => $_POST['baslik'],
            'icerik' => $_POST['icerik']
        ));
        if ($ekle) {
            // Yönlendirme işlemi
            header('Location: ../menu_ekle.php?ok=ok');
        }


    }
    if (isset($_GET['menu_sil'])) {
        $sil = $db->prepare('delete from menuler where id=:id');
        $sil->execute(array('id' => $_GET['menu_id']));
        if ($sil) {
            header('location:../menu_liste.php?sil=ok');
        }
    }
#basindabiz düzenle
    if (isset($_POST['menu_duzenle'])) {


        $ekle = $db->prepare('update menuler set 
baslik=:baslik,
icerik=:icerik

where id=:id
');
        $ekle->execute(array(
            'baslik' => $_POST['baslik'],
            'icerik' => $_POST['icerik'],
            'id' => $_POST['menu_id']
        ));
        if ($ekle) {
            header('location:../menu_liste.php?ok=ok');

        }

    }


    #urun ekle
    if (isset($_POST['etkinlik_ekle'])) {
        $resimboyut = $_FILES['etkinlik_resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            $resim = new Upload($_FILES['etkinlik_resim']);
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/etkinlik');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);

            $resim_anasayfa = new Upload($_FILES['anasayfa_resim']);
            $sayi = rand(0, 99999);
            #upload
            $resim_anasayfa->allowed = array('image/*');
            $resim_anasayfa->image_convert = "webp";
            $resim_anasayfa->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim_anasayfa->process('../../../upload/etkinlik');
            $image_anasayfa = $resim_anasayfa->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $ekle = $db->prepare('insert into etkinlikler set
baslik=:baslik,
aciklama=:aciklama,
sira=:sira,
                        etkinlik_resim=:etkinlik_resim,
                        anasayfa_resim=:anasayfa_resim,
                        tarih=:tarih
');
            $ekle->execute(array(
                'baslik' => $_POST['baslik'],
                'aciklama' => $_POST['aciklama'],
                'sira' => $_POST['sira'],
                'etkinlik_resim' => $image . '.' . $resim->file_dst_name_ext,
                'anasayfa_resim' => $image_anasayfa . '.' . $resim_anasayfa->file_dst_name_ext,
                'tarih' => $_POST['tarih']
            ));
            if ($ekle) {
                $lastId = $db->lastInsertId();
                $aktifler = [];

                foreach ($_POST['sahneonu_menu_active'] as $menu_id => $value) {
                    // Sadece aktif (1) olan menüleri al
                    if ($value == 1) {
                        // Aktif menüyü $aktifler dizisine ekle
                        $aktifler[] = [
                            'menu_id' => $menu_id,
                            'tip' => 1, // Sabit bir tip değeri
                            'fiyat' => $_POST['sahneonu_menu'][$menu_id], // Fiyatı $_POST'dan alıyoruz
                            'etkinlik_id' => $lastId
                        ];
                    }
                }
                foreach ($_POST['ortamasalar_menu_active'] as $menu_id => $value) {
                    // Sadece aktif (1) olan menüleri al
                    if ($value == 1) {
                        // Aktif menüyü $aktifler dizisine ekle
                        $aktifler[] = [
                            'menu_id' => $menu_id,
                            'tip' => 2, // Sabit bir tip değeri
                            'fiyat' => $_POST['sahneonu_menu'][$menu_id], // Fiyatı $_POST'dan alıyoruz
                            'etkinlik_id' => $lastId
                        ];
                    }
                }
                foreach ($_POST['arkamasalar_menu_active'] as $menu_id => $value) {
                    // Sadece aktif (1) olan menüleri al
                    if ($value == 1) {
                        // Aktif menüyü $aktifler dizisine ekle
                        $aktifler[] = [
                            'menu_id' => $menu_id,
                            'tip' => 3, // Sabit bir tip değeri
                            'fiyat' => $_POST['sahneonu_menu'][$menu_id], // Fiyatı $_POST'dan alıyoruz
                            'etkinlik_id' => $lastId
                        ];
                    }
                }
                foreach ($_POST['localar_menu'] as $menu_id => $value) {
                    // Sadece aktif (1) olan menüleri al
                    if ($value == 1) {
                        // Aktif menüyü $aktifler dizisine ekle
                        $aktifler[] = [
                            'menu_id' => $menu_id,
                            'tip' => 4, // Sabit bir tip değeri
                            'fiyat' => $_POST['sahneonu_menu'][$menu_id], // Fiyatı $_POST'dan alıyoruz
                            'etkinlik_id' => $lastId
                        ];
                    }
                }
                foreach ($aktifler as $aktif) {
                    $ekle = $db->prepare('insert into etkinlik_menu_fiyat set
menu_id=:menu_id,
etkinlik_id=:etkinlik_id,
fiyat=:fiyat,
tip=:tip
');
                    $ekle->execute(array(
                        'menu_id' => $aktif['menu_id'],
                        'etkinlik_id' => $aktif['etkinlik_id'],
                        'fiyat' => $aktif['fiyat'],
                        'tip' => $aktif['tip']
                    ));
                }
                var_dump($aktifler);
                // Yönlendirme işlemi
                header('Location: ../etkinlik_liste.php?ok=ok');
            }


        }
    }
    if (isset($_POST['etkinlik_duzenle'])) {
        $resimboyut = $_FILES['etkinlik_resim']['size'];
        echo $resimboyut;
        if ($resimboyut > 0) {
            $resim = new Upload($_FILES['etkinlik_resim']);
            $sayi = rand(0, 99999);
            #upload
            $resim->allowed = array('image/*');
            $resim->image_convert = "webp";
            $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim->process('../../../upload/etkinlik');
            $image = $resim->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $ekle = $db->prepare('update etkinlikler set
etkinlik_resim=:etkinlik_resim
where id=:id
');
            $ekle->execute(array(
                'etkinlik_resim' => $image . '.' . $resim->file_dst_name_ext,
                'id' => $_POST['etkinlik_id']
            ));
        }
        $resimboyutanasayfa = $_FILES['etkinlik_resim']['size'];
        echo $resimboyut;
        if ($resimboyutanasayfa > 0) {
            $resim_anasayfa = new Upload($_FILES['anasayfa_resim']);
            $sayi = rand(0, 99999);
            #upload
            $resim_anasayfa->allowed = array('image/*');
            $resim_anasayfa->image_convert = "webp";
            $resim_anasayfa->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $resim_anasayfa->process('../../../upload/etkinlik');
            $image_anasayfa = $resim_anasayfa->file_new_name_body = rseo($sayi . '-' . $_POST['baslik']);
            $ekle = $db->prepare('update etkinlikler set
anasayfa_resim=:anasayfa_resim
where id=:id
');
            $ekle->execute(array(
                'anasayfa_resim' => $image_anasayfa . '.' . $resim_anasayfa->file_dst_name_ext,
                'id' => $_POST['etkinlik_id']
            ));

        }

        $ekle = $db->prepare('update etkinlikler set
baslik=:baslik,
aciklama=:aciklama,
sira=:sira,
tarih=:tarih
where id=:id
');
        $ekle->execute(array(
            'baslik' => $_POST['baslik'],
            'sira' => $_POST['sira'],
            'aciklama' => $_POST['aciklama'],
            'tarih' => $_POST['tarih'],
            'id' => $_POST['etkinlik_id']
        ));
        if ($ekle) {

            $aktifler = [];

            foreach ($_POST['sahneonu_menu_active'] as $menu_id => $value) {
                // Sadece aktif (1) olan menüleri al
                if ($value == 1) {
                    // Aktif menüyü $aktifler dizisine ekle
                    $aktifler[] = [
                        'menu_id' => $menu_id,
                        'tip' => 1, // Sabit bir tip değeri
                        'fiyat' => $_POST['sahneonu_menu'][$menu_id], // Fiyatı $_POST'dan alıyoruz
                        'etkinlik_id' =>$_POST['etkinlik_id']
                    ];
                }
            }
            foreach ($_POST['ortamasalar_menu_active'] as $menu_id => $value) {
                // Sadece aktif (1) olan menüleri al
                if ($value == 1) {
                    // Aktif menüyü $aktifler dizisine ekle
                    $aktifler[] = [
                        'menu_id' => $menu_id,
                        'tip' => 2, // Sabit bir tip değeri
                        'fiyat' => $_POST['sahneonu_menu'][$menu_id], // Fiyatı $_POST'dan alıyoruz
                        'etkinlik_id' =>$_POST['etkinlik_id']
                    ];
                }
            }
            foreach ($_POST['arkamasalar_menu_active'] as $menu_id => $value) {
                // Sadece aktif (1) olan menüleri al
                if ($value == 1) {
                    // Aktif menüyü $aktifler dizisine ekle
                    $aktifler[] = [
                        'menu_id' => $menu_id,
                        'tip' => 3, // Sabit bir tip değeri
                        'fiyat' => $_POST['sahneonu_menu'][$menu_id], // Fiyatı $_POST'dan alıyoruz
                        'etkinlik_id' => $_POST['etkinlik_id']
                    ];
                }
            }
            foreach ($_POST['localar_menu'] as $menu_id => $value) {
                // Sadece aktif (1) olan menüleri al
                if ($value == 1) {
                    // Aktif menüyü $aktifler dizisine ekle
                    $aktifler[] = [
                        'menu_id' => $menu_id,
                        'tip' => 4, // Sabit bir tip değeri
                        'fiyat' => $_POST['sahneonu_menu'][$menu_id], // Fiyatı $_POST'dan alıyoruz
                        'etkinlik_id' => $_POST['etkinlik_id']
                    ];
                }
            }
            $sil = $db->prepare('delete from etkinlik_menu_fiyat where etkinlik_id=:id');
            $sil->execute(array('id' => $_POST['etkinlik_id']));
            foreach ($aktifler as $aktif) {
                $ekle = $db->prepare('insert into etkinlik_menu_fiyat set
menu_id=:menu_id,
etkinlik_id=:etkinlik_id,
fiyat=:fiyat,
tip=:tip
');
                $ekle->execute(array(
                    'menu_id' => $aktif['menu_id'],
                    'etkinlik_id' => $aktif['etkinlik_id'],
                    'fiyat' => $aktif['fiyat'],
                    'tip' => $aktif['tip']
                ));
            }
            var_dump($aktifler);
            // Yönlendirme işlemi
            header('Location: ../etkinlik_liste.php?ok=ok');
        }


    }
    if (isset($_GET['etkinlik_sil'])) {
        $sil = $db->prepare('delete from etkinlikler where id=:id');
        $sil->execute(array('id' => $_GET['etkinlik_id']));
        if ($sil) {
            header('location:../etkinlik_liste.php?sil=ok');
        }
    }

}