<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Rendez-vous</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>

    <h1 class="mt-4">Ajouter un Rendez-vous</h1>

    <?php
    include 'traitement_rendezvous.php';
    // Définir des messages de succès ou d'erreur ici
    if (!empty($successMessage)) {
        echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
    }
    if (!empty($errorMessage)) {
        echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    }
    ?>

    <form id="form-ajout-rendezvous" method="POST">
        <div class="form-group">
            <label for="patientID">RendezVousID  :</label>
            <input type="text" class="form-control" id="rendezvousId" name="rendezvousID" required>
        </div>
        <div class="form-group">
            <label for="patientID">Patient ID :</label>
            <input type="text" class="form-control" id="patientID" name="patientID" required>
        </div>

        <div class="form-group">
            <label for="nomPatient">Nom du Patient :</label>
            <input type="text" class="form-control" id="nomPatient" name="nomPatient" required>
        </div>

        <div class="form-group">
            <label for="prenomPatient">Prénom du Patient :</label>
            <input type="text" class="form-control" id="prenomPatient" name="prenomPatient" required>
        </div>

        <div class="form-group">
            <label for="dateRendezVous">Date de Rendez-vous :</label>
            <input type="date" class="form-control" id="dateRendezVous" name="dateRendezVous" required>
        </div>

        <div class="form-group">
            <label for="heureRendezVous">Heure de Rendez-vous :</label>
            <input type="time" class="form-control" id="heureRendezVous" name="heureRendezVous" required>
        </div>

        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
        </div>
    </form>

    <script>
        document.getElementById('form-ajout-rendezvous').addEventListener('submit', function (event) {
            event.preventDefault(); // Empêche la soumission du formulaire par défaut

            // Récupération des données du formulaire
            var formData = new FormData(this);

            // Envoi des données au serveur via AJAX
            $.ajax({
                type: 'POST',
                url: 'traitement_rendezvous.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data); // Affiche la réponse du serveur dans la console

                    // Affiche une alerte SweetAlert en cas de succès
                    Swal.fire({
                        icon: 'success',
                        title: 'Rendez-vous ajouté avec succès!',
                        showConfirmButton: true,
                        confirmButtonText: 'Revenir en arrière',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirigez ou effectuez une autre action selon vos besoins
                            window.location.reload();
                        }
                    });
                },
                error: function (error) {
                    console.error('Erreur lors de l\'envoi des données :', error);
                }
            });
        });
    </script>
    
</body>
</html>
