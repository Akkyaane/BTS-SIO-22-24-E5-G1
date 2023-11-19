<?php
    session_start();

    if (!$_SESSION) {
        header("Location: ../views/authentication/login/login.html");
    }
    else {
        if ($_SESSION['role'] == 1) {
            header("Location: ../views/administrator/home/administratorHome.php");
        }
        elseif ($_SESSION['role'] == 2) {
            header("Location: ../views/accountant/home/accountantHome.php");
        }
        elseif ($_SESSION['role'] == 3) {
            header("Location: ../views/visitor/home/visitorHome.php");
        }
    }
?>