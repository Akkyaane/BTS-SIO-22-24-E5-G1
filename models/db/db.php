<?php

//MAMP
try {
    $db_connect = new PDO('mysql:host=localhost:8889; dbname=db_gsb; charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//WAMP
// try {
//     $db_connect = new PDO('mysql:host=localhost:3306; dbname=db_gsb; charset=utf8', 'root', '');
// } catch (Exception $e) {
//     die('Erreur : ' . $e->getMessage());
// }

?>