<?php

session_start();
include "../../db/db.php";

if (isset($_POST['submit'])) {
    $horsepowers = $_POST['horsepower'];
    $costs = $_POST['cost'];
    $id = 0;
    if (count($horsepowers) === count($costs)) {
        $count = count($horsepowers);
        for ($i = 0; $i < $count; $i++) {
            $h = $horsepowers[$i];
            $c = $costs[$i];
            $id++;
            $sql = 'UPDATE kilometercosts SET horsepower = :h, cost = :c WHERE id = :id';
            $result = $dbConnect->prepare($sql);
            $result->bindParam(':h', $h);
            $result->bindParam(':c', $c);
            $result->bindParam(':id', $id);
            $result->execute();
        }
        echo "Le tableau a été modifié.";
        echo "<br><br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";
    } else {
        echo "Un des champs est vide.";
        echo "<br><button><a href='../../../views/administrator/ad-functionalities/ad-KilometerCostsArray/ad-UpdateKilometerCostsArray.php'>Retour</a></button>";
    }
} else {
    echo "Un problème est survenu. Veuillez recommencer.";
    echo "<br><button><a href='../../../views/administrator/ad-functionalities/ad-KilometerCostsArray/ad-UpdateKilometerCostsArray.php'>Retour</a></button>";
}

?>