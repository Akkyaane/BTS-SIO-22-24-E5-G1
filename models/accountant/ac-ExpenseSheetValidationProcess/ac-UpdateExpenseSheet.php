<?php

session_start();
include "../../db/db.php";
if (isset($_POST['validate_submit'])) {
    $treatment = [];
    $treatment = [':esi' => $_GET['updateid'], ':s' => 1, ':r' => NULL];
    $sql = 'INSERT INTO treatment (expense_sheet_id, status, remark) VALUES (:esi, :s, :r)';
    $request = $dbConnect->prepare($sql);
    $request->execute($treatment);
    echo "La fiche de frais a été traitée.";
    echo "<br><br><button><a href='../../../views/accountant/ac-home/ac-home.php'>Retour</a></button>";
} else if (isset($_POST['disprove_submit'])) {
    $treatment = [];
    $treatment = [':esi' => $_GET['updateid'], ':s' => 2, ':r' => $_POST['remark']];
    $sql = 'INSERT INTO treatment (expense_sheet_id, status, remark) VALUES (:esi, :s, :r)';
    $request = $dbConnect->prepare($sql);
    $request->execute($treatment);
    echo "La fiche de frais a été traitée.";
    echo "<br><br><button><a href='../../../views/accountant/ac-home/ac-home.php'>Retour</a></button>";
} else {
    echo "Un problème est survenu. Veuillez recommencer.";
    echo "<br><button><a href='../../../views/accountant/ac-functionalities/ac-ExpenseSheetValidationProcess/ac-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
}

?>