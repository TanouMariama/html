<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'delete' && isset($_POST['patientID'])) {
        $patientID = $_POST['patientID'];

        // Utilisez une requête DELETE pour supprimer le patient avec l'ID spécifié
        $sql = "DELETE FROM patients WHERE PatientID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $patientID);

        if ($stmt->execute()) {
            // Suppression réussie
            $response = ['status' => 'success', 'message' => 'Patient supprimé avec succès.'];
        } else {
            // Erreur lors de la suppression
            $response = ['status' => 'error', 'message' => 'Erreur lors de la suppression du patient.'];
        }

        $stmt->close();

        // Renvoyer une réponse JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>
