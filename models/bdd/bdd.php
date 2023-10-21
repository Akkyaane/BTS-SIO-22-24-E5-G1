<?php

    // try {
    // $connection = new PDO('mysql:host=localhost:8889; dbname=db_gsb; charset=utf8', 'root', 'root');
    // }

    // catch (Exception $e) {
    // die('Erreur : ' . $e->getMessage());
    // }

     try {
         $db_connect = new PDO('mysql:host=localhost:3306; dbname=db_gsb; charset=utf8', 'root');
         echo "Connexion réussie. ";
         var_dump($db_connect);
     }

     catch (Exception $e) {
         die('Erreur : ' . $e->getMessage());
     }

?>
