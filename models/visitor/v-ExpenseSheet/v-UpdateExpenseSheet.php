<?php

session_start();
$id = $_GET['updateid'];
include "../../db/db.php";
if (isset($_POST['submit'])) {
    $expenseSheet = [];
    $expenseSheet = [':e' => $_SESSION['email'], ':sd' => $_POST['start_date'], ':ed' => $_POST['end_date'], ':nn' => $_POST['nights_number'], ':rd' => $_POST['request_date']];
    if (!empty($_POST['transport_category'])) {
        $expenseSheet[':tc'] = $_POST['transport_category'];
        if ($expenseSheet[':tc'] != 4) {
            if (!empty($_POST['transport_expense'])) {
                $expenseSheet[':te'] = $_POST['transport_expense'];
                $expenseSheet[':ke'] = NULL;
            } else {
                echo "Vous avez sélectionné un mode de transport mais n'avez pas saisi de montant. Veuillez recommencer.";
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
            }
        } else {
            if (!empty($_POST['kilometers_expense'])) {
                $expenseSheet[':te'] = NULL;
                $expenseSheet[':ke'] = $_POST['kilometers_expense'];
            } else {
                echo "Vous avez sélectionné le mode de transport 'voiture' mais n'avez saisi aucune valeur dans le champ 'Nombres total de kilomètres'. Veuillez recommencer.";
                echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
            }
        }
    } else {
        $expenseSheet[':tc'] = NULL;
    }
    if (!empty($_POST['accommodation_expense'])) {
        $expenseSheet[':ae'] = $_POST['accommodation_expense'];
    } else {
        $expenseSheet[':ae'] = NULL;
    }
    if (!empty($_POST['food_expense'])) {
        $expenseSheet[':fe'] = $_POST['food_expense'];
    } else {
        $expenseSheet[':fe'] = NULL;
    }
    if (!empty($_POST['other_expense'])) {
        $expenseSheet[':oe'] = $_POST['other_expense'];
        if (!empty($_POST['message'])) {
            $expenseSheet[':m'] = $_POST['message'];
        } else {
            echo "Vous avez saisi une valeur pour le champ 'Autres' mais pas de message. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
        }
    } else {
        $expenseSheet[':oe'] = NULL;
        $expenseSheet[':m'] = NULL;
    }

    // $transport_expense_file = $_FILES['transport_expense_file'];
    // $accommodation_expense_file = $_POST['accommodation_expense_file'];
    // $food_expense_file = $_POST['food_expense_file'];
    // $other_expense_file = $_POST['other_expense_file'];

    if (empty($expenseSheet[':ke']) && empty($expenseSheet[':te']) && empty($expenseSheet[':ae']) && empty($expenseSheet[':fe']) && empty($expenseSheet[':oe'])) {
        echo "Aucun montant n'a été saisi. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
    } else {
        $sql = 'UPDATE expenseSheets SET email=:e, start_date=:sd, end_date=:ed, nights_number=:nn, request_date=:rd, transport_category=:tc, kilometers_expense=:ke, transport_expense=:te, accommodation_expense=:ae, food_expense=:fe, other_expense=:oe, message=:m WHERE id=:id';
        $result = $db_connect->prepare($sql);
        $result->bindParam(':e', $expenseSheet[':e']);
        $result->bindParam(':sd', $expenseSheet[':sd']);
        $result->bindParam(':ed', $expenseSheet[':ed']);
        $result->bindParam(':nn', $expenseSheet[':nn']);
        $result->bindParam(':rd', $expenseSheet[':rd']);
        $result->bindParam(':tc', $expenseSheet[':tc']);
        $result->bindParam(':ke', $expenseSheet[':ke']);
        $result->bindParam(':te', $expenseSheet[':te']);
        $result->bindParam(':ae', $expenseSheet[':ae']);
        $result->bindParam(':fe', $expenseSheet[':fe']);
        $result->bindParam(':oe', $expenseSheet[':oe']);
        $result->bindParam(':m', $expenseSheet[':m']);
        $result->bindParam(':id', $id);
        $result->execute();
        echo "La fiche de frais a été modifiée.";
        echo "<br><br><button><a href='../../../views/visitor/v-home/v-home.php'>Retour</a></button>";
    }
} else {
    echo "Un problème est survenu. Veuillez recommencer.";
    echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=$id'>Retour</a></button>";
}

?>