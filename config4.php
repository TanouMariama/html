<?php
// Fonction de connexion à la base de données
function connectDB() {
    $host = 'localhost';
    $utilisateur = 'root';
    $motDePasse = '';
    $nomBaseDeDonnees = 'almadi';

    $connexion = new mysqli($host, $utilisateur, $motDePasse, $nomBaseDeDonnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("Échec de la connexion à la base de données : " . $connexion->connect_error);
    }

    return $connexion;
}



?>
