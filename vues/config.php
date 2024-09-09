<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['username']);
}

function requireLogin() {
    if (!isset($_SESSION['username']))
    header("Location: Login.php");
}
?>
