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

    public function getListePatients() {
        try {
            $patients = array();

            $sql = "SELECT * FROM patients";
            $result = $this->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $patients[] = $row;
                }
            }

            return $patients;
        } catch (Exception $e) {
            // Gérer l'exception (enregistrer, afficher un message d'erreur, etc.)
            echo "Erreur : " . $e->getMessage();
            return array();
        }
    }
}

$conn = new Database($servername, $username, $password, $dbname);
?>
