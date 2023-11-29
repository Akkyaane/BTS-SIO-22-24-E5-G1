<?php

session_start();
$id = $_GET['updateid'];
include "../../db/db.php";
if (isset($_POST['validate_submit'])) {
    $treatment = [];
    $treatment = [':esi' => $id, ':s' => '1', ':r' => NULL];
    $sql = 'INSERT INTO treatment (expense_sheet_id, status, remark) VALUES (:esi, :s, :r)';
    $request = $db_connect->prepare($sql);
    $request->execute($treatment);
    echo "La fiche de frais a été traitée.";
    echo "<br><br><button><a href='../../../views/accountant/ac-home/ac-home.php'>Retour</a></button>";
} else if (isset($_POST['disprove_submit'])) {
    $treatment = [];
    $treatment = [':esi' => $id, ':s' => '0', ':r' => $_POST['remark']];
    $sql = 'INSERT INTO treatment (expense_sheet_id, status, remark) VALUES (:esi, :s, :r)';
    $request = $db_connect->prepare($sql);
    $request->execute($treatment);
    echo "La fiche de frais a été traitée.";
    echo "<br><br><button><a href='../../../views/accountant/ac-home/ac-home.php'>Retour</a></button>";
} else {
    echo "Un problème est survenu. Veuillez recommencer.";
    echo "<br><button><a href='../../../views/accountant/ac-functionalities/ac-ExpenseSheetValidationProcess/ac-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
}

?>