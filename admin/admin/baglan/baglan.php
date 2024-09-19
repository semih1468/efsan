<?php
try {
    $db = new PDO("mysql:host=localhost;charset=utf8;dbname=narposc1_sitebeta", "root", "");
    $db->exec('set names utf8');
} catch ( PDOException $e ){
    print $e->getMessage();
}
?>