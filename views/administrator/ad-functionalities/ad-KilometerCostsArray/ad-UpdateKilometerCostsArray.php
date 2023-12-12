<?php

session_start();
include "../../../../models/db/db.php";

if (!$dbConnect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../ac-home/ac-home.php'>Retour</a></button>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB - Modification du tableau des frais kilométriques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header class="bg-primary text-white text-center py-4">
        <h1 class="text-center">Modifier le tableau des frais kilométriques</h1>
    </header>
    <main>
    <div class="container mt-5">
      <table class="table">
        <thead>
          <tr>
            <th>Nombre de chevaux</th>
            <th>Prix au kilomètre</th>
          </tr>
        </thead>
        <tbody>
        <?php
            $sql = 'SELECT * FROM kilometercosts';
            $kilometer_costs_data_request = $dbConnect->prepare($sql);
            $kilometer_costs_data_request->execute();
            $kilometer_costs_data = $kilometer_costs_data_request->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($kilometer_costs_data)) {
                foreach ($kilometer_costs_data as $row) {
                    $id = $row['id'];
                    echo '<tr>'?>
                        <form action="../../../../models/administrator/ad-KilometerCostsArray/ad-UpdateKilometerCostsArray.php?'" method="post">
                            <td><input type="number" step=0.01 class="form-control" name="horsepower[]" id="horsepower" value="<?php echo $row['horsepower'] ?>"></td>
                            <td><input type="float" step=0.01 class="form-control" name="cost[]" id="cost" value="<?php echo $row['cost']?>"></td>
                        </tr>
            <?php }
            } else {
                echo '<tr>
                        <td>Aucun résultat</td>
                    </tr>';
            };
        ?>
        </tbody>
    </table>
    <div class="mt-3">
                            <button type="submit" class="btn btn-primary" name="submit" id="submit">Valider</button>
                            <button class="btn btn-primary"><a href="../../ad-home/ad-home.php" style="color: white; text-decoration: none">Annuler</a></button>
    </div>
    </form>
    </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>