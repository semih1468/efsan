<?php

try {

    $db = new PDO('mysql:host=localhost;dbname=ucuzwebs_itesi;charset=utf8;', 'ucuzwebs_itesi', '369258147s');

}catch (PDOException $e){

    print $e->getMessage();

}



?>