<?php

session_start();
include "../../../models/db/db.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GSB - Accueil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <header class="bg-primary text-white text-center p-4">
    <h1>Portail GSB</h1>
    <h4>Visiteur médical</h4>
    <div class="container mt-4">
      <nav class="navbar" style="background : #0d6efd; border: solid white; justify-content: center">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link" href="../v-functionalities/v-PersonnalData/v-UpdatePersonnalData.php" style="color: white">Mon
              compte</a></li>
          <li class="nav-item"><a class="nav-link" href="../v-functionalities/v-settings/v-UpdateSettings.php" style="color: white">Paramètres</a></li>
          <li class="nav-item"><a class="nav-link" href="../../../models/authentication/logout/logout.php" style="color: white">Déconnexion</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <div class="container mt-5">
      <h3 style="text-align: center">Bienvenue
        <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>
      </h3>
    </div>

    <div class="container mt-5">
      <table class="table">
        <thead>
          <tr>
            <th>Période</th>
            <th>Nuitées</th>
            <th>Montant</th>
            <th>Créée le</th>
            <th>Traitement</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!$dbConnect) {
            echo "Connexion échouée.";
            echo "<br><button><a href='../../authentication/login/login.php'>Retour</a></button>";
          } else {
            $sql = 'SELECT u.id, e.*, t.* FROM users u INNER JOIN expensesheets e ON u.id = e.user_id LEFT JOIN treatment t ON e.id = t.expense_sheet_id WHERE u.id = ?';
            $request = $dbConnect->prepare($sql);
            $request->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
            $request->execute();
            while ($array = $request->fetchAll()) {
              if (!(empty($array))) {
                foreach ($array as $row) {
                  echo '<tr>
                              <td>Du ' . '<strong>' . $row['start_date'] . '</strong>' . ' au ' . '<strong>' . $row['end_date'] . '</strong></td>';
                  if ($row['nights_number'] == NULL) {
                    $row['nights_number'] = 0;
                    echo '<td>' . $row['nights_number'] . '</td>';
                  } else {
                    echo '<td>' . $row['nights_number'] . '</td>';
                  }
                  echo '
                              <td>Indisponible</td>
                              <td>' . $row['request_date'] . '</td>';
                  if (!(empty($row['status']))) {
                    if ($row['status'] == 1) {
                      echo '
                                  <td>Validée</td>
                                  <td>
                                  <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-ReadExpenseSheet.php?readid=' . $row['1'] . '"style="color: white; text-decoration: none">Consulter</a></button>
                                  </td>';
                    } 
                    if ($row['status'] == 2) {
                      echo '        
                                  <td>Refusée</td>
                                  <td>
                                  <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-ReadExpenseSheet.php?readid=' . $row['1'] . '"style="color: white; text-decoration: none">Consulter</a></button>
                                  </td>';
                    }
                  } else {
                    echo '
                                  <td>En traitement</td>
                                  <td>
                                  <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-ReadExpenseSheet.php?readid=' . $row['1'] . '"style="color: white; text-decoration: none">Consulter</a></button>
                                  <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=' . $row['1'] . '"style="color: white; text-decoration: none">Modifier</a></button>
                                  <button class="btn btn-sm btn-danger"><a href="../../../models/visitor/v-ExpenseSheet/v-DeleteExpenseSheet.php?deleteid=' . $row['1'] . '"style="color: white; text-decoration: none">Supprimer</a></button>
                                  </td>
                                ';
                  }
                }
              } else {
                $sql = 'SELECT u.id, e.* FROM users u INNER JOIN expensesheets e ON u.id = e.user_id  WHERE u.id = ?';
                $request = $dbConnect->prepare($sql);
                $request->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
                $request->execute();
                while ($array = $request->fetchAll()) {
                  foreach ($array as $row) {
                    echo '<tr>
                    <td>Du' . $row['start_date'] . '</strong>' . ' au ' . '<strong>' . $row['end_date'] . '</strong></td>' . '</td>';
                    if ($row['nights_number'] == NULL) {
                      $row['nights_number'] = 0;
                      echo '<td>' . $row['nights_number'] . '</td>';
                    } else {
                      echo '<td>' . $row['nights_number'] . '</td>';
                    }
                    echo '
                              <td>Indisponible</td>
                              <td>' . $row['request_date'] . '</td>';
                    if (!(empty($row['status']))) {
                      if ($row['status'] == 1) {
                        echo '
                                  <td>Validée</td>
                                  <td>
                                  <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-ReadExpenseSheet.php?readid=' . $row['1'] . '"style="color: white; text-decoration: none">Consulter</a></button>
                                  </td>';
                      }
                      if ($row['status'] == 2) {
                        echo '
                                  <td>Refusée</td>
                                  <td>
                                  <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-ReadExpenseSheet.php?readid=' . $row['1'] . '"style="color: white; text-decoration: none">Consulter</a></button>
                                  </td>';
                      } 
                    } else {
                        echo "En traitement";
                        echo '
                                  <td>
                                  <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-ReadExpenseSheet.php?readid=' . $row['1'] . '"style="color: white; text-decoration: none">Consulter</a></button>
                                  <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=' . $row['1'] . '"style="color: white; text-decoration: none">Modifier</a></button>
                                  <button class="btn btn-sm btn-danger"><a href="../../../models/visitor/v-ExpenseSheet/v-DeleteExpenseSheet.php?deleteid=' . $row['1'] . '"style="color: white; text-decoration: none">Supprimer</a></button>
                                  </td>';
                    }
                  }
                }
              }
            }
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="container mt-3" style="display: flex; justify-content: left">
      <a href="../v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php" class="btn btn-primary mb-2">Créer une nouvelle
        fiche de frais</a>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>