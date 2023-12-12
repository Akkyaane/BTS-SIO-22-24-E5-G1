<?php

session_start();
include "../../db/db.php";

if (isset($_POST['submit'])) {
    $array = [];
    $array = [':h' => $_POST['horsepower'], ':c' => $_POST['cost']];

    if (empty($array[':h']) || empty($array[':c'])) {
        echo "Un des champs est vide.";
        echo "<br><button><a href='../../../views/administrator/ad-functionalities/ad-KilometerCostsArray/ad-UpdateKilometerCostsArray.php'>Retour</a></button>";
    } else {
        $sql = 'UPDATE kilometercosts SET horsepower=:h, cost=:c';
        $result = $dbConnect->prepare($sql);
        $result->bindParam(':h', $user[':h']);
        $result->bindParam(':c', $user[':c']);
        $result->execute();
        echo "Le tableau a été modifié.";
        echo "<br><br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";
    }
} else {
    echo "Un problème est survenu. Veuillez recommencer.";
    echo "<br><button><a href='../../../views/administrator/ad-functionalities/ad-KilometerCostsArray/ad-UpdateKilometerCostsArray.php'>Retour</a></button>";
}

?>