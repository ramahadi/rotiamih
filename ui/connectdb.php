<?php
//  $pdo = new PDO('mysql:host=localhost;dbname=u948825318_pos_barcode_db','u948825318_rotieskom','Hostinger365#');
//  echo 'connection success ciyeeee';// $pdo = new PDO('mysql:host=153.92.11.22;dbname=u948825318_pos_barcode_db','u948825318_rotieskom','Hostinger365#');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=u948825318_pos_barcode_db', 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
}
//  echo 'connection success ciyeeee';
