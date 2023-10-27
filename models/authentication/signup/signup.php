<?php

session_start();
include "../db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
    echo "<br><br><button><a href='../../../views/authentication/signup/signup.html'>Retour</a></button>";
} else {
    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_match = $_POST['password_match'];
        $role = $_POST['role'];

        if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($password_match) || empty($role)) {
            echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
            echo "<br><br><button><a href='../../../views/authentication/signup/signup.html'>Retour</a></button>";
        } elseif ($password != $password_match) {
            echo "Les mots de passe ne correspondent pas. Veuillez recommencer.";
            echo "<br><br><button><a href='../../../views/authentication/signup/signup.html'>Retour</a></button>";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $request = $db_connect->prepare('INSERT INTO users (first_name, last_name, email, password, role) VALUES (:fn, :ln, :e, :p, :r)');
            $request->execute(['fn' => $first_name, 'ln' => $last_name, 'e' => $email, 'p' => $hash, 'r' => $role]);
            echo "Utilisateur ajouté.";
            // echo "<br><button><a href='views/signup/signup.html'>Retour</a></button>"; Relier à la page d'accueil de l'administrateur.
        }
    } else {
        echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
        echo "<br><br><button><a href='../../../views/authentication/signup/signup.html'>Retour</a></button>";
    }
}

?>