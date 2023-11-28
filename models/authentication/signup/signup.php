<?php

session_start();
include "../../db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/authentication/signup/signup.php'>Retour</a></button>";
} else {
    if (isset($_POST['submit'])) {
        $user = [':fn' => $_POST['first_name'], ':ln' => $_POST['last_name'], ':e' => $_POST['email'], ':r' => $_POST['role']];
        $password = $_POST['password'];
        $password_match = $_POST['password_match'];
        if ((count($user) != 4) || empty($password) || empty($password_match)) {
            echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/authentication/signup/signup.php'>Retour</a></button>";
        } elseif ($password != $password_match) {
            echo "Les mots de passe ne correspondent pas. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/authentication/signup/signup.php'>Retour</a></button>";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $user[':p'] = $hash;
            $db_connect->exec('SET FOREIGN_KEY_CHECKS = 0');
            $sql = 'INSERT INTO users (first_name, last_name, email, password, role) VALUES (:fn, :ln, :e, :p, :r)';
            $request = $db_connect->prepare($sql);
            $request->execute($user);
            $db_connect->exec('SET FOREIGN_KEY_CHECKS = 1');
            echo "L'utilisateur a bien été inscrit.";
        }
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/authentication/signup/signup.php'>Retour</a></button>";
    }
}

?>