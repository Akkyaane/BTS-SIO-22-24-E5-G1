<?php

session_start();
include "../../db/db.php";

$id = $_GET['updateid'];
if (isset($_POST['validate_submit'])) {
    $treatment = [];
    $treatment = [':esi' => $id, ':s' => 1, ':r' => NULL];
    $sql = 'INSERT INTO treatment (expense_sheet_id, status, remark) VALUES (:esi, :s, :r)';
    $request = $dbConnect->prepare($sql);
    $request->execute($treatment);
    echo "La fiche de frais a été traitée.";
    echo "<br><br><button><a href='../../../views/accountant/ac-home/ac-home.php'>Retour</a></button>";
} else if (isset($_POST['disprove_submit'])) {
    if (empty($_POST['remark'])) {
        echo "Vous devez fournir les détails du refus.";
        echo "<br><button><a href='../../../views/accountant/ac-functionalities/ac-ExpenseSheetValidationProcess/ac-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
    } else {
        $treatment = [];
        $treatment = [':esi' => $id, ':s' => 2, ':r' => $_POST['remark']];
        $sql = 'INSERT INTO treatment (expense_sheet_id, status, remark) VALUES (:esi, :s, :r)';
        $request = $dbConnect->prepare($sql);
        $request->execute($treatment);
        echo "La fiche de frais a été traitée.";
        echo "<br><br><button><a href='../../../views/accountant/ac-home/ac-home.php'>Retour</a></button>";
    }
} else {
    echo "Un problème est survenu. Veuillez recommencer.";
    echo "<br><button><a href='../../../views/accountant/ac-functionalities/ac-ExpenseSheetValidationProcess/ac-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
}

?>