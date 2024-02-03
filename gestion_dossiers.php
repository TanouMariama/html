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
            isset($_POST['id_patient'], $_POST['nom_patient'], $_POST['date_creation'], $_POST['tel'], $_POST['adresse'], $_POST['allergies'], $_POST['examen'], $_POST['maladie'], $_POST['medicaments'], $_POST['nom_medecin'], $_POST['clinique'])
        ) {
            $stmt = $conn->prepare('INSERT INTO dossiers_medicaux (patient_id, nompatient, date_creation, tel, adresse, allergies, examens, maladie, medicaments, nom_medecin, clinique) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

            $stmt->bindParam(1, $_POST['id_patient']);
            $stmt->bindParam(2, $_POST['nom_patient']);
            $stmt->bindParam(3, $_POST['date_creation']);
            $stmt->bindParam(4, $_POST['tel']);
            $stmt->bindParam(5, $_POST['adresse']);
            $stmt->bindParam(6, $_POST['allergies']);
            $stmt->bindParam(7, $_POST['examen']);
            $stmt->bindParam(8, $_POST['maladie']);
            $stmt->bindParam(9, $_POST['medicaments']);
            $stmt->bindParam(10, $_POST['nom_medecin']);
            $stmt->bindParam(11, $_POST['clinique']);

            if ($stmt->execute()) {
                $successMessage = "Le dossier médical a été ajouté avec succès.";
            } else {
                $errorMessage = "Une erreur est survenue lors de l'ajout du dossier médical : " . $stmt->errorInfo()[2];
            }

            $stmt->closeCursor();
        } else {
            $errorMessage = "Veuillez remplir tous les champs du formulaire.";
        }
    }
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

// Fonctions pour manipuler les dossiers médicaux

function modifierDossierMedical($id, $patient_id, $nompatient, $date_creation) {
    global $conn;

    $stmt = $conn->prepare("UPDATE dossiers_medicaux SET patient_id=?, nompatient=?, date_creation=? WHERE id=?");
    $stmt->execute([$patient_id, $nompatient, $date_creation, $id]);

    return $stmt->rowCount(); // Nombre de lignes affectées
}

function supprimerDossierMedical($id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM dossiers_medicaux WHERE id=?");
    $stmt->execute([$id]);

    return $stmt->rowCount(); // Nombre de lignes affectées
}

// Fonction pour obtenir la liste des dossiers médicaux depuis la base de données
function obtenirListeDossiersMedicaux() {
    global $conn;

    $requete = "SELECT * FROM dossiers_medicaux";
    $resultat = $conn->query($requete);

    $listeDossiersMedicaux = array();

    // Vérifier si la requête a réussi
    if ($resultat === false) {
        die("Erreur lors de l'exécution de la requête : " . $conn->error);
    }

    // Récupérer les résultats
    while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $listeDossiersMedicaux[] = $row;
    }

    return $listeDossiersMedicaux;
}

?>


