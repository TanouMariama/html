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

    public function getListeDossiersMedicaux() {
        try {
            $dossiersMedicaux = array();

            // Remplacez 'votre_table_dossiers_medicaux' par le nom réel de votre table
            $sql = "SELECT * FROM dossiers_medicaux";
            $result = $this->query($sql);

            if ($result === false) {
                throw new Exception($this->error);
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dossiersMedicaux[] = $row;
                }
            }

            return $dossiersMedicaux;
        } catch (Exception $e) {
            // Gérez l'exception (enregistrez, affichez un message d'erreur, etc.)
            echo "Erreur : " . $e->getMessage();
            return array();
        }
    }

    public function ajouterDossierMedical($patient_id, $code, $date_creation) {
        try {
            // Préparer la requête d'insertion
            $stmt = $this->prepare("INSERT INTO dossiers_medicaux (patient_id, code, date_creation) VALUES (?, ?, ?)");

            // Liage des paramètres
            $stmt->bind_param("sss", $patient_id, $code, $date_creation);

            // Exécution de la requête
            $stmt->execute();

            // Vérification des erreurs
            if ($stmt->error) {
                throw new Exception("Erreur d'insertion : " . $stmt->error);
            }

            // Fermeture du statement
            $stmt->close();

            // Retourner un message de succès si nécessaire
            return "Dossier médical ajouté avec succès!";
        } catch (Exception $e) {
            // Gérer l'exception (enregistrez, affichez un message d'erreur, etc.)
            echo "Erreur : " . $e->getMessage();
            return "Erreur lors de l'ajout du dossier médical";
        }
    }
}

$conn = new Database($servername, $username, $password, $dbname);
?>
