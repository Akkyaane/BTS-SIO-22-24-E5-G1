<?php

session_start();
include "../../../../models/db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
} else {
    $id = $_GET['updateid'];
    $sql = 'SELECT * FROM expenseSheets where id = ?';
    $expense_sheets_data_request = $db_connect->prepare($sql);
    $expense_sheets_data_request->bindParam(1, $id, PDO::PARAM_INT);
    $expense_sheets_data_request->execute();
    $expense_sheets_data = $expense_sheets_data_request->fetch(PDO::FETCH_ASSOC);
    if ($expense_sheets_data) {
        $sql = 'SELECT * FROM receipts where id = ?';
        $receipts_data_request = $db_connect->prepare($sql);
        $receipts_data_request->bindParam(1, $expense_sheets_data['id'], PDO::PARAM_INT);
        $receipts_data_request->execute();
        $receipts_data = $receipts_data_request->fetch(PDO::FETCH_ASSOC);
    }
    if ($expense_sheets_data) {
        $sql = 'SELECT * FROM treatment where expense_sheet_id = ?';
        $treatment_data_request = $db_connect->prepare($sql);
        $treatment_data_request->bindParam(1, $expense_sheets_data['id'], PDO::PARAM_INT);
        $treatment_data_request->execute();
        $treatment_data = $treatment_data_request->fetch(PDO::FETCH_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB - Modification d'une fiche de frais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="v-AddExpenseSheet/v-AddExpenseSheet.css">
    <script defer src="../../../script.js"></script>
</head>

<body>
    <header class="bg-primary text-white text-center py-4">
        <h1 class="text-center">Modifier la fiche de frais</h1>
    </header>
    <main>
        <div class="container mt-5">
            <p>Attention : Pour chaque catégorie, veuillez inscrire le montant total des dépenses effectuées et fournir
                les justificatifs nécessaires. Sinon, laissez le champ vide.</p>
            <form
                action="../../../../models/visitor/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=<?php echo $id; ?>"
                method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <h3>Informations générales</h3>
                    <label for="date">Date de départ :</label>
                    <input type="date" class="form-control" name="start_date" id="start_date"
                        value="<?php echo $expense_sheets_data['start_date']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date">Date de retour :</label>
                    <input type="date" class="form-control" name="end_date" id="end_date"
                        value="<?php echo $expense_sheets_data['end_date']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date">Demande effectuée le :</label>
                    <input type="date" class="form-control" name="request_date" id="request_date"
                        value="<?php echo $expense_sheets_data['request_date']; ?>" required>
                </div>
                <div class="mb-3">
                    <h3>Frais</h3>
                    <h5>Transport</h5>
                    <select class="form-select" name="transport_category" id="transport_category"
                        onchange="showDiv(this)">
                        <option selected hidden>Sélectionnez le type de transport</option>
                        <option value="1" <?php if ($expense_sheets_data['transport_category'] == '1') {
                        echo "Avion";} ?>>Avion</option>
                        <option value="2" <?php if ($expense_sheets_data['transport_category'] == '2') {
                        echo "Train";} ?>>Train</option>
                        <option value="3" <?php if ($expense_sheets_data['transport_category'] == '3') {
                        echo "Bus/Car/Taxi";} ?>>Bus/Car/Taxi</option>
                        <option value="4" <?php if ($expense_sheets_data['transport_category'] == '4') {
                        echo "Voiture";} ?>>Voiture</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="number" step=0.01 class="form-control hidden" name="kilometers_number"
                        id="kilometers_number" placeholder="Nombre total de kilomètres"
                        value="<?php echo $expense_sheets_data['kilometers_number']; ?>">
                </div>
                <div class="mb-3">
                    <input type="number" step=0.01 class="form-control hidden" name="transport_expense"
                        id="transport_expense" placeholder="Montant total en euros"
                        value="<?php echo $expense_sheets_data['transport_expense']; ?>">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control hidden" name="transport_expense_file"
                        id="transport_expense_file">
                </div>
                <div class="mb-3">
                    <h5>Hébergement</h5>
                    <input type="number" class="form-control" name="nights_number" id="nights_number"
                        placeholder="Nombre de nuitées" value="<?php echo $expense_sheets_data['nights_number']; ?>">
                </div>
                <div class="mb-3">
                    <input type="number" step=0.01 class="form-control" name="accommodation_expense"
                        id="accommodation_expense" placeholder="Montant total en euros"
                        value="<?php echo $expense_sheets_data['accommodation_expense']; ?>">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="accommodation_expense_file"
                        id="accommodation_expense_file">
                </div>
                <div class="mb-3">
                    <h5>Alimentation</h5>
                    <input type="number" step=0.01 class="form-control" name="food_expense" id="food_expense"
                        placeholder="Montant total en euros" value="<?php echo $expense_sheets_data['food_expense']; ?>">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="food_expense_file" id="food_expense_file">
                </div>
                <div class="mb-3">
                    <h5>Autres</h5>
                    <input type="number" step=0.01 class="form-control" name="other_expense" id="other_expense"
                        placeholder="Montant total en euros" value="<?php echo $expense_sheets_data['other_expense']; ?>">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="other_expense_file" id="other_expense_file">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" rows="3" name="message" id="message"
                        placeholder="Écrire un message..." maxlength="500"
                        value="<?php echo $expense_sheets_data['message']; ?>"></textarea>
                    <div id="charCount">0/500</div>
                </div>
                <script>
                    charCount()
                </script>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Modifier</button>
                    <button class="btn btn-primary"><a href="../../v-home/v-home.php"
                            style="color: white">Retour</a></button>
                </div>
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>