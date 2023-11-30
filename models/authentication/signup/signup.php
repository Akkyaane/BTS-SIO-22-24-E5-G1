<?php

session_start();
include "../../db/db.php";

if (!$dbConnect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/administrator/ad-functionnalities/ad-UsersArray/ad-AddUser.php'>Retour</a></button>";
} else {
    if (isset($_POST['submit'])) {
        $user = [':fn' => $_POST['first_name'], ':ln' => $_POST['last_name'], ':e' => $_POST['email'], ':r' => $_POST['role']];
        if ((count($user) != 4) || empty($_POST['password']) || empty($_POST['password_match'])) {
            echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/authentication/signup/signup.php'>Retour</a></button>";
        } elseif ($password != $password_match) {
            echo "Les mots de passe ne correspondent pas. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/administrator/ad-functionnalities/ad-UsersArray/ad-AddUser.php'>Retour</a></button>";
        } else {
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user[':p'] = $hash;
            var_dump($user);
            $sql = 'INSERT INTO users (first_name, last_name, email, password, role) VALUES (:fn, :ln, :e, :p, :r)';
            $request = $dbConnect->prepare($sql);
            $request->execute($user);
            echo "Utilisateur ajouté.";
        }
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/administrator/ad-functionnalities/ad-UsersArray/ad-AddUser.php'>Retour</a></button>";
    }
}

?>