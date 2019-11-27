<?php
require_once("modele_departement.php");

// Ouvre la connexion DB en mode persistant
try {
    $dbh = new PDO(
      'mysql:host=localhost;dbname=ville;charset=utf8',
      'root',
      '',
      array(PDO::ATTR_PERSISTENT => true)
    );
} catch (PDOException $e) {
    echo "Erreur PDO: " . $e->getMessage() . "\n";
    die();
}

createDepartement('AZ', 'Azerty');
$aDepartement = readDepartement('AZ');
print_r($aDepartement);

updateDepartement('AZ', "poiuytr");
$aDepartement = readDepartement('AZ');
print_r($aDepartement);

deleteDepartement('AZ');

print_r(indexDepartement());

// Ferme Connexion DB
$dbh = null;
