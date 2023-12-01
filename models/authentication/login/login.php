<?php

session_start();
include "../../db/db.php";

if (!$dbConnect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
} else {
    if (isset($_POST['submit'])) {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $request = $dbConnect->prepare($sql);
        $request->bindParam(1, $_POST['email'], PDO::PARAM_STR);
        $request->execute();
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if (empty($_POST['email']) || empty($_POST['password'])) {
            echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
        } elseif ($_POST['email'] != $data['email']) {
            echo 'Aucun utilisateur trouvé avec cet adresse e-mail. Veuillez recommencer.';
            echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
        } elseif (!password_verify($_POST['password'], $data['password'])) {
            echo 'Le mot de passe est incorrect. Veuillez recommencer.';
            echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
        } else {
            $_SESSION = ['id' => $data['id'], 'first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'role' => $data['role'], 'status' => $data['status']];
            header("Location: ../../../controllers/index.php");
        }
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
    }
}

?>