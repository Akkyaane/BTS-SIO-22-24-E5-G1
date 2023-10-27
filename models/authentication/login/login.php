<?php

session_start();
include "../db/db.php";

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
            echo "<br><br><button><a href='../../../views/authentication/login/login.html'>Retour au formulaire</a></button>";
        } elseif (!$row) {
            echo 'Aucun utilisateur trouvé avec cet adresse e-mail. Veuillez recommencer.';
            echo "<br><br><button><a href='../../../views/authentication/login/login.html'>Retour au formulaire</a></button>";
        } elseif (!password_verify($password, $row["password"])) {
            echo 'Le mot de passe est incorrect. Veuillez recommencer.';
            echo "<br><br><button><a href='../../../views/authentication/login/login.html'>Retour au formulaire</a></button>";
        } else {
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $role = $row["role"];
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['role'] = $role;
            header("Location: ../../../controllers/index.php");
        }
    } else {
        echo "Un ou plusieurs champs sont vides.";
        echo "<br><br><button><a href='../../../views/authentication/login/login.html'>Retour au formulaire</a></button>";
    }
}

?>