<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Patient</title>
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

    <h1 class="mt-4">Ajouter un Patient</h1>

    <?php
    include 'traitement_patient.php';
    // Définir des messages de succès ou d'erreur ici
    if (!empty($successMessage)) {
        echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
    }
    if (!empty($errorMessage)) {
        echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    }
    ?>

<form id="form-ajout-patient" method="POST">
    <div class="form-group">
        <label for="nom">Nom :</label>
        <div class="input-group">
            <input type="text" class="form-control" id="nom" name="nom" required>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="prenom">Prénom :</label>
        <div class="input-group">
            <input type="text" class="form-control" id="prenom" name="prenom" required>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="date_naissance">Date de Naissance :</label>
        <div class="input-group">
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <div class="input-group">
            <input type="email" class="form-control" id="email" name="email">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="telephone">Téléphone :</label>
        <div class="input-group">
            <input type="tel" class="form-control" id="telephone" name="telephone">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-phone"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Ajoutez ici d'autres champs du formulaire -->

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
    </div>
</form>


    <script>
        document.getElementById('form-ajout-patient').addEventListener('submit', function (event) {
            event.preventDefault(); // Empêche la soumission du formulaire par défaut

            // Récupération des données du formulaire
            var formData = new FormData(this);

            // Envoi des données au serveur via AJAX
            $.ajax({
                type: 'POST',
                url: 'traitement_patient.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data); // Affiche la réponse du serveur dans la console

                    // Affiche une alerte SweetAlert en cas de succès
                    Swal.fire({
                        icon: 'success',
                        title: 'Patient ajouté avec succès!',
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
