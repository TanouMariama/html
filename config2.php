<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "almadi";

class Database extends mysqli {
    private $errorMessage;
    private $successMessage;

    public function __construct($servername, $username, $password, $dbname) {
        parent::__construct($servername, $username, $password, $dbname);

        if ($this->connect_error) {
            die("La connexion a échoué : " . $this->connect_error);
        }
    }

    public function getListeRendezVous() {
        try {
            $rendezVous = array();

            // Remplacez 'votre_table_rendezvous' par le nom réel de votre table rendezvous
            $sql = "SELECT * FROM rendezvous";
            $result = $this->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rendezVous[] = $row;
                }
            }

            return $rendezVous;
        } catch (Exception $e) {
            // Gérer l'exception (enregistrer, afficher un message d'erreur, etc.)
            echo "Erreur : " . $e->getMessage();
            return array();
        }
    }
}

$conn = new Database($servername, $username, $password, $dbname);
?>
