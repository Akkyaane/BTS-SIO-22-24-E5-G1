<?php

session_start();
include "../../../models/authentication/db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
} else {
    $sql = 'SELECT u.email, e.* FROM users u INNER JOIN expenseSheets e ON u.email = e.email';
    $result = $db_connect->prepare($sql);
    $result->execute();
}

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
  <header class="bg-primary text-white text-center p-4">
    <h2>Portail - Visiteur Médical</h2>
    <div class="container mt-5">
      <nav class="navbar" style="background : #0d6efd; border: solid white; justify-content: center">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link" href="../personnalData/personnalData.php" style="color: white">Mon compte</a></li>
          <li class="nav-item"><a class="nav-link" href="#" style="color: white">Paramètres</a></li>
          <li class="nav-item"><a class="nav-link" href="../../../models/authentication/logout/logout.php" style="color: white">Déconnexion</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
  <div class="container mt-5">
      <div class="mb-3">
        <h3 style="text-align: center">Bienvenue
          <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>
        </h3>
      </div>
  </div>
  <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Période</th>
                    <th>Nombre de nuits</th>
                    <th>Date de soumission</th>
                    <th>Montant total</th>
                    <th>Traitement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    while ($array = $result->fetchAll()) {
                      foreach ($array as $row) {
                        $id = $row['id'];
                        $start_date = $row['start_date'];
                        $end_date = $row['end_date'];
                        $nights_number = $row['nights_number'];
                        $request_date = $row['request_date'];
                        echo '
                        <tr>
                          <td>Du '.'<strong>'.$start_date.'</strong>'.' au '.'<strong>'.$end_date.'</strong></td>
                          <td>'.$nights_number.'</td>
                          <td>'.$request_date.'</td>
                          <td>Indisponible</td>
                          <td>Indisponible</td>
                          <td>
                            <button class="btn btn-sm btn-primary"><a href="../functionnalities/readExpenseSheet.php?readid='.$id.'"style="color: white">Consulter</a></button>
                            <button class="btn btn-sm btn-primary"><a href="../functionnalities/updateExpenseSheet.php?updateid='.$id.'"style="color: white">Modifier</a></button>
                            <button class="btn btn-sm btn-danger"><a href="../../../models/expenseSheet/deleteExpenseSheet.php?deleteid='.$id.'>"style="color: white">Supprimer</a></button>
                          </td>
                        </tr>
                        ';
                      };
                    };
                    ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5" style="display: flex; justify-content: left">
      <a href="../functionnalities/addExpenseSheet.php" class="btn btn-primary mb-2">Créer une nouvelle fiche de frais</a>
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