<?php
require_once("../config.php");

require_once("../VilleModel.php");

// Ouvre la connexion DB en mode persistant
try {
    $dbh = new PDO(
      "mysql:host=$config_DBhost;dbname=$config_DBname;charset=utf8",
      $config_DBusername,
      $config_DBpassword,
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

// effacement d'un User
echo "\nEffacement de ville $iId\n";
$villeModel->delete($iId);


$dbh = null;
