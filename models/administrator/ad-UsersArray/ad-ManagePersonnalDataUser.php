<?php

session_start();
$id = $_GET['updateid'];
include "../../db/db.php";
if (isset($_POST['edit_submit'])) {
    $user = [];
    $user = [':fn' => $_POST['first_name'], ':ln' => $_POST['last_name'], ':e' => $_POST['email'], ':r' => $_POST['role'], ':h' => $_POST['horsepower']];

    if (empty($user[':fn']) || empty($user[':ln']) || empty($user[':e']) || empty($user[':r']) || empty($user[':h'])) {
        echo "Un des champs est vide.";
        echo "<br><button><a href='../../../views/administrator/ad-functionalities/ad-UsersArray/ad-ManagePersonnalDataUser.php?updateid=$id'>Retour</a></button>";
    } else {
        $sql = 'UPDATE users SET first_name=:fn, last_name=:ln, email=:e, role=:r, horsepower=:h WHERE id=:id';
        $result = $dbConnect->prepare($sql);
        $result->bindParam(':fn', $user[':fn']);
        $result->bindParam(':ln', $user[':ln']);
        $result->bindParam(':e', $user[':e']);
        $result->bindParam(':r', $user[':r']);
        $result->bindParam(':h', $user[':h']);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        echo "Les données de l'utilisateur ont été modifiées.";
        echo "<br><br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";
    }
} else {
    echo "Un problème est survenu. Veuillez recommencer.";
    echo "<br><button><a href='../../../views/administrator/ad-functionalities/ad-UsersArray/ad-ManagePersonnalDataUser.php?updateid=$id'>Retour</a></button>";
}

?>