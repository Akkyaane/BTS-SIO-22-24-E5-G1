<?php
    session_start();
    include "bdd.php";
    
    if (!$connection)
    {
        echo "Connexion échouée.";
        echo "<br><button><a href='views/login/login.html'>Retour</a></button>";
    }
    else {
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        else {
            echo "Un ou plusieurs champs sont vides.";
            echo "<br><button><a href='login.html'>Retour au formulaire</a></button>";
    
        }
    
        $query = "SELECT * FROM contacts WHERE username = '$username'";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch();
        //var_dump($row["password"]);
        /*die();
        $rowCount = $stmt->rowCount();*/
    
        if (!password_verify($password, $row["password"])) {
            echo 'Mot de passe incorrect.';
        }
        else 
    
        $_SESSION['username'] = $username;
    
        header("Location: account.php");

    }
?>