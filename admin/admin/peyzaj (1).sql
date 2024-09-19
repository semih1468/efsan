-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 22 Tem 2018, 19:48:18
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `peyzaj`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `ayar_id` int(1) NOT NULL,
  `ayar_tel` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_mail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_face` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_twitter` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_youtube` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_ins` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_gsm` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_adres` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_description` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_keywords` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_logo` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_googlemaps` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_site` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`ayar_id`, `ayar_tel`, `ayar_mail`, `ayar_face`, `ayar_twitter`, `ayar_youtube`, `ayar_ins`, `ayar_gsm`, `ayar_adres`, `ayar_title`, `ayar_description`, `ayar_keywords`, `ayar_logo`, `ayar_googlemaps`, `ayar_site`) VALUES
(1, '32', '2@ad', '23', '2', '3', '223', '23', ' Kuruköprü Mahallesi, İnönü Cd. No:97, 01060 Seyhan/Adana', '32', '32', '23', '23', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d203936.69601391142!2d35.14798005452588!3d36.997606912192566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15288f5db1effca5%3A0x88a5b71d53e72c67!2zTWF2xLEgU8O8cm1lbMSxIEhvdGVs!5e0!3m2!1str!2str!4v1532183936923\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ekip`
--

CREATE TABLE `ekip` (
  `ekip_id` int(11) NOT NULL,
  `ekip_baslik` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ekip_resim` text COLLATE utf8_turkish_ci NOT NULL,
  `ekip_face` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ekip_twitter` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ekip_ins` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ekip`
--

INSERT INTO `ekip` (`ekip_id`, `ekip_baslik`, `ekip_resim`, `ekip_face`, `ekip_twitter`, `ekip_ins`) VALUES
(3, 'semih Koruyucu', '2943267928242629google-konum-ozelligini-kapatma-810x551-jpg', 'Semih koruyucu', 'Semih koruyucu', 'Semih koruyucu');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haber`
--

CREATE TABLE `haber` (
  `haber_id` int(11) NOT NULL,
  `haber_baslik` varchar(1500) COLLATE utf8_turkish_ci NOT NULL,
  `haber_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `haber_resim` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `haber`
--

INSERT INTO `haber` (`haber_id`, `haber_baslik`, `haber_icerik`, `haber_resim`) VALUES
(1, 'denemeaaaaaaaassssssssss', '<p>haberaaaaassssssssss</p>\r\n', '2742286529072692google-konum-ozelligini-kapatma-810x551-jpg'),
(3, 'asd', '<p>asdasd</p>\r\n', '2581297529242724road_png46-png'),
(4, 'asd', '<p>asd</p>\r\n', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hizmet`
--

CREATE TABLE `hizmet` (
  `hizmet_id` int(11) NOT NULL,
  `hizmet_baslik` varchar(1500) COLLATE utf8_turkish_ci NOT NULL,
  `hizmet_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `hizmet_resim` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hizmet`
--

INSERT INTO `hizmet` (`hizmet_id`, `hizmet_baslik`, `hizmet_icerik`, `hizmet_resim`) VALUES
(13, 'deneme', '<p>deasda</p>\r\n', '2999268028352685google-konum-ozelligini-kapatma-810x551-jpg'),
(14, 'asd', '<p>asdas</p>\r\n', '2902251526202943google-konum-ozelligini-kapatma-810x551-jpg'),
(15, 'asd', '<p>asddddddddddddddd</p>\r\n', '2766287829472802google-konum-ozelligini-kapatma-810x551-jpg'),
(16, 'asdasdasd', '<p>aaaaaaaaaaaaaaa</p>\r\n', '2809266028072785road_png46-png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurumsal`
--

CREATE TABLE `kurumsal` (
  `kurumsal_id` int(11) NOT NULL,
  `kurumsal_baslik` varchar(1500) COLLATE utf8_turkish_ci NOT NULL,
  `kurumsal_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `kurumsal_resim` varchar(1000) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kurumsal`
--

INSERT INTO `kurumsal` (`kurumsal_id`, `kurumsal_baslik`, `kurumsal_icerik`, `kurumsal_resim`) VALUES
(9, 'asd', '<p>sssssssssssssssssss</p>\r\n', ''),
(11, 'asd', 'asdsa', ''),
(12, 'asd', 'asdsa', ''),
(13, 'semih', 'semih', '2660254725552939google-konum-ozelligini-kapatma-810x551-jpg'),
(14, 'asd123', 'asd', '2774287429892876google-konum-ozelligini-kapatma-810x551-jpg'),
(15, 'asd', 'asd', '2700281627112628google-konum-ozelligini-kapatma-810x551-jpg'),
(16, 'asd123', 'asd123', '2760258325532962google-konum-ozelligini-kapatma-810x551-jpg'),
(17, 'asd123', 'asd', '2537258927622713google-konum-ozelligini-kapatma-810x551-jpg'),
(18, 'asdasd', '<p>asdasdas</p>\r\n', '2541274025852868google-konum-ozelligini-kapatma-810x551-jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

CREATE TABLE `mesaj` (
  `mesaj_id` int(11) NOT NULL,
  `mesaj_adsoyad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj_telefon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj_mail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj_konu` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj_icerik` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `mesaj`
--

INSERT INTO `mesaj` (`mesaj_id`, `mesaj_adsoyad`, `mesaj_telefon`, `mesaj_mail`, `mesaj_konu`, `mesaj_icerik`) VALUES
(1, 'aa', '05364911095', 'semihkoruyucu4@gmail.com', 'ssssssssssssssssssssssssssssssssssssssssssssss', 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `referans`
--

CREATE TABLE `referans` (
  `referans_id` int(11) NOT NULL,
  `referans_resim` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `referans`
--

INSERT INTO `referans` (`referans_id`, `referans_resim`) VALUES
(5, '2619250929152995road_png46-png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resim`
--

CREATE TABLE `resim` (
  `resim_id` int(11) NOT NULL,
  `kategoriust_id` int(11) NOT NULL,
  `resim_baslik` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `resim`
--

INSERT INTO `resim` (`resim_id`, `kategoriust_id`, `resim_baslik`) VALUES
(4, 2, '2903296028422542google-konum-ozelligini-kapatma-810x551-jpg'),
(5, 2, '2634267327862666road_png46-png'),
(6, 2, '2576276626732995google-konum-ozelligini-kapatma-810x551-jpg'),
(8, 3, '2543262925282567road_png46-png'),
(9, 3, '2988270629062652google-konum-ozelligini-kapatma-810x551-jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resim_kategori`
--

CREATE TABLE `resim_kategori` (
  `resimkategori_id` int(11) NOT NULL,
  `resimkategori_baslik` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `resimkategori_seo` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `resim_kategori`
--

INSERT INTO `resim_kategori` (`resimkategori_id`, `resimkategori_baslik`, `resimkategori_seo`) VALUES
(2, 'şşşşşşşşş23', 'sssssssss23'),
(3, 'deneme', 'deneme');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_resim` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_resim`) VALUES
(1, '2907264226802884google-konum-ozelligini-kapatma-810x551-jpg'),
(3, '2500279829932982slide1-jpg'),
(4, '2990290229522588slide2-jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `soru`
--

CREATE TABLE `soru` (
  `soru_id` int(11) NOT NULL,
  `soru_baslik` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `soru_icerik` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `soru`
--

INSERT INTO `soru` (`soru_id`, `soru_baslik`, `soru_icerik`) VALUES
(2, 'asdSSSSS', '<p>asdasdasSSSSSSSSS</p>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `video`
--

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL,
  `video_baslik` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `video_url` text COLLATE utf8_turkish_ci NOT NULL,
  `video_resim` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `video`
--

INSERT INTO `video` (`video_id`, `video_baslik`, `video_url`, `video_resim`) VALUES
(5, 'asd', 'https://www.youtube.com/watch?v=O7OgKHXaI8A', '2689266625442750road_png46-png'),
(6, 'video', 'https://www.youtube.com/watch?v=FSA8C-IcGdI', '2966290327692747google-konum-ozelligini-kapatma-810x551-jpg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `ekip`
--
ALTER TABLE `ekip`
  ADD PRIMARY KEY (`ekip_id`);

--
-- Tablo için indeksler `haber`
--
ALTER TABLE `haber`
  ADD PRIMARY KEY (`haber_id`);

--
-- Tablo için indeksler `hizmet`
--
ALTER TABLE `hizmet`
  ADD PRIMARY KEY (`hizmet_id`);

--
-- Tablo için indeksler `kurumsal`
--
ALTER TABLE `kurumsal`
  ADD PRIMARY KEY (`kurumsal_id`);

--
-- Tablo için indeksler `mesaj`
--
ALTER TABLE `mesaj`
  ADD PRIMARY KEY (`mesaj_id`);

--
-- Tablo için indeksler `referans`
--
ALTER TABLE `referans`
  ADD PRIMARY KEY (`referans_id`);

--
-- Tablo için indeksler `resim`
--
ALTER TABLE `resim`
  ADD PRIMARY KEY (`resim_id`);

--
-- Tablo için indeksler `resim_kategori`
--
ALTER TABLE `resim_kategori`
  ADD PRIMARY KEY (`resimkategori_id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Tablo için indeksler `soru`
--
ALTER TABLE `soru`
  ADD PRIMARY KEY (`soru_id`);

--
-- Tablo için indeksler `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayar`
--
ALTER TABLE `ayar`
  MODIFY `ayar_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `ekip`
--
ALTER TABLE `ekip`
  MODIFY `ekip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `haber`
--
ALTER TABLE `haber`
  MODIFY `haber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `hizmet`
--
ALTER TABLE `hizmet`
  MODIFY `hizmet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `kurumsal`
--
ALTER TABLE `kurumsal`
  MODIFY `kurumsal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tablo için AUTO_INCREMENT değeri `mesaj`
--
ALTER TABLE `mesaj`
  MODIFY `mesaj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `referans`
--
ALTER TABLE `referans`
  MODIFY `referans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `resim`
--
ALTER TABLE `resim`
  MODIFY `resim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `resim_kategori`
--
ALTER TABLE `resim_kategori`
  MODIFY `resimkategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `soru`
--
ALTER TABLE `soru`
  MODIFY `soru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
