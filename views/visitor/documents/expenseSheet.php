<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB - Ajout d'une fiche de frais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header class="bg-primary text-white text-center py-4">
        <h1 class="text-center">Modifier votre fiche de frais</h1>
    </header>
    <main>
        <div class="container mt-5">
            <form action="../../../models/expenseSheet/addExpenseSheet.php" method="post">
                <div class="mb-3">
                    <h3>Informations personnelles</h3>
                    <input type="text" class="form-control" name="last_name" placeholder="Nom" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="first_name" placeholder="Prénom" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                </div>
                <div class="mb-3">
                    <h3>Informations supplémentaires</h3>
                    <label for="date">Date de départ :</label>
                    <input type="date" class="form-control" name="start_date" placeholder="Date" required>
                </div>
                <div class="mb-3">
                    <label for="date">Date de retour :</label>
                    <input type="date" class="form-control" name="end_date" placeholder="Date" required>
                </div>
                <div class="mb-3">
                    <label for="date">Date de la demande de soumission :</label>
                    <input type="date" class="form-control" name="request_date" placeholder="Date" required>
                </div>
                <div class="mb-3">
                    <h3>Frais</h3>
                </div>
                <div class="mb-3">
                    <h5>Transport</h5>
                    <input type="number" step=0.01 class="form-control" name="transport_expense" placeholder="Montant total en euros">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="transport_expense_file">
                </div>
                <div class="mb-3">
                    <h5>Hébergement</h5>
                    <input type="number" step=0.01 class="form-control" name="accommodation_expense" placeholder="Montant total en euros" >
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="accommodation_expense_file" >
                </div>
                <div class="mb-3">
                    <h5>Alimentation</h5>
                    <input type="number" step=0.01 class="form-control" name="food_expense" placeholder="Montant total en euros">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="food_expense_file">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="events_expense_file">
                </div>
                <div class="mb-3">
                    <h5>Autres</h5>
                    <input type="number" step=0.01 class="form-control" name="other_expense" placeholder="Montant total en euros">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="other_expense_file">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" rows="3" name="message" id="message" placeholder="Écrire un message..." maxlength="500"></textarea><div id="charCount">0/500</div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
                </div>
                <script>
                    const textarea = document.getElementById('message');
                    const charCount = document.getElementById('charCount');
  
                    textarea.addEventListener('input', function() {
                    const remainingChars = textarea.value.length;
                    charCount.textContent = `${remainingChars}/500`;
                    });
                </script>
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
