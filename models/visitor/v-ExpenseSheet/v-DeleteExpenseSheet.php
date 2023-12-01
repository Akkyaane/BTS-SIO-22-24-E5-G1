<?php

session_start();
include "../../db/db.php";

if (isset($_GET['deleteid'])) {
    $sql = "DELETE FROM expenseSheets where id = ?";
    $request = $dbConnect->prepare($sql);
    $request->bindParam(1, $_GET['deleteid'], PDO::PARAM_INT);
    $request->execute();
    if ($request) {
        echo "La fiche de frais a été supprimée.";
        echo "<br><br><button><a href='../../../views/visitor/v-home/v-home.php'>Retour</a></button>";
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><br><button><a href='../../../views/visitor/v-home/v-home.php'>Retour</a></button>";
    }
}
