<?php

session_start();
include "../../db/db.php";

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM expenseSheets where id = ?";
    $request = $db_connect->prepare($sql);
    $request->bindParam(1, $id, PDO::PARAM_INT);
    $request->execute();
    if ($request) {
        echo "La fiche de frais a été supprimée.";
        echo "<br><br><button><a href='../../../views/visitor/v-home/v-home.php'>Retour</a></button>";
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><br><button><a href='../../../views/visitor/v-home/v-home.php'>Retour</a></button>";
    }
}
?>