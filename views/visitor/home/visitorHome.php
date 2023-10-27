<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GSB - Accueil Visiteur Médical</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <header class="bg-primary text-white text-center py-4">
    <h2>Portail Visiteur Médical</h2>
  </header>
    <div class="container mt-5">
      <div class="mb-3">
        <h3>Bienvenue
          <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>
        </h3>
      </div>
    </div>
    <div class="container mt-5">
      <nav class="navbar" style="background-color: #e3f2fd;">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link" href="../personnalData/personnalData.php">Mon compte</a></li>
          <li class="nav-item"><a class="nav-link" href="../documents/recapExpenseSheet.php">Mes documents</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Paramètres</a></li>
          <li class="nav-item"><a class="nav-link" href="../../../models/authentication/logout/logout.php">Déconnexion</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
  <div class="container mt-4">
      <p>Afficher le récap des fiches de frais ici. Exemple : </p>
      <section id="">
        <h2>Mes fiches de frais :</h2><br>
        <ul class="list-group">
          <li class="list-group-item">
            <h5>Du 10/07/2023 au 14/07/2023 - Lyon</h5>
            <p>Créé le 15/07/2023</p>
            <p>Montant : 247 €</p>
            <a href="#">Consulter la fiche de frais</a>
          </li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item">
            <h5>Du 26/06/2023 au 28/06/2023 - Paris</h5>
            <p>Créé le 27/06/2023</p>
            <p>Montant : 124 €</p>
            <a href="#">Consulter la fiche de frais</a>
          </li>
        </ul>
        <ul class="list-group">
          <li class="list-group-item">
            <h5>Du 06/06/2023 au 12/06/2023 - Bordeaux</h5>
            <p>Créé le 13/06/2023</p>
            <p>Montant : 408 €</p>
            <a href="#">Consulter la fiche de frais</a>
          </li>
        </ul>
      </section>
    </div>
  </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"></script>
</body>
</html>