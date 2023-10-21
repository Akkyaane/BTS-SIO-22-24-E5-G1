<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB - Accueil</title>
</head>
<body>
    <div class="container mt-5">
        <div class="mb-3">
            <p>Bienvenue <?php echo $_SESSION['username'] ?></p>
        </div>
        <button type="submit" class="btn btn-primary"><a href="../../models/logout/logout.php">Déconnexion</a></button>
    </div>
</body>
</html>