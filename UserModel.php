<?php
require_once("User.php");

// Les requetes sont regroupées en haut du script pour faciliter la maintenance
// Utilisation de define pour definir les requetes
define('QUERY_INSERT', "INSERT INTO user (usr_id, usr_email, usr_password, usr_date_connexion) VALUES (NULL, :usr_email, :usr_password, :usr_date_connexion) " );
define('QUERY_SELECT', "SELECT * FROM user WHERE usr_id = :usr_id " );
define('QUERY_UPDATE', "UPDATE user SET usr_email = :usr_email, usr_password = :usr_password, usr_date_connexion = :usr_date_connexion WHERE usr_id = :usr_id" );
define('QUERY_DELETE', "DELETE FROM user WHERE usr_id = :usr_id " );
define('QUERY_INDEX', "SELECT * FROM user" );

class UserModel
{
  private $dbh;     // connexion a la BDD

  public function __construct( $dbh )
  {
    $this->dbh = $dbh;
  }

  public function create( $oUser)
  {
    $iIdCree = 0;

    // Prepare SQL statement
    $stmt1 = $this->dbh->prepare( QUERY_INSERT );
    $stmt1->bindValue(':usr_email', $oUser->getEmail(), PDO::PARAM_STR);
    $stmt1->bindValue(':usr_password', $oUser->getPasswordHash(), PDO::PARAM_STR);
    $stmt1->bindValue(':usr_date_connexion', $oUser->getDateConnexion(), PDO::PARAM_STR);
    if ( $stmt1->execute() ) {
      // recuperation de l'ID de la ligne crée
      $iIdCree = $this->dbh->lastInsertId();
    }

    return($iIdCree);
  }

  public function read( $iId )
  {
    $aUser = array();

    $stmt1 = $this->dbh->prepare( QUERY_SELECT );
    $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
        $aUser = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }

    return($aUser);
  }

  public function update( $iId, $oUser )
  {
    $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
    $stmt1->bindValue(':usr_email', $oUser->getEmail(), PDO::PARAM_STR);
    $stmt1->bindValue(':usr_password', $oUser->getPasswordHash(), PDO::PARAM_STR);
    $stmt1->bindValue(':usr_date_connexion', $oUser->getDateConnexion(), PDO::PARAM_STR);
    $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
    //  echo "Update réussi\n";
    }

  }

  public function delete( $iId )
  {

    $stmt1 = $this->dbh->prepare( QUERY_DELETE );
    $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
  //    echo "L'effacement est réussi\n";
    }

  }

  public function index()
  {
    $aUser = array();

    $stmt1 = $this->dbh->prepare(QUERY_INDEX);
    if ( $stmt1->execute() ) {
      $aUser = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }

    return($aUser);
  }

}
