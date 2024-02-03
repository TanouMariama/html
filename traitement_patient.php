<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "almadi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $errorMessage = $successMessage = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (
            isset($_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['email'], $_POST['telephone'])
        ) {
            $stmt = $conn->prepare('INSERT INTO patients (nom, prenom, date_naissance, email, telephone) VALUES (?, ?, ?, ?, ?)');

            $stmt->bindParam(1, $_POST['nom']);
            $stmt->bindParam(2, $_POST['prenom']);
            $stmt->bindParam(3, $_POST['date_naissance']);
            $stmt->bindParam(4, $_POST['email']);
            $stmt->bindParam(5, $_POST['telephone']);

            if ($stmt->execute()) {
                $successMessage = "Le patient a été ajouté avec succès.";
            } else {
                $errorMessage = "Une erreur est survenue lors de l'ajout du patient : " . $stmt->errorInfo()[2];
            }

            $stmt->closeCursor();
        } else {
            $errorMessage = "Veuillez remplir tous les champs du formulaire.";
        }
    }
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}
?>
