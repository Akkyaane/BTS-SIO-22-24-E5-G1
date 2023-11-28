<?php

session_start();
include "../../db/db.php";

if (!$db_connect) {
    echo "Connexion échouée.";
    echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
} else {
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email = ?";
        $request = $db_connect->prepare($sql);
        $request->bindParam(1, $email, PDO::PARAM_STR);
        $request->execute();
        $row = $request->fetch(PDO::FETCH_ASSOC);
        if (empty($email) || empty($password)) {
            echo "Un ou plusieurs champs sont vides. Veuillez recommencer.";
            echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
        } elseif ($email != $row['email']) {
            echo 'Aucun utilisateur trouvé avec cet adresse e-mail. Veuillez recommencer.';
            echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
        } elseif (!password_verify($password, $row['password'])) {
            echo 'Le mot de passe est incorrect. Veuillez recommencer.';
            echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
        } else {
            $_SESSION = ['id' => $row['id'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'], 'email' => $row['email'], 'role' => $row['role']];
            var_dump($_SESSION);
            header("Location: ../../../controllers/index.php");
        }
    } else {
        echo "Un problème est survenu. Veuillez recommencer.";
        echo "<br><button><a href='../../../views/authentication/login/login.php'>Retour</a></button>";
    }
}

?>