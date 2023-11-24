<?php

session_start();
include "../../db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/administrator/ad-functionnalities/ad-UsersArray/ad-AddUser.php'>Retour</a></button>";
} else {
    if (isset($_POST['submit'])) {
        $user = [':fn' => $_POST['first_name'], ':ln' => $_POST['last_name'], ':e' => $_POST['email'], ':r' => $_POST['role']];
        $password = $_POST['password'];
        $password_match = $_POST['password_match'];
        if ((count($user) != 4) || empty($password) || empty($password_match)) {
            echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/administrator/ad-functionnalities/ad-UsersArray/ad-AddUser.php'>Retour</a></button>";
        } elseif ($password != $password_match) {
            echo "Les mots de passe ne correspondent pas. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/administrator/ad-functionnalities/ad-UsersArray/ad-AddUser.php'>Retour</a></button>";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $user[':p'] = $hash;
            $sql = 'INSERT INTO users (first_name, last_name, email, password, role) VALUES (:fn, :ln, :e, :p, :r)';
            $request = $db_connect->prepare($sql);
            $request->execute($user);
            echo "Utilisateur ajouté.";
            echo "<br><button><a href='../../../views/administrator/ad-home/ad-home.php'>Retour</a></button>";
        }
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/administrator/ad-functionnalities/ad-UsersArray/ad-AddUser.php'>Retour</a></button>";
    }
}

?>