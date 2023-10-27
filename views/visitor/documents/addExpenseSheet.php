<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">FICHE DE FRAIS DU VISITEUR</h1>
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="visitor-name">Visiteur :</label>
                    <input type="text" class="form-control" id="visitor-name" placeholder="Nom du Visiteur">
                </div>
                <div class="form-group col-md-6">
                    <label for="visit-date">Date :</label>
                    <input type="date" class="form-control" id="visit-date">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <h2>Frais de Transport</h2>
                    <label for="transport-amount">Kilométrage :</label>
                    <input type="number" class="form-control" id="transport-amount" placeholder="Montant en euros">
                </div>
                <div class="form-group col-md-4">
                    <h2>Frais de Repas</h2>
                    <label for="breakfast-amount">Petit-déjeuner :</label>
                    <input type="number" class="form-control" id="breakfast-amount" placeholder="Montant en euros">
                </div>
                <div class="form-group col-md-4">
                    <h2>Frais d'Hébergement</h2>
                    <label for="hotel-amount">Nuit d'hôtel :</label>
                    <input type="number" class="form-control" id="hotel-amount" placeholder="Montant en euros">
                </div>
            </div>
            <div class="form-group">
                <h2>Frais Divers</h2>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="expense-description" placeholder="Description">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="number" class="form-control" id="expense-amount" placeholder="Montant en euros">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="expense-description" placeholder="Description">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="number" class="form-control" id="expense-amount" placeholder="Montant en euros">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2>Total des Frais :</h2>
                <input type="number" class="form-control" id="total-amount" disabled>
            </div>
            <div class="form-group">
                <h2>Commentaires (le cas échéant) :</h2>
                <textarea class="form-control" id="comments" rows="4"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="visitor-signature">Signature du Visiteur :</label>
                    <input type="text" class="form-control" id="visitor-signature" placeholder="Signature du Visiteur">
                </div>
                <div class="form-group col-md-6">
                    <label for="manager-signature">Signature du Responsable :</label>
                    <input type="text" class="form-control" id="manager-signature" placeholder="Signature du Responsable">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>
</body>
</html>