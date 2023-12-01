<?php
session_start();

if (!$_SESSION) {
    header("Location: ../views/authentication/login/login.php");
} else {
    if ($_SESSION['status'] == 1) {
        if ($_SESSION['role'] == 'administrator') {
            header("Location: ../views/administrator/ad-home/ad-home.php");
        } elseif ($_SESSION['role'] == 'accountant') {
            header("Location: ../views/accountant/ac-home/ac-home.php");
        } elseif ($_SESSION['role'] == 'visitor') {
            header("Location: ../views/visitor/v-home/v-home.php");
        }
    }
    else {
        echo "Votre compte a été bloqué. Veuillez contacter un administrateur.<br><br>";
        echo "<button><a href='../views/authentication/login/login.php'>Retour</a></button>";
    }
}

?>