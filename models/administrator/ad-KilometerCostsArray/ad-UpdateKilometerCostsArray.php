<?php

session_start();
include "../../db/db.php";
$id = $_GET["id"];
if (isset($_POST['submit'])) {
    $array = [];
    $array = [':h' => $_POST['horsepower'], ':c' => $_POST['cost']];

    if (empty($array[':h']) || empty($array[':c'])) {
        echo "L'un des champs est vide.";
        echo "<br><button><a href='../../../views/administrator/ad-functionalities/ad-UsersArray/ad-ManagePersonnalDataUser.php?updateid=$id'>Retour</a></button>";
    } else {
        $sql = 'UPDATE array SET horsepower=:h, cost=:c WHERE id=:id';
        $result = $dbConnect->prepare($sql);
        $result->bindParam(':h', $user[':h']);
        $result->bindParam(':c', $user[':c']);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        echo "Le tableau a été modifié.";
        echo "<br><br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";
    }
} else {
    echo "Un problème est survenu. Veuillez recommencer.";
    echo "<br><button><a href='../../../views/administrator/ad-functionalities/ad-UsersArray/ad-ManagePersonnalDataUser.php?updateid=$id'>Retour</a></button>";
}

?>