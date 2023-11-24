<?php

session_start();
include "../../../../models/db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
} else {
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM users WHERE id = ?";
    $result = $db_connect->prepare($sql);
    $result->bindParam(1, $id, PDO::PARAM_INT);
    $result->execute();
    $data = $result->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GSB - Gérer l'utilisateur</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container mt-5">
      <form action="../../../../models/administrator/ad-UsersArray/ad-ManagePersonnalDataUser.php?updateid=<?php echo $id; ?>" method="post">
        <div class="mb-3">
          <p class="h3">Modifier l'utilisateur</p>
        </div>
        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            name="first_name"
            value="<?php echo $data['first_name']; ?>"
            required
          />
        </div>
        <div class="mb-3">
          <input
            type="text"
            class="form-control"
            name="last_name"
            value="<?php echo $data['last_name']; ?>"
            required
          />
        </div>
        <div class="mb-3">
          <input
            type="email"
            class="form-control"
            name="email"
            value="<?php echo $data['email']; ?>"
            required
          />
        </div>
        <div class="mb-3">
        <select class="form-select" name="role" id="role" required>
                        <option selected hidden>Choisir une fonction</option>
                        <option value="1" <?php if ($data['role'] == '1')
                            ; ?>>Administrateur
                        </option>
                        <option value="2" <?php if ($data['role'] == '2')
                            ; ?>>Comptable
                        </option>
                        <option value="3" <?php if ($data['role'] == '3')
                            ; ?>>Visiteur médical
                        </option>
                    </select>
        </div>
        <button class="btn btn-primary"><a href="../../ad-home/ad-home.php" style="color: white;">Retour</a>
        </button>
        <button type="submit" class="btn btn-primary" name="edit_submit">
          Modifier
        </button>
        <button type="submit" class="btn btn-danger" name="disable_submit">
          Désactiver
        </button>
        </div>
      </form>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
