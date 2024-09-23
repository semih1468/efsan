<?php
include 'baglan/baglan.php';


if (isset($_POST['id'])) {


    $ekle = $db->prepare('update rezervasyonlar set 
alinan_kapora=:alinan_kapora,
durum=:durum

where id=:id
');
    $ekle->execute(array(
        'alinan_kapora' => $_POST['alinan_kapora'],
        'durum' => $_POST['durum'],
        'id' => $_POST['id']
    ));
    if ($ekle) {
        echo '1';

    } else {
        echo '0';
    }

}