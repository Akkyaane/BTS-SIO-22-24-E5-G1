<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GSB - Accueil Administrateur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="adminInterface.css" />
</head>

<body>
  <div class="container mt-5">
    <div class="mb-3">
      <p>Bienvenue
        <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>
      </p>
    </div>
    <button type="submit" class="btn btn-primary"><a class="nav-link"
        href="../../../models/authentication/logout/logout.php">Déconnexion</a></button>
  </div>
  <input type="checkbox" id="nav-toggle" class="nav-toggle" />
  <nav class="navbar">
    <label for="nav-toggle" class="nav-toggle-label">
      <span></span>
    </label>
    <ul class="navbar-list">
      <li><a href="#">Tableau de bord</a></li>
      <li><a href="#">Patients</a></li>
      <li><a href="#">Médecins</a></li>
      <li><a href="#">Factures</a></li>
    </ul>
  </nav>

  <div class="container mt-4">
    <h1>Tableau de bord de l'administrateur</h1>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h2>Patients</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h2>Médecins</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h2>Factures</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
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