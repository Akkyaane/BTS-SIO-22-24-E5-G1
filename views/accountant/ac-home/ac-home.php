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
    <h4>Comptable</h4>

    <div class="container mt-4">
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
    <div class="mt-5">
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
            <th>Par :</th>
            <th>Traitement</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php
if (!$dbConnect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
} else {
    $sql = 'SELECT e.*, r.*, t.*, u.first_name, u.last_name
            FROM expensesheets e
            LEFT JOIN receipts r ON e.receipts_id = r.id
            LEFT JOIN treatment t ON e.id = t.expense_sheet_id
            LEFT JOIN users u ON u.id = e.user_id';

    $request = $dbConnect->prepare($sql);
    $request->execute();
    $expense_sheets_data = $request->fetchAll();

    if (!empty($expense_sheets_data)) {
        foreach ($expense_sheets_data as $row) {
          // var_dump($row);
            $id = $row[0];
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
            $nights_number = $row['nights_number'];
            if ($nights_number === NULL) {
                $nights_number = 0;
            }
            $request_date = $row['request_date'];
            $last_name = $row['last_name'];
            $first_name = $row['first_name'];
            if ($row['status'] == 1) {
              $status = "Validée";
            }
            else if ($row['status'] == 2) {
              $status = "Refusée";
            }
            echo '<tr>
                    <td>Du <strong>' . $start_date . '</strong> au <strong>' . $end_date . '</strong></td>
                    <td>' . $nights_number . '</td>
                    <td>Indisponible</td>
                    <td>' . $request_date . '</td>
                    <td>' . $last_name . ' ' . $first_name . '</td>
                    <td>';
                    if ($row['status'] === 1 || $row['status'] === 2) {
                        echo $status . '</td>
                                <td>
                                  <button class="btn btn-sm btn-primary"><a href="../ac-functionalities/ac-ExpenseSheetValidationProcess/ac-ReadExpenseSheet.php?readid=' . $id . '" style="color: white">Consulter</a></button>
                                </td>';
                    } else if ($row['status'] === null) {
                        echo 'En traitement
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary"><a href="../ac-functionalities/ac-ExpenseSheetValidationProcess/ac-ReadExpenseSheet.php?readid=' . $id . '" style="color: white">Consulter</a></button>
                                    <button class="btn btn-sm btn-primary"><a href="../ac-functionalities/ac-ExpenseSheetValidationProcess/ac-UpdateExpenseSheet.php?updateid=' . $id . '" style="color: white">Traiter</a></button>
                                </td>';
                    }
                    echo '</tr>';
        }
    } else {
        echo '<tr>
                <td colspan="7">Aucun résultat</td>
            </tr>';
    };
};
        echo '</tbody>
      </table>';
?> 
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