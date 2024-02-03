<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "almadi";

class Database extends mysqli {
    private $errorMessage;
    private $successMessage;

    public function __construct($servername, $username, $password, $dbname) {
        facture::__construct($servername, $username, $password, $dbname);

        if ($this->connect_error) {
            die("La connexion a échoué : " . $this->connect_error);
        }
    }

    public function getfacture() {
        try {
            $facture = array();

            $sql = "SELECT * FROM facture";
            $result = $this->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $facture[] = $row;
                }
            }

            return $facture;
        } catch (Exception $e) {
            // Gérer l'exception (enregistrer, afficher un message d'erreur, etc.)
            echo "Erreur : " . $e->getMessage();
            return array();
        }
    }
}

$conn = new Database($servername, $username, $password, $dbname);

// Connexion à la base de données MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

echo "Connexion à la base de données réussie !";

// Vous pouvez maintenant exécuter des requêtes SQL avec la variable $conn

// Fermeture de la connexion à la fin de votre script (assurez-vous de le faire)
$conn->close();
?>
