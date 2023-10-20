<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Fiche de Frais</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Nouvelle Fiche de Frais</h1>
        <form action="ajouter-fiche.php" method="post">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control">
            </div>
            <div class="form-group">
                <label for="montant">Montant (€)</label>
                <input type="text" name="montant" id="montant" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter la Fiche</button>
        </form>
    </div>
</body>
</html>
