<?php
require_once("User.php");

class UserModel
{
  private $dbh;

  public function __construct( $dbh )
  {
    $this->dbh = $dbh;
  }

  public function create( $oUser)
  {
    $iIdCree = 0;

    // Prepare SQL statement
    $stmt1 = $this->dbh->prepare("INSERT INTO user (usr_id, usr_email, usr_password, usr_date_connexion) VALUES (NULL, :usr_email, :usr_password, :usr_date_connexion) ");
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

    $stmt1 = $this->dbh->prepare("SELECT * FROM user WHERE usr_id = :usr_id ");
    $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
      while ($aRow = $stmt1->fetch(PDO::FETCH_ASSOC)) {
          $aUser = $aRow;
          }
    }

    return($aUser);
  }

  public function update( $iId, $oUser )
  {
    $stmt1 = $this->dbh->prepare("UPDATE user SET usr_email = :usr_email, usr_password = :usr_password, usr_date_connexion = :usr_date_connexion WHERE usr_id = :usr_id");
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

    $stmt1 = $this->dbh->prepare("DELETE FROM user WHERE usr_id = :usr_id ");
    $stmt1->bindValue(':usr_id', $iId, PDO::PARAM_INT);
    if ( $stmt1->execute() ) {
  //    echo "L'effacement est réussi\n";
    }

  }

  public function index()
  {
    $aUser = array();

    $stmt1 = $this->dbh->prepare("SELECT * FROM user");
    if ( $stmt1->execute() ) {
      $aUser = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }

    return($aUser);
  }

}
