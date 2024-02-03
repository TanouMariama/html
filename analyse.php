<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Consultation</title>
    <!-- Ajout des liens Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <style>
        /* Votre CSS personnalisé ici */
    </style>
</head>
<body>

<!-- Partie 2: Ajouter un Résultat d'Analyse -->
<div class="container mt-4">
    <h2>Ajouter un Résultat d'Analyse</h2>

    <!-- Bouton pour ouvrir le formulaire d'ajout d'analyse -->
    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#ajouterAnalyseModal">Ajouter un Résultat d'Analyse</button>
</div>

<!-- Modal pour Ajouter un Résultat d'Analyse -->
<div class="modal fade" id="ajouterAnalyseModal" tabindex="-1" aria-labelledby="ajouterAnalyseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Contenu du formulaire pour ajouter un résultat d'analyse -->
            <form id="ajouterAnalyseForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterAnalyseModalLabel">Ajouter un Résultat d'Analyse</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Champ caché pour stocker l'ID du dossier médical -->
                    <input type="hidden" id="id_dossier_medical_analyse" name="id_dossier_medical_analyse" value="<?php echo $idDossierMedical; ?>">

                    <div class="mb-3">
                        <label for="designation" class="form-label">Désignation:</label>
                        <input type="text" class="form-control" id="designation" name="designation" required>
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code:</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <!-- Ajoutez d'autres champs d'analyse si nécessaire -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Partie 3: Visualiser l'Analyse Ajoutée -->
<div class="container mt-4">
    <h2>Analyses Ajoutées</h2>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID Analyse</th>
                <th>Désignation</th>
                <th>Code</th>
                <!-- Ajoutez d'autres colonnes d'analyse si nécessaire -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Remplacez ceci par la logique pour récupérer les résultats d'analyse depuis la base de données
            $resultatsAnalyse = obtenirResultatsAnalyse($idDossierMedical);

            foreach ($resultatsAnalyse as $analyse) :
            ?>
                <tr>
                    <td><?php echo $analyse['id_analyse']; ?></td>
                    <td><?php echo $analyse['designation']; ?></td>
                    <td><?php echo $analyse['code']; ?></td>
                    <!-- Ajoutez d'autres cellules de résultat d'analyse si nécessaire -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS (assurez-vous d'inclure jQuery et Popper.js si nécessaire) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Votre code JavaScript ici -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Gestionnaire d'événements pour le formulaire d'ajout d'analyse
        var ajouterAnalyseForm = document.getElementById('ajouterAnalyseForm');
        ajouterAnalyseForm.addEventListener('submit', function (event) {
            event.preventDefault();

            // Ajoutez la logique pour envoyer les données d'analyse au serveur (via AJAX ou une requête HTTP)

            // Rafraîchissez la liste des analyses (peut nécessiter une nouvelle requête AJAX)
            // Exemple : window.location.reload();
        });
    });
</script>

</body>
</html>
