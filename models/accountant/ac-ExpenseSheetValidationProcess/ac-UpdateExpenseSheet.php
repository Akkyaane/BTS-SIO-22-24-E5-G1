<?php

session_start();
$id = $_GET['updateid'];
include "../../db/db.php";
if (isset($_POST['validate_submit'])) {
    $expenseSheet = [];
    $expenseSheet = [':r' => NULL, ':ts' => 'Validée'];

    $sql = 'UPDATE expenseSheets SET remark=:r, treatment_status=:ts WHERE id=:id';
        $result = $db_connect->prepare($sql);
        $result->bindParam(':r', $expenseSheet[':r']);
        $result->bindParam(':ts', $expenseSheet[':ts']);
        $result->bindParam(':id', $id);
        $result->execute();
        echo "La fiche de frais a été traitée.";
        echo "<br><br><button><a href='../../../views/accountant/ac-home/ac-home.php'>Retour</a></button>";
} else if (isset($_POST['disprove_submit'])) {
    $expenseSheet = [];
    $expenseSheet = [':r' => $_POST['remark'], ':ts' => 'Refusée'];

    $sql = 'UPDATE expenseSheets SET remark=:r, treatment_status=:ts WHERE id=:id';
        $result = $db_connect->prepare($sql);
        $result->bindParam(':r', $expenseSheet[':r']);
        $result->bindParam(':ts', $expenseSheet[':ts']);
        $result->bindParam(':id', $id);
        $result->execute();
        echo "La fiche de frais a été traitée.";
        echo "<br><br><button><a href='../../../views/accountant/ac-home/ac-home.php'>Retour</a></button>";
} else {
    echo "Un problème est survenu. Veuillez recommencer.";
    echo "<br><button><a href='../../../views/accountant/ac-functionalities/ac-ExpenseSheetValidationProcess/ac-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
}

?>