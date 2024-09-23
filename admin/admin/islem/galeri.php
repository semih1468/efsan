<?php 

ob_start();

session_start();

include '../baglan/baglan.php'; include 'resimseo.php';
include 'class.upload.php';




if (!empty($_FILES)) {

    $resim = new Upload($_FILES['file']);
    $sayi = rand(0, 99999);
    #upload
    $resim->allowed = array('image/*');
    if ()
    $resim->image_convert = "webp";
    $resim->file_new_name_body = rseo($sayi . '-' . $_FILES['file']["name"]);
    $resim->process('../../../upload/resim');
    $image = $resim->file_new_name_body = rseo($sayi . '-' . $_FILES['file']["name"]);
    echo $image;
    echo '$image';
	$kaydet=$db->prepare("insert into resim set

		resim_baslik=:baslik
	
");

	$insert=$kaydet->execute(array(

		'baslik' => $image . '.' . $resim->file_dst_name_ext


		));



}







?>