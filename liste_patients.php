<?php
include 'config.php';

// Fonction pour récupérer la liste des patients
$listePatients = $conn->getListePatients();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Patients</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>

    <h1 class="mt-4">Liste des Patients</h1>

    <?php if (!empty($listePatients)) : ?>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Date de Naissance</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listePatients as $patient) : ?>
                    <tr>
                    <td class="patient-id"><?php echo isset($patient['id']) ? $patient['id'] : 'N/A'; ?></td>
                    <td class="patient-nom"><?php echo isset($patient['nom']) ? $patient['nom'] : 'N/A'; ?></td>
                    <td class="patient-prenom"><?php echo isset($patient['prenom']) ? $patient['prenom'] : 'N/A'; ?></td>
                    <td class="patient-date-naissance"><?php echo isset($patient['date_naissance']) ? $patient['date_naissance'] : 'N/A'; ?></td>
                    <td class="patient-email"><?php echo isset($patient['email']) ? $patient['email'] : 'N/A'; ?></td>
                    <td class="patient-telephone"><?php echo isset($patient['telephone']) ? $patient['telephone'] : 'N/A'; ?></td>

                        <!-- Modifiez cette partie dans votre boucle foreach qui génère les lignes du tableau -->
                        <td>
                            <button class="btn-edit" type="button" data-id="<?php echo isset($patient['PatientID']) ? $patient['PatientID'] : ''; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-delete" type="button" data-id="<?php echo isset($patient['PatientID']) ? $patient['PatientID'] : ''; ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="btn-view" type="button" data-id="<?php echo isset($patient['PatientID']) ? $patient['PatientID'] : ''; ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun patient trouvé.</p>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttonsEdit = document.querySelectorAll('.btn-edit');

            buttonsEdit.forEach(function(button) {
                button.addEventListener('click', function() {
                    var row = button.closest('tr');
                    var patientID = row.querySelector('.patient-id').textContent;
                    var nom = row.querySelector('.patient-nom').textContent;
                    var prenom = row.querySelector('.patient-prenom').textContent;
                    var dateNaissance = row.querySelector('.patient-date-naissance').textContent;
                    var email = row.querySelector('.patient-email').textContent;
                    var telephone = row.querySelector('.patient-telephone').textContent;

                    Swal.fire({
                        title: 'Modifier le patient',
                        html:
                            `<form id="swal-form">` +
                            `<input id="swal-patient-id" type="hidden" value="${patientID}">` +
                            `<label for="swal-nom">Nom:</label>` +
                            `<input id="swal-nom" class="swal2-input" value="${nom}" required>` +
                            `<label for="swal-prenom">Prénom:</label>` +
                            `<input id="swal-prenom" class="swal2-input" value="${prenom}" required>` +
                            `<label for="swal-date-naissance">Date de Naissance:</label>` +
                            `<input id="swal-date-naissance" class="swal2-input" value="${dateNaissance}" required>` +
                            `<label for="swal-email">Email:</label>` +
                            `<input id="swal-email" class="swal2-input" value="${email}">` +
                            `<label for="swal-telephone">Téléphone:</label>` +
                            `<input id="swal-telephone" class="swal2-input" value="${telephone}">` +
                            `</form>`,
                        showCancelButton: true,
                        confirmButtonText: 'Enregistrer',
                        cancelButtonText: 'Annuler',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            // Récupérer les valeurs modifiées
                            var modifiedNom = document.getElementById('swal-nom').value;
                            var modifiedPrenom = document.getElementById('swal-prenom').value;
                            var modifiedDateNaissance = document.getElementById('swal-date-naissance').value;
                            var modifiedEmail = document.getElementById('swal-email').value;
                            var modifiedTelephone = document.getElementById('swal-telephone').value;

                            // Faire une requête AJAX pour mettre à jour les informations dans la base de données
                            $.ajax({
                                type: 'POST',
                                url: 'modifier_patient.php',
                                data: {
                                    patientID: patientID,
                                    nom: modifiedNom,
                                    prenom: modifiedPrenom,
                                    dateNaissance: modifiedDateNaissance,
                                    email: modifiedEmail,
                                    telephone: modifiedTelephone
                                },
                                success: function(response) {
                                    // Mettez à jour les valeurs dans la ligne du tableau
                                    row.querySelector('.patient-nom').textContent = modifiedNom;
                                    row.querySelector('.patient-prenom').textContent = modifiedPrenom;
                                    row.querySelector('.patient-date-naissance').textContent = modifiedDateNaissance;
                                    row.querySelector('.patient-email').textContent = modifiedEmail;
                                    row.querySelector('.patient-telephone').textContent = modifiedTelephone;

                                    Swal.fire('Modifié avec succès', '', 'success');
                                },
                                error: function(error) {
                                    Swal.fire('Erreur lors de la modification', '', 'error');
                                }
                            });
                        }
                    });
                });
            });

            var buttonsDelete = document.querySelectorAll('.btn-delete');

            buttonsDelete.forEach(function(button) {
                button.addEventListener('click', function() {
                    var row = button.closest('tr');
                    var patientID = row.querySelector('.patient-id').textContent;

                    Swal.fire({
                        title: 'Êtes-vous sûr?',
                        text: "La suppression est irréversible!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Supprimer'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Faites une requête AJAX pour supprimer le patient dans la base de données
                            // Assurez-vous d'ajuster l'URL en fonction de votre backend
                            $.ajax({
                                type: 'POST',
                                url: 'supprimer_patient.php',
                                data: { patientID: patientID },
                                success: function(response) {
                                    row.remove();
                                    Swal.fire('Supprimé avec succès', '', 'success');
                                },
                                error: function(error) {
                                    Swal.fire('Erreur lors de la suppression', '', 'error');
                                }
                            });
                        }
                    });
                });
            });

            var buttonsView = document.querySelectorAll('.btn-view');

            buttonsView.forEach(function(button) {
                button.addEventListener('click', function() {
                    var row = button.closest('tr');
                    var patientID = row.querySelector('.patient-id').textContent;
                    var nom = row.querySelector('.patient-nom').textContent;
                    var prenom = row.querySelector('.patient-prenom').textContent;
                    var dateNaissance = row.querySelector('.patient-date-naissance').textContent;
                    var email = row.querySelector('.patient-email').textContent;
                    var telephone = row.querySelector('.patient-telephone').textContent;

                    Swal.fire({
                        title: 'Détails du patient',
                        html:
                            `<ul>` +
                            `<li><strong>ID:</strong> ${patientID}</li>` +
                            `<li><strong>Nom:</strong> ${nom}</li>` +
                            `<li><strong>Prénom:</strong> ${prenom}</li>` +
                            `<li><strong>Date de Naissance:</strong> ${dateNaissance}</li>` +
                            `<li><strong>Email:</strong> ${email}</li>` +
                            `<li><strong>Téléphone:</strong> ${telephone}</li>` +
                            `</ul>`,
                        showCancelButton: false,
                        confirmButtonText: 'Fermer'
                    });
                });
            });
        });
    </script>
</body>
</html>
