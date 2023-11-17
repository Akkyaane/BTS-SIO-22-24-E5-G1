<?php

session_start();
include "../authentication/db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
    echo "<br><br><button><a href='../../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
} else {
    if (isset($_POST['submit'])) {
        $expenseSheet = [];
        $expenseSheet = [':sd' => $_POST['start_date'], ':ed' => $_POST['end_date'], ':nn' => $_POST['nights_number'], ':rd' => $_POST['request_date']];
        if (!empty($_POST['transport_category'])) {
            $expenseSheet[':tc'] = $_POST['transport_category'];
            if ($expenseSheet[':tc'] != 6) {
                if (!empty($_POST['transport_expense'])) {
                    $expenseSheet[':te'] = $_POST['transport_expense'];
                    $expenseSheet[':ke'] = NULL;
                }
                else {
                    echo "Vous avez sélectionné un mode de transport mais n'avez pas saisi de montant. Veuillez recommencer.";
                    echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
                }
            }
            else {
                if (!empty($_POST['kilometers_expense'])) {
                    $expenseSheet[':te'] = NULL;
                    $expenseSheet[':ke'] = $_POST['kilometers_expense'];
                }
                else {
                    echo "Vous avez sélectionné le mode de transport 'voiture' mais n'avez saisi aucune valeur dans le champ 'Nombres de kilomètres'. Veuillez recommencer.";
                    echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
                }
            }
        }
        else {
            $expenseSheet[':tc'] = NULL;
        }
        if (!empty($_POST[':accomodation_expense'])) {
            $expenseSheet[':ae'] = $_POST['accomadation_expense'];
        }
        else {
            $expenseSheet[':ae'] = NULL;
        }
        if (!empty($_POST['food_expense'])) {
            $expenseSheet[':fe'] = $_POST['food_expense'];
        }
        else {
            $expenseSheet[':fe'] = NULL;
        }
        if (!empty($_POST['other_expense'])) {
            $expenseSheet[':oe'] = $_POST['other_expense'];
            if (!empty($_POST['message'])) {
                $expenseSheet[':m'] = $_POST['message'];
            }
            else {
                echo "Vous avez saisi une valeur pour le champ 'Autres' mais pas de message. Veuillez recommencer.";
                echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
                die;
            }
        }
        else {
            $expenseSheet[':oe'] = NULL;
            $expenseSheet[':m'] = NULL;
        }
    
        // $transport_expense_file = $_FILES['transport_expense_file'];
        // $accommodation_expense_file = $_POST['accommodation_expense_file'];
        // $food_expense_file = $_POST['food_expense_file'];
        // $other_expense_file = $_POST['other_expense_file'];

        var_dump($expenseSheet);

        if (empty($expenseSheet[':ke']) && empty($expenseSheet[':te']) && empty($expenseSheet[':ae']) && empty($expenseSheet[':fe']) && empty($expenseSheet[':oe'])) {
            echo "Aucun montant n'a été saisi. Veuillez recommencer.";
            echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
        }
        else {
            $sql = 'INSERT INTO expenseSheets (start_date, end_date, nights_number, request_date, transport_category, kilometers_expense, transport_expense, accommodation_expense, food_expense, other_expense, message) VALUES (:sd, :ed, :nn, :rd, :tc, :ke, :te, :ae, :fe, :oe, :m)';
            $request = $db_connect->prepare($sql);
            $request->execute($expenseSheet);
            echo "Fiche de frais soumis";
            echo "<br><br><button><a href='../../views/visitor/home/visitorHome.php'>Retour à l'accueil</a></button>";
        }
    }
    else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
    }
}

?>
