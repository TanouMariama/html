<?php
class Personne {
    // Attributs
    public $nom;
    public $prenom;
    public $age;

    // Méthodes
    public function afficherNomComplet() {
        return $this->prenom . " " . $this->nom;
    }

    public function feterAnniversaire() {
        $this->age++;
    }
}

// Instanciation d'un objet à partir de la classe Personne
$personne1 = new Personne();

// Utilisation des attributs et des méthodes de l'objet
$personne1->nom = "Doe";
$personne1->prenom = "John";
$personne1->age = 30;

echo $personne1->afficherNomComplet(); // Affiche "John Doe"
$personne1->feterAnniversaire(); // Augmente l'âge de 1
echo $personne1->age; // Affiche 31
?>
