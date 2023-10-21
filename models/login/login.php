<?php
    session_start();
    include "../bdd/bdd.php";
    
    if (!$db_connect)
    {
        echo "Connexion échouée.";
    }
    else {
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        else {
            echo "Un ou plusieurs champs sont vides.";
            echo "<br><button><a href='../../views/login/login.html'>Retour au formulaire</a></button>";
        }
    
        $request = "SELECT * FROM users WHERE email = '$email'";
        $query = $db_connect -> prepare($request);
        $query -> execute();
        $row = $query -> fetch();
    
        if (!password_verify($password, $row["password"])) {
            echo 'Mot de passe incorrect. Veuillez recommencer.';
            echo "<br><button><a href='../../views/login/login.html'>Retour au formulaire</a></button>";
        }
        else {
            $_SESSION['username'] = $username;
            header("Location: ../../views/account/account.php");
        }
    }
?>