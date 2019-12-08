<?php
require_once("../config.php");

require_once("../User.php");
require_once("../UserModel.php");

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

// Creation de l'objet User
$unUser = new User("bob@example.com");
$unUser->setDateConnexion(date("Ymd"));

// Creation de l'objet UserModel
$userModel = new UserModel($dbh);

// Ajout d'un utilisateur
$iId = $userModel->create($unUser);

// Lecture d'un User
echo "Lecture du User Cree $iId" . PHP_EOL;
print_r( $userModel->read($iId) );

// Mise à jour d'un User
echo "\nUpdate du User $iId" . PHP_EOL;
$unUser->newPassword();
$userModel->update($iId, $unUser);
print_r( $userModel->read($iId) );

// Affichage des User dans la table
echo "\nAffichage de tous les User de la table\n";
print_r( $userModel->index() );

// effacement d'un User
echo "\nEffacement du User $iId\n";
$userModel->delete($iId);
print_r( $userModel->index() );








$dbh = null;
