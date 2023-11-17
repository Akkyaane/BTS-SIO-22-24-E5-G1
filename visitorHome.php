<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GSB - Accueil Visiteur Médical</title>
  <link rel="stylesheet" href="visitorHome.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container"> 
</div>
<nav>
      <div class="navbar">
        <div class="container nav-container">
            <input class="checkbox" type="checkbox" name="" id="" />
            <div class="hamburger-lines">
              <span class="line line1"></span>
              <span class="line line2"></span>
              <span class="line line3"></span>
            </div>  
          <div class="menu-items">
            <li><a href="#">Mon compte</a></li>
            <li><a href="#">Mes documents</a></li>
            <li><a href="#">Paramètres</a></li>
            <li><a href="#">Déconnexion</a></li>
          </div>
        </div>
      </div>
    </nav>
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
    <script>
    var sidenav = document.getElementById("mySidenav");
    var openBtn = document.getElementById("openBtn");
    var closeBtn = document.getElementById("closeBtn");

    openBtn.onclick = openNav;
    closeBtn.onclick = closeNav;

    function openNav() {
    sidenav.classList.add("active");
  }

    function closeNav() {
    sidenav.classList.remove("active");
  }
    </script>
</body>
</html>