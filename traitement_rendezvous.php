<?php
include 'config.php';

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $patientID = $_POST['patientID'];
    $nomPatient = $_POST['nomPatient'];
    $prenomPatient = $_POST['prenomPatient'];
    $dateRendezVous = $_POST['dateRendezVous'];
    $heureRendezVous = $_POST['heureRendezVous'];
    $description = $_POST['description'];

    // Insérez les données dans la base de données
    $sql = "INSERT INTO rendezvous (PatientID, NomPatient, PrenomPatient, DateRendezVous, HeureRendezVous, Description) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isssss', $patientID, $nomPatient, $prenomPatient, $dateRendezVous, $heureRendezVous, $description);

    if ($stmt->execute()) {
        // Succès de l'ajout
        echo json_encode(['status' => 'success', 'message' => 'Rendez-vous ajouté avec succès.']);
    } else {
        // Échec de l'ajout
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'ajout du rendez-vous.']);
    }

    $stmt->close();
}
?>
