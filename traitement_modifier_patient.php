<?php
include 'config.php';

// Supposons que votre fichier de configuration contient la connexion à la base de données comme suit :
// $conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update' && isset($_POST['patientID'], $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['email'], $_POST['telephone'])) {
        $patientID = $_POST['patientID'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['date_naissance'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];

        // Utilisez une requête UPDATE pour modifier les informations du patient avec l'ID spécifié
        $sql = "UPDATE patients SET Nom = ?, Prenom = ?, DateNaissance = ?, Email = ?, Telephone = ? WHERE PatientID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $nom, $prenom, $dateNaissance, $email, $telephone, $patientID);

        if ($stmt->execute()) {
            // Modification réussie
            $response = ['status' => 'success', 'message' => 'Informations du patient mises à jour avec succès.'];
        } else {
            // Erreur lors de la modification
            $response = ['status' => 'error', 'message' => 'Erreur lors de la mise à jour des informations du patient.'];
        }

        $stmt->close();

        // Renvoyer une réponse JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>
