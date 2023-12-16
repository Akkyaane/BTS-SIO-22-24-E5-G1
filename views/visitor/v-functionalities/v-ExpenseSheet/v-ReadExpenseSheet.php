<?php

session_start();
include "../../../../models/db/db.php";

if (!$dbConnect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../v-home/v-home.php'>Retour</a></button>";
} else {
    $sql = 'SELECT * FROM expensesheets where id = ?';
    $expense_sheets_data_request = $dbConnect->prepare($sql);
    $expense_sheets_data_request->bindParam(1, $_GET['readid'], PDO::PARAM_INT);
    $expense_sheets_data_request->execute();
    $expense_sheets_data = $expense_sheets_data_request->fetch(PDO::FETCH_ASSOC);
    if ($expense_sheets_data) {
        $sql = 'SELECT e.*, r.* FROM expensesheets e INNER JOIN receipts r ON e.receipts_id = r.id where e.id = ?';
        $receipts_data_request = $dbConnect->prepare($sql);
        $receipts_data_request->bindParam(1, $_GET['readid'], PDO::PARAM_INT);
        $receipts_data_request->execute();
        $receipts_data = $receipts_data_request->fetch(PDO::FETCH_ASSOC);
    }
    if ($expense_sheets_data) {
        $sql = 'SELECT * FROM treatment where expense_sheet_id = ?';
        $treatment_data_request = $dbConnect->prepare($sql);
        $treatment_data_request->bindParam(1, $_GET['readid'], PDO::PARAM_INT);
        $treatment_data_request->execute();
        $treatment_data = $treatment_data_request->fetch(PDO::FETCH_ASSOC);
    }
    $startDate = new DateTime($expense_sheets_data['start_date']);
    $endDate = new DateTime($expense_sheets_data['end_date']);
    $requestDate = new DateTime($expense_sheets_data['request_date']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB - Consultation d'une fiche de frais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header class="bg-primary text-white text-center py-4">
        <h1 class="text-center">Consulter une fiche de frais</h1>
    </header>
    <main>
        <div class="container mt-4">
            <div class="mt-3">
                <h3>Informations générales</h3>
                <p>Demande effectuée le :
                    <?php echo $startDate->format('d/m/Y'); ?>
                </p>
                <p>Date de départ :
                    <?php echo $endDate->format('d/m/Y'); ?>
                </p>
                <p>Date de retour :
                    <?php echo $requestDate->format('d/m/Y'); ?>
                </p>
            </div>
            <div class="mt-3">
                <h3>Frais</h3>
                <h4>Transport</h4>
                <p>Type de transport :
                    <?php if ($expense_sheets_data['transport_category'] == '1') {
                        echo "Avion";
                    } else if ($expense_sheets_data['transport_category'] == '2') {
                        echo "Train";
                    } else if ($expense_sheets_data['transport_category'] == '3') {
                        echo "Bus/Car/Taxi";
                    } else if ($expense_sheets_data['transport_category'] == '4') {
                        echo "Voiture";
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Nombre total de kilomètres :
                    <?php if (!(empty($expense_sheets_data['kilometers_number']))) {
                        echo $expense_sheets_data['kilometers_number'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Montant total en euros :
                <?php if (!(empty($expense_sheets_data['kilometers_number']))) {
                        echo $expense_sheets_data['kilometer_expense'];
                    } else if (!(empty($expense_sheets_data['transport_expense']))) {
                        echo $expense_sheets_data['transport_expense'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Montant à rembourser :
                <?php if (!(empty($expense_sheets_data['kilometers_number']))) {
                        echo $expense_sheets_data['kilometer_expense_refund'];
                    } else if (!(empty($expense_sheets_data['transport_expense']))) {
                        echo $expense_sheets_data['transport_expense_refund'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Reste à payer :
                <?php if (!(empty($expense_sheets_data['kilometers_number']))) {
                        if ($expense_sheets_data['kilometer_expense_unrefund'] == NULL) {
                            echo '0';
                        } else {
                            echo $expense_sheets_data['kilometer_expense_unrefund'];
                        };
                    } else if (!(empty($expense_sheets_data['transport_expense']))) {
                        if ($expense_sheets_data['transport_expense_unrefund'] == NULL) {
                            echo '0';
                        } else {
                            echo $expense_sheets_data['transport_expense_unrefund'];
                        };
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Justificatif :
                    <?php if (!(empty($receipts_data['transport_expense']))) {
                        echo "<a href=../" . $receipts_data['transport_expense'] . ">Consulter</a>";
                    } else {
                        echo "N/A";
                    } ?>
                </p>
            </div>
            <div class="mt-3">
                <h4>Hébergement</h4>
                <p>Nombre de nuitées :
                    <?php if (!(empty($expense_sheets_data['nights_number']))) {
                        echo $expense_sheets_data['nights_number'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Montant total en euros :
                    <?php if (!(empty($expense_sheets_data['accommodation_expense']))) {
                        echo $expense_sheets_data['accommodation_expense'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Montant à rembourser :
                    <?php if (!(empty($expense_sheets_data['accommodation_expense']))) {
                        echo $expense_sheets_data['accommodation_expense_refund'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Reste à payer :
                    <?php if (!(empty($expense_sheets_data['accommodation_expense']))) {
                        if ($expense_sheets_data['accommodation_expense_unrefund'] == NULL) {
                            echo '0';
                        } else {
                            echo $expense_sheets_data['accommodation_expense_unrefund'];
                        };
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Justificatif :
                    <?php if (!(empty($receipts_data['accommodation_expense']))) {
                        echo "<a href=../" . $receipts_data['accommodation_expense'] . ">Consulter</a>";
                    } else {
                        echo "N/A";
                    } ?>
                </p>
            </div>
            <div class="mt-3">
                <h4>Alimentation</h4>
                <p>Montant total en euros :
                    <?php if (!(empty($expense_sheets_data['food_expense']))) {
                        echo $expense_sheets_data['food_expense'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Montant à rembourser :
                    <?php if (!(empty($expense_sheets_data['food_expense']))) {
                        echo $expense_sheets_data['food_expense_refund'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Reste à payer :
                    <?php if (!(empty($expense_sheets_data['food_expense']))) {
                        if ($expense_sheets_data['food_expense_unrefund'] == NULL) {
                            echo '0';
                        } else {
                            echo $expense_sheets_data['food_expense_unrefund'];
                        };
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Justificatif :
                    <?php if (!(empty($receipts_data['food_expense']))) {
                        echo "<a href=../" . $receipts_data['food_expense'] . ">Consulter</a>";
                    } else {
                        echo "N/A";
                    } ?>
                </p>
            </div>
            <div class="mt-3">
                <h4>Autres</h4>
                <p>Montant total en euros :
                    <?php if (!(empty($expense_sheets_data['other_expense']))) {
                        echo $expense_sheets_data['other_expense'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Montant à rembourser :
                    <?php if (!(empty($expense_sheets_data['other_expense']))) {
                        echo $expense_sheets_data['other_expense_refund'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Reste à payer :
                    <?php if (!(empty($expense_sheets_data['other_expense']))) {
                        if ($expense_sheets_data['other_expense_unrefund'] == NULL) {
                            echo '0';
                        } else {
                            echo $expense_sheets_data['other_expense_unrefund'];
                        };
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Message :
                    <?php if (!(empty($expense_sheets_data['message']))) {
                        echo $expense_sheets_data['message'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
                <p>Justificatif :
                    <?php if (!(empty($receipts_data['other_expense']))) {
                        echo "<a href=../" . $receipts_data['other_expense'] . ">Consulter</a>";
                    } else {
                        echo "N/A";
                    } ?>
                </p>
            </div>
            <div class="mt-3">
                <h3>Traitement</h3>
                <p>Statut :
                    <?php
                    if (!(empty($treatment_data['status']))) {
                        if ($treatment_data['status'] == 2) {
                            echo "Refusée";
                        }
                        if ($treatment_data['status'] == 1) {
                            echo "Validée";
                        }
                    } else {
                        echo "En attente de traitement";
                    } ?>
                </p>
                <p>Détails du refus :
                    <?php if (!(empty($treatment_data['remark']))) {
                        echo $treatment_data['remark'];
                    } else {
                        echo "N/A";
                    } ?>
                </p>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary"><a href="../../v-home/v-home.php" style="color: white; text-decoration: none">Retour</a></button>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>