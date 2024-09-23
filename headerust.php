<?php session_start();
ob_start();
include 'admin/admin/baglan/baglan.php';
include 'seo.php';
$ayarcek = $db->prepare('select * from ayar');
$ayarcek->execute();
$ayar = $ayarcek->fetch(PDO::FETCH_ASSOC);
$header_resim_cek = $db->prepare('select * from header_resim');
$header_resim_cek->execute();
$header_resim = $header_resim_cek->fetch(PDO::FETCH_ASSOC);
$menucek = $db->prepare('select * from menu');
$menucek->execute();
$menu = $menucek->fetch(PDO::FETCH_ASSOC);
function tum_bosluk_sil($veri)
{
    $veri = str_replace("/s+/", "", $veri);
    $veri = str_replace(" ", "", $veri);
    $veri = str_replace(" ", "", $veri);
    $veri = str_replace(" ", "", $veri);
    $veri = str_replace("/s/g", "", $veri);
    $veri = str_replace("/s+/g", "", $veri);
    $veri = trim($veri);
    return $veri;
}

; ?>
<!DOCTYPE html>
<html lang="tr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <base href="<?php echo $ayar['ayar_site']?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Efşan Sahne, enfes lezzetlerin ve unutulmaz eğlencenin buluşma noktasıdır. Usta şeflerin hazırladığı lezzetli yemekler eşliğinde, canlı performanslar ve özel etkinliklerle dolu unutulmaz bir deneyim yaşayın.">
    <meta name="keywords" content="restoran, eğlence mekanı, canlı performanslar, parti mekanı, etkinlik mekanı, lezzetli yemekler, canlı müzik, özel etkinlikler, eğlence, sahne, konser, konserler">
    <title>Efşan Sahne</title>

    <link rel="stylesheet" href="assest/remixicon/4.2.0/remixicon.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&amp;display=swap" rel="stylesheet">
    <link href="assest/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assest/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="assest/fancybox/3.5.7/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="dist/assests/css/animate.min.css">
    <link rel="stylesheet" href="dist/assests/css/style.css">
    <link rel="stylesheet" href="dist/assests/css/custom.css">

    <style>
        :root {
            --poster-color: rgba(255, 255, 255, 0);
        }
    </style>