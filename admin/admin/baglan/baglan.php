<?php
try {
    $db = new PDO("mysql:host=localhost;charset=utf8;dbname=efsan", "root", "");
    $db->exec('set names utf8');
} catch ( PDOException $e ){
    print $e->getMessage();
}
?>