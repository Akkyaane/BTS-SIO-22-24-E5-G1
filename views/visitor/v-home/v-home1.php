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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <header class="bg-primary text-white text-center p-4">
    <h2>Portail GSB</h2>
    <h4>Visiteur médical</h4>

    <div class="container mt-5">
      <nav class="navbar" style="background : #0d6efd; border: solid white; justify-content: center">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link" href="../v-functionalities/v-PersonnalData/v-UpdatePersonnalData.php"
              style="color: white">Mon
              compte</a></li>
          <li class="nav-item"><a class="nav-link" href="../v-functionalities/v-settings/v-UpdateSettings.php"
              style="color: white">Paramètres</a></li>
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

          if (!$db_connect) {
            echo "Connexion échouée.";
            echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
          } else {
            if (isset($_POST['submit'])) {
                $months = $_POST['months'];
                $sql = 'SELECT * FROM expensesheets WHERE user_id = ? and month(start_date) = ?';
                $expense_sheets_data_request = $db_connect->prepare($sql);
                $expense_sheets_data_request->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
                $expense_sheets_data_request->bindParam(2, $months, PDO::PARAM_INT);
                $expense_sheets_data_request->execute();
                $expense_sheets_data = $expense_sheets_data_request->fetch(PDO::FETCH_ASSOC);
    
                $sql = 'SELECT * FROM treatment where expense_sheet_id = ?';
                $receipts_data_request = $db_connect->prepare($sql);
                $receipts_data_request->bindParam(1, $expense_sheets_data['id'], PDO::PARAM_INT);
                $receipts_data_request->execute();
                $receipts_data = $receipts_data_request->fetch(PDO::FETCH_ASSOC);
    
                $sql = 'SELECT u.id, e.*, t.* FROM users u INNER JOIN expensesheets e ON u.id = e.user_id LEFT JOIN treatment t ON e.id = t.expense_sheet_id WHERE u.id = ? and month(start_date) = ?';
                $request = $db_connect->prepare($sql);
                $request->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
                $request->bindParam(2, $months, PDO::PARAM_INT);
                $request->execute();
    
                while ($array = $request->fetchAll()) {
                  foreach ($array as $row) {
                    $id = $row['1'];
                    $start_date = $row['start_date'];
                    $end_date = $row['end_date'];
                    $request_date = $row['request_date'];
                    $nights_number = $row['nights_number'];
                    if ($nights_number == NULL) {
                      $nights_number = 0;
                    }
                    if (!(empty($row['status']))) {
                      if ($row['status'] == 1) {
                        $status = "Validée";
                      }
                      else {
                        $status = "Refusée";
                      };
                    };
                    echo '<tr>
                              <td>Du ' . '<strong>' . $start_date . '</strong>' . ' au ' . '<strong>' . $end_date . '</strong></td>
                              <td>' . $nights_number . '</td>
                              <td>Indisponible</td>
                              <td>' . $request_date . '</td>
                              <td>';
                              if (!(empty($row['status']))) {
                                echo $status.'
                                <td>
                                  <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-ReadExpenseSheet.php?readid=' . $id . '"style="color: white">Consulter</a></button>
                                </td>';
                              } else {
                                echo 'En traitement
                              </td>
                              <td>
                              <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-ReadExpenseSheet.php?readid=' . $id . '"style="color: white">Consulter</a></button>
                              <button class="btn btn-sm btn-primary"><a href="../v-functionalities/v-ExpenseSheet/v-UpdateExpenseSheet.php?updateid=' . $id . '"style="color: white">Modifier</a></button>
                              <button class="btn btn-sm btn-danger"><a href="../../../models/visitor/v-ExpenseSheet/v-DeleteExpenseSheet.php?deleteid=' . $id . '"style="color: white">Supprimer</a></button>
                              </td>';
                              };
                    
                  };
                };
                if (!$request) {
                    echo '
                            <tr>
                            <td>Aucun résultat</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                            </td>
                            </tr>
                            ';
                };

            }
          };
          ?>
        </tbody>
      </table>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary m-5">
        <a href="../v-functionalities/v-ExpenseSheet/v-AddExpenseSheet/v-AddExpenseSheet.php" style="color: white">Créer une nouvelle
            fiche de frais</a>
        </button>
        <button class="btn btn-primary m-1"><a href="v-home.php" style="color: white">Retour</a></button>
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