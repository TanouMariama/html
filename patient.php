<?php
include 'db.php'; 

$db = new Database("localhost", "root", "", "almadi");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        if ($action === 'getListePatients') {
            // Récupérer la liste des patients depuis la base de données
            $listePatients = $db->getListePatients();

           
// Envoyer la liste au format JSON
            header('Content-Type: application/json');
            echo json_encode($listePatients);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinique Management</title>
    <!-- Ajoutez les liens vers les fichiers CSS et Bootstrap si nécessaire -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>

    <h1 class="mt-4">Liste des Patients</h1>

    <div id="liste-patients" class="mt-4">
        <!-- La liste des patients sera affichée ici -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Au chargement de la page, récupérer la liste des patients
            chargerListePatients();

            // Fonction pour récupérer et afficher la liste des patients depuis le back-end
            function chargerListePatients() {
                $.ajax({
                    url: 'index.php',
                    method: 'GET',
                    data: { action: 'getListePatients' },
                    dataType: 'json',
                    success: function(response) {
                        afficherListePatients(response);
                    },
                    error: function(error) {
                        console.error('Erreur lors de la récupération des patients :', error);
                    }
                });
            }

            // Fonction pour afficher la liste des patients dans la div sous forme de tableau
            function afficherListePatients(patients) {
                var tableHTML = '<table class="table table-bordered">';
                tableHTML += '<thead class="thead-light"><tr><th>Nom</th><th>Prénom</th><th>Date de Naissance</th><th>Actions</th></tr></thead>';
                tableHTML += '<tbody>';

                patients.forEach(function(patient) {
                    tableHTML += '<tr>';
                    tableHTML += '<td>' + patient.Nom + '</td>';
                    tableHTML += '<td>' + patient.Prenom + '</td>';
                    tableHTML += '<td>' + patient.DateNaissance + '</td>';
                    tableHTML += '<td>';
                    tableHTML += '<button class="btn btn-primary" onclick="editerPatient(' + patient.PatientID + ')">Éditer</button>';
                    tableHTML += '<button class="btn btn-danger" onclick="supprimerPatient(' + patient.PatientID + ')">Supprimer</button>';
                    // Ajoutez d'autres boutons d'action au besoin
                    tableHTML += '</td>';
                    tableHTML += '</tr>';
                });

                tableHTML += '</tbody></table>';

                $('#liste-patients').html(tableHTML);
            }

            // Fonction pour éditer un patient (exemple)
            function editerPatient(patientID) {
                // Implémentez la logique pour l'édition du patient
                console.log('Éditer le patient avec ID :', patientID);
            }

            // Fonction pour supprimer un patient (exemple)
            function supprimerPatient(patientID) {
                // Implémentez la logique pour la suppression du patient
                console.log('Supprimer le patient avec ID :', patientID);
            }
        });
    </script>
</body>
</html>
