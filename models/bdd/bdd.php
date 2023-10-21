<?php
    try {
    $connection = new PDO('mysql:host=localhost:8889; dbname=db_gsb; charset=utf8', 'root', 'root');
    }

    catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
    }
?>