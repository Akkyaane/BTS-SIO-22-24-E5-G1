<?php

session_start();
include "../authentication/db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
    echo "<br><br><button><a href='../../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
} else {
    if (isset($_POST['submit'])) {
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $email = $_POST['email'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $request_date = $_POST['request_date'];
        $transport_expense = $_POST['transport_expense'];
        // $transport_expense_file = $_FILES['transport_expense_file'];
        $accommodation_expense = $_POST['accommodation_expense'];
        // $accommodation_expense_file = $_POST['accommodation_expense_file'];
        $food_expense = $_POST['food_expense'];
        // $food_expense_file = $_POST['food_expense_file'];
        $events_expense = $_POST['events_expense'];
        // $events_expense_file = $_POST['events_expense_file'];
        $other_expense = $_POST['other_expense'];
        // $other_expense_file = $_POST['other_expense_file'];
        $message = $_POST['message'];

        $emptyCount = 0;

        if (empty($transport_expense)) {
            $emptyCount++;
        }
        if (empty($accommodation_expense)) {
            $emptyCount++;
        }
        if (empty($food_expense)) {
            $emptyCount++;
        }
        if (empty($events_expense)) {
            $emptyCount++;
        }
        if (empty($other_expense)) {
            $emptyCount++;
        }

        if (empty($last_name) || empty($first_name) || empty($email) || empty($start_date) || empty($end_date) || empty($request_date)) {
            echo "Un ou plusieurs champs sont vides. Veuillez remplir les informations manquantes.";
            echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
            }
        elseif ($emptyCount == 5) {
            echo "Aucun montant saisi. Veuillez recommencer.";
            echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
        }
        elseif (isset($other_expense) && !isset($message)) {
            echo "Vous n'avez pas saisi de message. Veuillez recommencer.";
            echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
        }
        else {
            $request = $db_connect->prepare('INSERT INTO expenseSheets (last_name, first_name, email, start_date, end_date, request_date, transport_expense, accommodation_expense, food_expense, events_expense, other_expense, message) VALUES (:ln, :fn, :e, :st, :ed, :rd, :te, :ae, :fe, :ee, :oe, :m)');
            $request->execute(['ln' => $last_name, 'fn' => $first_name, 'e' => $email, 'st' => $start_date, 'ed' => $end_date, 'rd' => $request_date, 'te' => $transport_expense, 'ae' => $accommodation_expense, 'fe' => $food_expense, 'ee' => $events_expense, 'oe' => $other_expense, 'm' => $message]);
            echo "Fiche de frais soumis";
            echo "<br><br><button><a href='../../views/visitor/home/visitorHome.php'>Retour à l'accueil</a></button>";
        }
    } else {
        echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
        echo "<br><br><button><a href='../../views/visitor/documents/addExpenseSheet.php'>Retour</a></button>";
    }
}

?>
