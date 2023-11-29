<?php

session_start();
include "../../db/db.php";

if (!$dbConnect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/authentication/signup/signup.php'>Retour</a></button>";
} else {
    if (isset($_POST['submit'])) {
        $user = [':fn' => $_POST['first_name'], ':ln' => $_POST['last_name'], ':e' => $_POST['email'], ':r' => $_POST['role']];
        if ((count($user) != 4) || empty($_POST['password']) || empty($_POST['password_match'])) {
            echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/authentication/signup/signup.php'>Retour</a></button>";
        } elseif ($_POST['password'] != $_POST['password_match']) {
            echo "Les mots de passe ne correspondent pas. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/authentication/signup/signup.php'>Retour</a></button>";
        } else {
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user[':p'] = $hash;
            $dbConnect->exec('SET FOREIGN_KEY_CHECKS = 0');
            $sql = 'INSERT INTO users (first_name, last_name, email, password, role) VALUES (:fn, :ln, :e, :p, :r)';
            $request = $dbConnect->prepare($sql);
            $request->execute($user);
            $dbConnect->exec('SET FOREIGN_KEY_CHECKS = 1');
            echo "L'utilisateur a été inscrit.";
        }
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/authentication/signup/signup.php'>Retour</a></button>";
    }
}

?>