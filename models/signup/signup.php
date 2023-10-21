<?php
    session_start();
    include "../bdd/bdd.php";
    
    if (!$connection)
    {
        echo "Connexion échouée.";
        echo "<br><button><a href='views/signup/signup.html'>Retour</a></button>";
    }
    else {
        if(isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            $request = $connection -> prepare('INSERT INTO users (first_name, last_name, email, password, role) VALUES(:fn, :ln, :e, :p, :r)');
            $request -> execute(array('fn' => $first_name, 'ln' => $last_name,'e' => $email, 'p' => $hash, 'r' => $role));
            echo "Opération réussie.";
            
        }
        else {
            echo "Opération échouée.";
            echo "<br><button><a href='views/signup/signup.html'>Retour</a></button>";
        }
    }
?>
