<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Fiches de Frais pour les Visiteurs</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Tableau des Fiches de Frais pour les Visiteurs</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th scope="col">Date de Début</th>
                <th scope="col">Date de Fin</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>john.doe@gmail.com</td>
                <td>2023-11-01</td>
                <td>2023-11-10</td>
            </tr>
            <tr>
                <td>James</td>
                <td>Sterling</td>
                <td>james.sterling@gmail.com</td>
                <td>2023-11-01</td>
                <td>2023-11-10</td>
            </tr>
            <tr>
                <td>Agathe</td>
                <td>Smith</td>
                <td>agathe.smith@gmail.com</td>
                <td>2023-11-01</td>
                <td>2023-11-10</td>
            </tr>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
