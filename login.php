<?php
session_start();

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les informations du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Votre logique d'authentification ici (exemple simple)
    // Notez que ceci n'est pas sécurisé pour un usage en production
    if ($username === 'utilisateur' && $password === 'motdepasse') {
        // Authentification réussie
        $_SESSION['username'] = $username; // Stockez l'identifiant dans la session
       // header('Location: accueil.php'); // Redirigez l'utilisateur vers la page d'accueil
        exit();
    } else {
        // Échec de l'authentification, redirigez l'utilisateur vers la page de connexion avec un message d'erreur
        header('Location: login.php?error=1');
        exit();
    }
} else {
    // Si le formulaire n'a pas été soumis, redirigez l'utilisateur vers la page de connexion
    header('Location: login.php');
    exit();
}
?>
