<?php
require_once("modele_user.php");

// Ouvre la connexion DB en mode persistant
try {
    $dbh = new PDO(
      'mysql:host=localhost;dbname=surface;charset=utf8',
      'root',
      '',
      array(PDO::ATTR_PERSISTENT => true)
    );
} catch (PDOException $e) {
    echo "Erreur PDO: " . $e->getMessage() . "\n";
    die();
}

// Creation utilisateur
// parametres formels
$iId = createUser( 'email5', 'password', '19700101' );
$aUser = readUser($iId);    // Lecture des données d'un utilisateur
print_r($aUser);


// Modification d'un utilisateur
updateUser($iId, 'toto', 'password', '19700101');
$aUser = readUser($iId);    // Lecture des données d'un utilisateur
print_r($aUser);


// Verification que l'utilisateur existe
$bExiste = existUser('email');
if ($bExiste) {
  echo "L'utilisateur existe\n";
} else {
  echo "L'utilisateur n'existe pas\n";
}

// Effacement utilisateur
deleteUser($iId);

// Affichage liste des utilisateurs
print_r(indexUser());

// Ferme Connexion DB
$dbh = null;

exit(0); // retourne au systeme 0 , le programme a fonctionné
