<?php
require_once("../config.php");

require_once("../VilleModel.php");

// Ouvre la connexion DB en mode persistant
try {
    $dbh = new PDO(
      "mysql:host=$db_host;dbname=$db_name;charset=utf8",
      $db_username,
      $db_password,
      array(PDO::ATTR_PERSISTENT => true)
    );
} catch (PDOException $e) {
    echo "Erreur PDO: " . $e->getMessage() . "\n";
    die();
}

// Tester le modele

// Creation de l'objet VilleModel
$villeModel = new VilleModel($dbh);

// Ajout d'un utilisateur
$iId = $villeModel->create("Une ville");

// Lecture d'un User
echo "Lecture de la ville Cree $iId" . PHP_EOL;
print_r( $villeModel->read($iId) );

// Mise à jour d'un User
echo "\nUpdate ville $iId" . PHP_EOL;
$villeModel->update($iId, "Une ville modifiée");
print_r( $villeModel->read($iId) );

// Affichage des User dans la table
echo "\nAffichage de toutes les Villes de la table\n";
print_r( $villeModel->index() );

// effacement d'un User
echo "\nEffacement de ville $iId\n";
$villeModel->delete($iId);
print_r( $villeModel->index() );




$dbh = null;
