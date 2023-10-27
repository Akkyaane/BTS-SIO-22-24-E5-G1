<?php
// Connexion à la base de données
$serveur = "localhost";
$base_de_donnees = "votre_base_de_donnees";
$utilisateur = "votre_utilisateur";
$mot_de_passe = "votre_mot_de_passe";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du formulaire
    $date = $_POST['date'];
    $description = $_POST['description'];
    $montant = $_POST['montant'];

    // Préparer et exécuter la requête SQL d'insertion
    $requete = $connexion->prepare("INSERT INTO fiches_de_frais (date, description, montant) VALUES (:date, :description, :montant)");
    $requete->bindParam(':date', $date);
    $requete->bindParam(':description', $description);
    $requete->bindParam(':montant', $montant);
    $requete->execute();

    echo "Fiche de frais ajoutée avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermer la connexion à la base de données
$connexion = null;
?>
