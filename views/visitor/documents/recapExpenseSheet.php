<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB - Mes documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">


    </div>


    <div class="container mt-4">
        <h1>Documents - Gestion des Frais</h1>
        <a href="addExpenseSheet.php" class="btn btn-primary mb-2">Nouvelle Fiche de Frais</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Montant (€)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2023-10-10</td>
                    <td>Frais de déplacement</td>
                    <td>50.00</td>
                    <td>
                        <a href="modifier-fiche.html" class="btn btn-sm btn-primary">Modifier</a>
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                    </td>
                </tr>
                <tr>
                    <td>2023-09-25</td>
                    <td>Frais de repas</td>
                    <td>30.00</td>
                    <td>
                        <a href="modifier-fiche.html" class="btn btn-sm btn-primary">Modifier</a>
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                    </td>
                </tr>
                <!-- Ajoutez plus de lignes pour chaque fiche de frais -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
