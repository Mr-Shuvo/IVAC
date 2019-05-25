<?php
session_start();
if (!empty($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['allreadylogin']);
    $_SESSION['logout']="Logout successfully";
    header('location:../auth/login.php');
}