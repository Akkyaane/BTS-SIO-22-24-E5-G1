<?php

session_start();
include "../bdd/bdd.php";

if (!$db_connect) {
    echo "Connexion échouée.";
} else {
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $request = "SELECT * FROM users WHERE email = '$email'";
        $query = $db_connect->prepare($request);
        $query->execute();
        $row = $query->fetch();

        if (empty($email) || empty($password)) {
            echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
            echo "<br><br><button><a href='../../views/login/login.html'>Retour au formulaire</a></button>";
        } elseif (!$row) {
            echo 'Aucun utilisateur trouvé avec cet adresse e-mail. Veuillez recommencer.';
            echo "<br><br><button><a href='../../views/login/login.html'>Retour au formulaire</a></button>";
        } elseif (!password_verify($password, $row["password"])) {
            echo 'Le mot de passe est incorrect. Veuillez recommencer.';
            echo "<br><br><button><a href='../../views/login/login.html'>Retour au formulaire</a></button>";
        } else {
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            header("Location: ../../views/account/account.php");
        }
    } else {
        echo "Un ou plusieurs champs sont vides.";
        echo "<br><br><button><a href='../../views/login/login.html'>Retour au formulaire</a></button>";
    }
}

?>