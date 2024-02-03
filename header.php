<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLINIQUE WEBSITE</title>
    <link rel="stylesheet" href="style.css">

    <style>
/* Ajoutez ces styles dans votre fichier style.css */
.menu .submenu {
    display: none;
    position: absolute;
    background-color: #fff; /* Couleur de fond du sous-menu */
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2); /* Ombre du sous-menu */
}

.menu .submenu:hover .subsubmenu {
    display: block; /* Affiche le sous-sous-menu au survol du sous-menu */
}

.menu:hover .submenu {
    display: block; /* Affiche le sous-menu lorsque le menu est survolé */
}

.submenu .subsubmenu {
    display: none;
    position: absolute;
    top: 100%; /* Ajuste la position pour qu'il soit en dessous du sous-menu principal */
    left: 0;
    background-color: #fff;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
}

    </style>
</head>
<body>
    <header>
        <div class="logo"> <span>CLINIQUE</span>ALMADI</div>
        <ul class="menu">
            <a href="index.php">Accueil</a>
            <!-- Ajoutez ces éléments dans la liste Fonctionnalités -->
            <a href="#">Fonctionnalités</a>
            <ul class="submenu">
                <li><a href="Rendez-vous">Rendez-vous</a></li>
                <li><a href="facture.php">Facturation</a></li>
                <li><a href="ajout_patient.php">Patients</a></li>
                <li><a href="Consultation">Consultation</a>
                </li>
            </ul>
            <a href="A propos">A propos</a>
            <a href="Contact.php">Contact</a>
            <a href="Connexion.php">Connexion</a>
        </ul>
    </header>

    <!-- Ajoutez ces scripts dans votre fichier HTML, après le chargement du DOM -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const submenu = document.querySelector('.menu .submenu');

            submenu.addEventListener('mouseover', function () {
                submenu.style.display = 'block';
            });

            submenu.addEventListener('mouseout', function () {
                submenu.style.display = 'none';
            });
        });
    </script>
</body>
</html>