<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//include 'config4.php';
include 'gestion_dossiers.php';
// Remplacez ceci par la logique pour récupérer la liste des dossiers médicaux depuis la base de données
$listeDossiersMedicaux = obtenirListeDossiersMedicaux();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Consultation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Votre CSS personnalisé ici */
    </style>
</head>
<body>
<!-- ... (le reste de votre code) -->


<div class="container mt-4">
    <!-- Partie 1: Dossier Médical -->
    <h2>Dossier Médical</h2>

    <!-- Bouton Nouveau -->
    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#nouveauDossierModal">Nouveau</button>

    <!-- Tableau pour lister les dossiers médicaux -->
    <table class="table mt-4">
        <!-- Table Header -->
        <thead>
            <tr>
                <th>ID</th>
                <th>ID_Patient</th>
                <th>Nom_Patient</th>
                <th>Date_Création</th>
                <th>tel</th>
                <th>Adresse</th>
                <th>Allergies</th>
                <th>Examens</th>
                <th>Maladie</th>
                <th>Medicaments</th>
                <th>Nom_medecin</th>
                <th>Clinique</th>
                <th>Actions</th>
            </tr>
        </thead>
        <!-- Table Body -->
        <tbody>
            <?php
            if (empty($listeDossiersMedicaux)) {
                echo "<tr><td colspan='15'>La liste des dossiers médicaux est vide.</td></tr>";
            } else {
                foreach ($listeDossiersMedicaux as $dossierMedical) {
                    ?>
                    <tr>
                        <td><?php echo $dossierMedical['id']; ?></td>
                        <td><?php echo $dossierMedical['patient_id']; ?></td>
                        <td><?php echo $dossierMedical['nompatient']; ?></td>
                        <td><?php echo $dossierMedical['date_creation']; ?></td>
                        <td><?php echo $dossierMedical['tel']; ?></td>
                        <td><?php echo $dossierMedical['adresse']; ?></td>
                        <td><?php echo $dossierMedical['allergies']; ?></td>
                        <td><?php echo $dossierMedical['examens']; ?></td>
                        <td><?php echo $dossierMedical['maladie']; ?></td>
                        <td><?php echo $dossierMedical['medicaments']; ?></td>
                        <td><?php echo $dossierMedical['nom_medecin']; ?></td>
                        <td><?php echo $dossierMedical['clinique']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-modifier" data-id="<?php echo $dossierMedical['id']; ?>"><i class="fas fa-edit"></i> Modifier</button>
                            <button class="btn btn-info btn-visualiser" data-id="<?php echo $dossierMedical['id']; ?>"><i class="fas fa-eye"></i> Visualiser</button>
                            <button class="btn btn-secondary btn-archiver" data-id="<?php echo $dossierMedical['id']; ?>"><i class="fas fa-archive"></i> Archiver</button>
                            <button class="btn btn-danger btn-supprimer" data-id="<?php echo $dossierMedical['id']; ?>"><i class="fas fa-trash-alt"></i> Supprimer</button>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal pour Nouveau Dossier Médical -->
<div class="modal fade" id="nouveauDossierModal" tabindex="-1" aria-labelledby="nouveauDossierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Contenu du formulaire pour le nouveau dossier médical -->
            <form id="nouveauDossierForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="nouveauDossierModalLabel">Nouveau Dossier Médical</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">ID du Patient:</label>
                        <input type="text" class="form-control" id="patient_id" name="patient_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="nompatient" class="form-label">Nom du Patient:</label>
                        <input type="text" class="form-control" id="nompatient" name="nompatient" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_creation" class="form-label">Date de Création:</label>
                        <input type="date" class="form-control" id="date_creation" name="date_creation" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone:</label>
                        <input type="text" class="form-control" id="telephone" name="telephone">
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse:</label>
                        <textarea class="form-control" id="adresse" name="adresse"></textarea>
                    </div>
                    <!-- Ajoutez les autres champs du formulaire ici -->
                    
                    <div class="mb-3">
                        <label for="medicaments" class="form-label">Médicaments:</label>
                        <input type="text" class="form-control" id="medicaments" name="medicaments">
                    </div>

                    <div class="mb-3">
                        <label for="allergies" class="form-label">Allergies:</label>
                        <input type="text" class="form-control" id="allergies" name="allergies">
                    </div>
                    <div class="mb-3">
                        <label for="examens" class="form-label">Examens:</label>
                        <textarea class="form-control" id="examens" name="examens"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="examens" class="form-label">Maladie:</label>
                        <textarea class="form-control" id="examens" name="examens"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="medecin_traitant" class="form-label">Nom_Médecin :</label>
                        <input type="text" class="form-control" id="medecin_traitant" name="medecin_traitant">
                    </div>

                    <div class="mb-3">
                        <label for="hopital_clinique" class="form-label">Clinique:</label>
                        <input type="text" class="form-control" id="hopital_clinique" name="hopital_clinique">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (assurez-vous d'inclure jQuery et Popper.js si nécessaire) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Votre code JavaScript ici -->

</body>
</html>
