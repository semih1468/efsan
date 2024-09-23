<?php
include 'admin/admin/baglan/baglan.php';

// POST ile gelen verileri al
$rezervasyon_name = $_POST['rezervasyon_name'];
$rezervasyon_phone = $_POST['rezervasyon_phone'];
$rezervasyon_email = $_POST['rezervasyon_email'];
$rezervasyon_menu = $_POST['rezervasyon_menu'];
$rezervasyon_arrival = $_POST['rezervasyon_arrival'];
$rezervasyon_etkinlik = $_POST['rezervasyon_etkinlik'];
$rezervasyon_kisisayisi = $_POST['rezervasyon_kisisayisi'];
$rezervasyon_masano = $_POST['rezervasyon_masano'];
$rezervasyon_not = $_POST['rezervasyon_not'] ?? ''; // Eğer boşsa boş string ata
$rezervasyon_fiyat = $_POST['rezervasyon_fiyat'];
$rezervasyon_kapora = $_POST['rezervasyon_kapora'];
$rezervasyon_onay = $_POST['rezervasyon_onay'];

// Veritabanına ekleme sorgusu
$ekle = $db->prepare('INSERT INTO rezervasyonlar (
    adsoyad, telefon, mail, menu_id, 
    saat, etkinlik_id, kisi_sayisi, 
    masa, note, ucret, kapora, durum
) VALUES (
    :rezervasyon_name, :rezervasyon_phone, :rezervasyon_email, :rezervasyon_menu, 
    :rezervasyon_arrival, :rezervasyon_etkinlik, :rezervasyon_kisisayisi, 
    :rezervasyon_masano, :rezervasyon_not, :rezervasyon_fiyat, :rezervasyon_kapora, :rezervasyon_onay
)');

// Verileri sorguya bağla ve çalıştır
$ekle->execute(array(
    ':rezervasyon_name' => $rezervasyon_name,
    ':rezervasyon_phone' => $rezervasyon_phone,
    ':rezervasyon_email' => $rezervasyon_email,
    ':rezervasyon_menu' => $rezervasyon_menu,
    ':rezervasyon_arrival' => $rezervasyon_arrival,
    ':rezervasyon_etkinlik' => $rezervasyon_etkinlik,
    ':rezervasyon_kisisayisi' => $rezervasyon_kisisayisi,
    ':rezervasyon_masano' => $rezervasyon_masano,
    ':rezervasyon_not' => $rezervasyon_not,
    ':rezervasyon_fiyat' => $rezervasyon_fiyat,
    ':rezervasyon_kapora' => $rezervasyon_kapora,
    ':rezervasyon_onay' => $rezervasyon_onay
));

// Eğer ekleme başarılıysa
if ($ekle) {
    echo "1";
} else {
    echo "Rezervasyon eklenirken bir hata oluştu.";
}

?>