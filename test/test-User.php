<?php
$sBasepath = "../";
require_once($sBasepath."app/core/autoload.php");

echo $sBasepath."app/core/autoload.php\n";

$oApp = new App();
$oApp->openDatabase();

$unUser = new User();
$unUser->usr_email = "toto@toto.fr";
$unUser->usr_password = "password";
$unUser->usr_date_connexion = "20200214";
$unUser->usr_role = "user";
print_r($unUser->toArray());
echo "\n";

try {
  //  $unUser->usr_email = "toto";
  //  $unUser->usr_password = "";
  //  $unUser->usr_date_connexion = "ABCD0214";
//    $unUser->usr_role = "root";
//    $unUser->inconnu = "test";
//    $unUser->usr_id = 12;

} catch (\Exception $e) {
    $sMessage = sprintf(
        "%s: dans %s à la ligne %d : %s",
        get_class($e),
        $e->getFile(),
        $e->getLine(),
        $e->getMessage());
    echo $sMessage . PHP_EOL;
}

// Affichage des informations utilisateurs
$unUser->newPassword();
$unUser->usr_email="user".rand(0,1000)."@toto.fr";
echo "ID=".$unUser->usr_id.PHP_EOL;
echo "email=".$unUser->usr_email.PHP_EOL;
echo "passwordHash=".$unUser->usr_password.PHP_EOL;
echo "date_connexion=".$unUser->usr_date_connexion.PHP_EOL;
echo "Role=".$unUser->usr_role.PHP_EOL;

$nId= $unUser->create();

$oUser = new User;
$oUser->read($nId);
var_dump($oUser);

echo "Update usr_password\n";
$oUser->usr_password = ":)";
$oUser->update();
print_r($oUser->toArray());
echo "delete User ID=$nId\n";
$oUser->delete($nId);

$oUser2 = new User;
$oUser2->readByEmail('toto@example.com');
print_r($oUser2->toArray());
echo "\n";
unset($oUser2);





exit(0);

//var_dump($unUser);
