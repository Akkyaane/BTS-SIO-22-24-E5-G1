<?php

session_start();
include "../../../../models/db/db.php";

$id = $_GET['updateid'];
$sql = "SELECT * FROM expenseSheets WHERE id = :id";
$result = $db_connect->prepare($sql);
$result->bindParam(':id', $id, PDO::PARAM_INT);
$result->execute();
$data = $result->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB - Validation d'une fiche de frais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="addExpenseSheet.css">
</head>
<body>
    <header class="bg-primary text-white text-center py-4">
        <h1 class="text-center">Valider la fiche de frais</h1>
    </header>
    <main>
        <div class="container mt-5">
            <form action="../../../../models/accountant/ac-ExpenseSheetValidationProcess/ac-UpdateExpenseSheet.php?updateid=<?php echo $id; ?>" method="post">
                <div class="mb-3">
                    <h3>Informations générales</h3>
                    <label for="date">Date de départ :</label>
                    <input type="date" class="form-control" name="start_date" value="<?php echo $data['start_date']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="date">Date de retour :</label>
                    <input type="date" class="form-control" name="end_date" value="<?php echo $data['end_date']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="nights_number" placeholder="Nombre de nuitées" value="<?php echo $data['nights_number']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="date">Date de la demande de soumission :</label>
                    <input type="date" class="form-control" name="request_date" value="<?php echo $data['request_date']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <h3>Frais</h3>
                </div>
                <div class="mb-3">
                    <h5>Transport</h5>
                    <select class="form-select" name="transport_category" id="transport_category" onchange="showDiv(this)" readonly>
                        <option hidden selected>Sélectionnez le type de transport</option>
                        <option value="1"<?php if ($data['transport_category'] == '1') echo ' selected'; ?>>Avion</option>
                        <option value="2"<?php if ($data['transport_category'] == '2') echo ' selected'; ?>>Bus</option>
                        <option value="3"<?php if ($data['transport_category'] == '3') echo ' selected'; ?>>Car</option>
                        <option value="4"<?php if ($data['transport_category'] == '4') echo ' selected'; ?>>Taxi</option>
                        <option value="5"<?php if ($data['transport_category'] == '5') echo ' selected'; ?>>Train</option>
                        <option value="6"<?php if ($data['transport_category'] == '6') echo ' selected'; ?>>Voiture</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="number" step=0.01 class="form-control form-control-v2" id="kilometers_expense" name="kilometers_expense" placeholder="Nombre total de kilomètres" value="<?php echo $data['kilometers_expense']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <input type="number" step=0.01 class="form-control form-control-v2" id="transport_expense" name="transport_expense" placeholder="Montant total en euros" value="<?php echo $data['transport_expense']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control form-control-v2" id="transport_expense_file" name="transport_expense_file">
                </div>
                <div class="mb-3">
                    <h5>Hébergement</h5>
                    <input type="number" step=0.01 class="form-control" name="accommodation_expense" placeholder="Montant total en euros" value="<?php echo $data['accommodation_expense']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="accommodation_expense_file">
                </div>
                <div class="mb-3">
                    <h5>Alimentation</h5>
                    <input type="number" step=0.01 class="form-control" name="food_expense" placeholder="Montant total en euros" value="<?php echo $data['food_expense']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="food_expense_file">
                </div>
                <div class="mb-3">
                    <h5>Autres</h5>
                    <input type="number" step=0.01 class="form-control" name="other_expense" placeholder="Montant total en euros" value="<?php echo $data['other_expense']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="other_expense_file">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" rows="3" name="message" id="message" placeholder="Écrire un message..." maxlength="500" value="<?php echo $data['message']; ?>" readonly></textarea><div id="charCount">0/500</div>
                </div>
                <div class="mb-3">
                    <h5>Détails du refus</h5>
                    <div class="mb-3">
                        <textarea class="form-control" rows="3" name="remark" id="remark" placeholder="Écrire une remarque..." maxlength="500"></textarea>
                        <div id="charCount">0/500</div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="validate_submit">Valider</button>
                    <button type="submit" class="btn btn-sm btn-danger" name="disprove_submit">Refuser</button>
                    <button class="btn btn-primary"><a href="../../ac-home/ac-home.php"
                        style="color: white">Retour</a></button>
                </div>
                <script>
                    const textarea = document.getElementById('message');
                    const charCount = document.getElementById('charCount');
  
                    textarea.addEventListener('input', function() {
                    const remainingChars = textarea.value.length;
                    charCount.textContent = `${remainingChars}/500`;
                    });

                    window.addEventListener('DOMContentLoaded', (event) => {
                        const transportCategory = document.getElementById('transport_category');
                        showDiv(transportCategory);

                        transportCategory.addEventListener('change', function() {
                            showDiv(this);
                        });
                    });

                    function showDiv(select) {
                        const selectedValue = parseInt(select.value); // Convertir la valeur en nombre entier

                        const kilometersExpense = document.getElementById('kilometers_expense');
                        const transportExpense = document.getElementById('transport_expense');
                        const transportExpenseFile = document.getElementById('transport_expense_file');

                        if (selectedValue >= 1 && selectedValue <= 5) {
                            kilometersExpense.style.display = "none";
                            transportExpense.style.display = "block";
                            transportExpenseFile.style.display = "block";
                        } else if (selectedValue === 6) {
                            kilometersExpense.style.display = "block";
                            transportExpense.style.display = "none";
                            transportExpenseFile.style.display = "none";
                        }
                    }
                </script>
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>