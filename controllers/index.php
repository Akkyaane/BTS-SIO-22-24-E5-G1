<?php
session_start();

if (!$_SESSION) {
    header("Location: ../views/authentication/login/login.php");
} else {
    if ($_SESSION['role'] == 1) {
        header("Location: ../views/administrator/ad-home/ad-home.php");
    } elseif ($_SESSION['role'] == 2) {
        header("Location: ../views/accountant/ac-home/ac-home.php");
    } elseif ($_SESSION['role'] == 3) {
        header("Location: ../views/visitor/v-home/v-home.php");
    }
}
?>