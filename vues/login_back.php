<?php
require_once 'config.php';

// Identifiants codés en dur
$valid_username = 'alex';
$valid_password_hash = password_hash('alex', PASSWORD_DEFAULT);

var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && password_verify($password, $valid_password_hash)) {
        $_SESSION['username'] = $username;
        header("Location: Acceuil.php");
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
} else {
    echo "Méthode de requête invalide.";
}
?>
