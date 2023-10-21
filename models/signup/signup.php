<?php
    session_start();
    include "../bdd/bdd.php";
    
    if (!$db_connect)
    {
        echo "Connexion échouée.";
    }
    else {
        if(isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $hash = password_hash($password, PASSWORD_DEFAULT);
           
            $request = $db_connect -> prepare('INSERT INTO users (first_name, last_name, email, password, role) VALUES (:fn, :ln, :e, :p, :r)');
            $request -> execute(['fn' => $first_name, 'ln' => $last_name, 'e' => $email, 'p' => $hash, 'r' => $role]);
            echo "Utilisateur ajouté.";
            // echo "<br><button><a href='views/signup/signup.html'>Retour</a></button>"; Relier à la page d'accueil de l'administrateur.
        }
        else {
            echo "Opération échouée. Veuillez recommencer.";
            echo "<br><br><button><a href='../../views/signup/signup.html'>Retour</a></button>";
        }
    }

    
?>
