<?php
include 'config2.php';
// Fonction pour récupérer la liste des patients
$listeRendezVous = $conn->getListeRendezVous();  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Rendez des Vous </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            padding: 10px;
        }
    </style>
</head>
<body>

    <h1 class="mt-4">Liste des Rendez-vous</h1>

    <?php if (!empty($listeRendezVous)) : ?>
        <table class="table mt-4">
            <thead>
                <tr>
                <th scope="col">RendezVousID</th>
                    <th scope="col">PatientID</th>
                    <th scope="col">NomPatient</th>
                    <th scope="col">PrénomPatient</th>
                    <th scope="col">DateRendezVous</th>
                    <th scope="col">HeureRendezVous</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listeRendezVous as $rendezVous) : ?>
                    <tr>
                    <th scope="row" class="rendezvous-id"><?php echo $rendezVous['RendezVousID']; ?></th>
                        <td class="patient-nom"><?php echo $rendezVous['NomPatient']; ?></td>
                        <td class="patient-prenom"><?php echo $rendezVous['PrenomPatient']; ?></td>
                        <td class="DateRendezVous"><?php echo $rendezVous['DateRendezVous']; ?></td>
                        <td class="HeureRendezVous"><?php echo $rendezVous['HeureRendezVous']; ?></td>
                        <td class="Description"><?php echo $rendezVous['Description']; ?></td>
                        <!-- Modifiez cette partie dans votre boucle foreach qui génère les lignes du tableau -->
                        <td>
                        <button class="btn-edit" type="button" data-id="<?php echo $rendezVous['RendezVousID']; ?>">
                        <i class="fas fa-edit"></i></button>
                       <button class="btn-delete" type="button" data-id="<?php echo $rendezVous['RendezVousID']; ?>">
                       <i class="fas fa-trash-alt"></i></button>
                        <button class="btn-view" type="button" data-id="<?php echo $rendezVous['RendezVousID']; ?>">
                       <i class="fas fa-eye"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>

        <?php else : ?>
        <p>Aucun rendezvous trouvé.</p>
    <?php endif; ?>

   
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var buttonsEdit = document.querySelectorAll('.btn-edit');

    buttonsEdit.forEach(function(button) {
        button.addEventListener('click', function() {
            var row = button.closest('tr');
            var rendezVousID = row.querySelector('.rendezvous-id').textContent;
            var nomPatient = row.querySelector('.patient-nom').textContent;
            var prenomPatient = row.querySelector('.patient-prenom').textContent;
            var dateRendezVous = row.querySelector('.DateRendezVous').textContent;
            var heureRendezVous = row.querySelector('.HeureRendezVous').textContent;
            var description = row.querySelector('.Description').textContent;

            Swal.fire({
                title: 'Modifier le rendez-vous',
                html:
                    `<form id="swal-form">` +
                    `<input id="swal-rendezvous-id" type="hidden" value="${rendezVousID}">` +
                    `<label for="swal-nom-patient">Nom Patient:</label>` +
                    `<input id="swal-nom-patient" class="swal2-input" value="${nomPatient}" required>` +
                    `<label for="swal-prenom-patient">Prénom Patient:</label>` +
                    `<input id="swal-prenom-patient" class="swal2-input" value="${prenomPatient}" required>` +
                    `<label for="swal-date-rendezvous">Date Rendez-vous:</label>` +
                    `<input id="swal-date-rendezvous" class="swal2-input" value="${dateRendezVous}" required>` +
                    `<label for="swal-heure-rendezvous">Heure Rendez-vous:</label>` +
                    `<input id="swal-heure-rendezvous" class="swal2-input" value="${heureRendezVous}" required>` +
                    `<label for="swal-description">Description:</label>` +
                    `<input id="swal-description" class="swal2-input" value="${description}">` +
                    `</form>`,
                showCancelButton: true,
                confirmButtonText: 'Enregistrer',
                cancelButtonText: 'Annuler',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    // Récupérer les valeurs modifiées
                    var modifiedNomPatient = document.getElementById('swal-nom-patient').value;
                    var modifiedPrenomPatient = document.getElementById('swal-prenom-patient').value;
                    var modifiedDateRendezVous = document.getElementById('swal-date-rendezvous').value;
                    var modifiedHeureRendezVous = document.getElementById('swal-heure-rendezvous').value;
                    var modifiedDescription = document.getElementById('swal-description').value;

                    // Faire une requête AJAX pour mettre à jour les informations dans la base de données
                    $.ajax({
                        type: 'POST',
                        url: 'modifier_rendezvous.php',
                        data: {
                            rendezVousID: rendezVousID,
                            nomPatient: modifiedNomPatient,
                            prenomPatient: modifiedPrenomPatient,
                            dateRendezVous: modifiedDateRendezVous,
                            heureRendezVous: modifiedHeureRendezVous,
                            description: modifiedDescription
                        },
                        success: function(response) {
                            // Mettez à jour les valeurs dans la ligne du tableau
                            row.querySelector('.patient-nom').textContent = modifiedNomPatient;
                            row.querySelector('.patient-prenom').textContent = modifiedPrenomPatient;
                            row.querySelector('.DateRendezVous').textContent = modifiedDateRendezVous;
                            row.querySelector('.HeureRendezVous').textContent = modifiedHeureRendezVous;
                            row.querySelector('.Description').textContent = modifiedDescription;

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
            var rendezVousID = row.querySelector('.rendezvous-id').textContent;

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
                    // Faites une requête AJAX pour supprimer le rendez-vous dans la base de données
                    $.ajax({
                        type: 'POST',
                        url: 'supprimer_rendezvous.php',
                        data: { rendezVousID: rendezVousID },
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
            var rendezVousID = row.querySelector('.rendezvous-id').textContent;
            var nomPatient = row.querySelector('.patient-nom').textContent;
            var prenomPatient = row.querySelector('.patient-prenom').textContent;
            var dateRendezVous = row.querySelector('.DateRendezVous').textContent;
            var heureRendezVous = row.querySelector('.HeureRendezVous').textContent;
            var description = row.querySelector('.Description').textContent;

            Swal.fire({
                title: 'Détails du rendez-vous',
                html:
                    `<ul>` +
                    `<li><strong>ID:</strong> ${rendezVousID}</li>` +
                    `<li><strong>Nom Patient:</strong> ${nomPatient}</li>` +
                    `<li><strong>Prénom Patient:</strong> ${prenomPatient}</li>` +
                    `<li><strong>Date Rendez-vous:</strong> ${dateRendezVous}</li>` +
                    `<li><strong>Heure Rendez-vous:</strong> ${heureRendezVous}</li>` +
                    `<li><strong>Description:</strong> ${description}</li>` +
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
