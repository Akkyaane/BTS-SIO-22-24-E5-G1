<?php

session_start();
include "../authentication/db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
} else {
    $target_dir = "../../content/uploads/";
    if (isset($_POST['submit'])) {   
        $expenseSheet = [];
        $expenseSheet = [':e' => $_SESSION['email'], ':sd' => $_POST['start_date'], ':ed' => $_POST['end_date'], ':nn' => $_POST['nights_number'], ':rd' => $_POST['request_date']];
        if (!empty($_POST['transport_category'])) {
            $expenseSheet[':tc'] = $_POST['transport_category'];
            if ($expenseSheet[':tc'] != 4) {
                if (!empty($_POST['transport_expense'])) {
                    $expenseSheet[':te'] = $_POST['transport_expense'];
                    $transport_expense_file = $target_dir.basename($_FILES["transport_expense_file"]["name"]);
                    $expenseSheet[':ke'] = NULL;
                } else {
                    echo "Vous avez sélectionné un mode de transport mais n'avez pas saisi de montant. Veuillez recommencer.";
                    echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
                }
            } else {
                if (!empty($_POST['kilometers_expense'])) {
                    $expenseSheet[':te'] = NULL;
                    $expenseSheet[':ke'] = $_POST['kilometers_expense'];
                } else {
                    echo "Vous avez sélectionné le mode de transport 'voiture' mais n'avez saisi aucune valeur dans le champ 'Nombres total de kilomètres'. Veuillez recommencer.";
                    echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
                }
            }
        } else {
            $expenseSheet[':tc'] = NULL;
        }
        if (!empty($_POST['accommodation_expense'])) {
            $expenseSheet[':ae'] = $_POST['accommodation_expense'];
            $accommodation_expense_file = $target_dir . basename($_FILES["accommodation_expense_file"]["name"]);
        } else {
            $expenseSheet[':ae'] = NULL;
        }
        if (!empty($_POST['food_expense'])) {
            $expenseSheet[':fe'] = $_POST['food_expense'];
            $food_expense_file = $target_dir . basename($_FILES["food_expense_file"]["name"]);
        } else {
            $expenseSheet[':fe'] = NULL;
        }
        if (!empty($_POST['other_expense'])) {
            $expenseSheet[':oe'] = $_POST['other_expense'];
            $other_expense_file = $target_dir . basename($_FILES["other_expense_file"]["name"]);
            if (!empty($_POST['message'])) {
                $expenseSheet[':m'] = $_POST['message'];
            } else {
                echo "Vous avez saisi une valeur pour le champ 'Autres' mais pas de message. Veuillez recommencer.";
                echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
                die;
            }
        } else {
            $expenseSheet[':oe'] = NULL;
            $expenseSheet[':m'] = NULL;
        }

        $imageFileType1 = strtolower(pathinfo($transport_expense_file,PATHINFO_EXTENSION));
        $imageFileType2 = strtolower(pathinfo($accommodation_expense_file,PATHINFO_EXTENSION));
        $imageFileType3 = strtolower(pathinfo($food_expense_file,PATHINFO_EXTENSION));
        $imageFileType4 = strtolower(pathinfo($other_expense_file,PATHINFO_EXTENSION));
        $uploadOk = 1;
    
        if (empty($expenseSheet[':ke']) && empty($expenseSheet[':te']) && empty($expenseSheet[':ae']) && empty($expenseSheet[':fe']) && empty($expenseSheet[':oe'])) {
            echo "Aucun montant n'a été saisi. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
        } elseif ((!empty($expenseSheet[':te']) && (empty($transport_expense_file))) || (!empty($expenseSheet[':ae']) && (empty($accommodation_expense_file))) || (!empty($expenseSheet[':fe']) && (empty($food_expense_file))) || (!empty($expenseSheet[':oe']) &&  (empty($other_expense_file)))) {
            echo "Un ou plusieurs justificatifs sont manquants. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
        } else if (file_exists($transport_expense_file) || file_exists($accommodation_expense_file) || file_exists($food_expense_file) || file_exists($other_expense_file)) {
                echo "Un ou plusieurs fichiers existent déjà.";
                $uploadOk = 0;
        } else if ($_FILES["transport_expense_file"]["size"] > 2097152 || $_FILES["accommodation_expense_file"]["size"] > 2097152 || $_FILES["food_expense_file"]["size"] > 2097152 || $_FILES["other_expense_file"]["size"] > 2097152) {
                echo "La taille d'un ou plusieurs fichiers est trop grande. Veuillez recommencer.";
                $uploadOk = 0;
        } else {
            if (move_uploaded_file($_FILES["transport_expense_file"]["tmp_name"], $transport_expense_file)) {
                echo "Le fichier ". htmlspecialchars( basename( $_FILES["transport_expense_file"]["name"])). " a été soumis.";
                } else {
                echo "Le fichier n'a pas pu être soumis.";
                }
                if (move_uploaded_file($_FILES["accommodation_expense_file"]["tmp_name"], $accommodation_expense_file)) {
                    echo "Le fichier ". htmlspecialchars( basename( $_FILES["accommodation_expense_file"]["name"])). " a été soumis.";
                } else {
                    echo "Le fichier n'a pas pu être soumis.";
                }
                if (move_uploaded_file($_FILES["food_expense_file"]["tmp_name"], $food_expense_file)) {
                    echo "Le fichier ". htmlspecialchars( basename( $_FILES["food_expense_file"]["name"])). " a été soumis.";
                } else {
                    echo "Le fichier n'a pas pu être soumis.";
                }
                if (move_uploaded_file($_FILES["other_expense_file"]["tmp_name"], $other_expense_file)) {
                    echo "Le fichier ". htmlspecialchars( basename( $_FILES["other_expense_file"]["name"])). " a été soumis.";
                } else {
                    echo "Le fichier n'a pas pu être soumis.";
                }
            $sql = 'INSERT INTO expenseSheets (email, start_date, end_date, nights_number, request_date, transport_category, kilometers_expense, transport_expense, accommodation_expense, food_expense, other_expense, message) VALUES (:e, :sd, :ed, :nn, :rd, :tc, :ke, :te, :ae, :fe, :oe, :m)';
            $request = $db_connect->prepare($sql);
            $request->execute($expenseSheet);
            echo "Fiche de frais soumis";
            echo "<br><br><button><a href='../../../views/visitor/v-home/v-home.php'>Retour</a></button>";
        }
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/visitor/v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php'>Retour</a></button>";
    }
}

?>