<?php

session_start();
include "../../../models/db/db.php";

if (!$db_connect) {
  echo "Connexion échouée.";
} else {
  $sql = 'SELECT * FROM users';
  $request = $db_connect->prepare($sql); // sert à préparer la connexion à la base de donnée
  $request->execute();
  $data = $request->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GSB - Accueil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <header class="bg-primary text-white text-center p-4">
    <h2>Portail GSB</h2>
    <h4>Administrateur</h4>
    <div class="container mt-5">
      <nav class="navbar" style="background : #0d6efd; border: solid white; justify-content: center">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link" href="../v-functionalities/v-PersonnalData/v-UpdatePersonnalData.php" style="color: white">Mon
              compte</a></li>
          <li class="nav-item"><a class="nav-link" href="../v-functionalities/v-settings/v-UpdateSettings.php" style="color: white">Paramètres</a></li>
          <li class="nav-item"><a class="nav-link" href="../../../models/authentication/logout/logout.php"
              style="color: white">Déconnexion</a></li>
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
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($data) {
            while ($array = $request->fetchAll()) {
              foreach ($array as $row) {
                $id = $row['id'];
                $first_name = $row['first_name'];      // sert à afficher le tableau à partir des infos de la bdd
                $last_name = $row['last_name'];
                $email = $row['email'];
                $role = $row['role'];
                echo '
                          <tr>
                            <td>'.$last_name.'</td>
                            <td>' .$first_name. '</td>
                            <td>' .$email. '</td>
                            <td>'.$role.'</td>
                            <td>
                              <button class="btn btn-sm btn-primary"><a href="../ad-functionalities/ad-UsersArray/ad-ManagePersonnalDataUser.php?updateid=' . $id . '" style="color: white">Gérer</a></button>
                            </td>';
              }
            }
          }
          else {
            echo '
                        <tr>
                          <td>Aucun utilisateur</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>
                          </td>
                        </tr>
                        ';
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="container mt-5" style="display: flex; justify-content: left">
      <a href="../ad-functionalities/ad-UsersArray/ad-AddUser.php" class="btn btn-primary mb-2">Créer un nouvel utilisateur</a>
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