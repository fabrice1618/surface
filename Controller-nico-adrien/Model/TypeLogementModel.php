<?php
namespace Controller\Api;

require_once("TypeLogement.php");

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO type_logement (typ_id, typ_desc) VALUES (NULL, :typ_id, :typ_desc) " );
define('QUERY_SELECT', "SELECT * FROM type_logement WHERE typ_id = :typ_id " );
define('QUERY_UPDATE', "UPDATE type_logement SET typ_id = :typ_id, typ_desc = :typ_desc WHERE typ_id = :typ_id" );
define('QUERY_DELETE', "DELETE FROM type_logement WHERE typ_id = :typ_id " );
define('QUERY_INDEX', "SELECT * FROM type_logement" );

class TypeLogementModel
{
    private $dbh;     // connexion a la BDD

    public function __construct( $dbh )
    {
      $this->dbh = $dbh;
    }

    public function create( $oType_logement)
    {
      $iIdCree = 0;

      // Executer la requete
      // Prepare SQL statement
      $stmt1 = $this->dbh->prepare( QUERY_INSERT );
      $stmt1->bindValue(':typ_id', $oType_logement->getTypId(), PDO::PARAM_INT);
      $stmt1->bindValue(':typ_desc', $oType_logement->getDesc(), PDO::PARAM_STR);

      if ( $stmt1->execute() ) {
        // recuperation de l'ID de la ligne crée
        $iIdCree = $this->dbh->lastInsertId();
      }

      return($iIdCree);
    }

    public function read( $iId )
    {
      $sTypDesc = "";

      // Executer la requete
      $stmt1 = $this->dbh->prepare( QUERY_SELECT );
      $stmt1->bindValue(':typ_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
          $aTypeLogement = $stmt1->fetch(PDO::FETCH_ASSOC);
      }

      return($sTypDesc);
    }

    public function update( $iId, $sTypDesc )
    {
        // Executer la requete
        $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
        $stmt1->bindValue(':typ_id', $oType_logement->getTypId(), PDO::PARAM_INT);
        $stmt1->bindValue(':typ_desc', $oType_logement->getDesc(), PDO::PARAM_STR);
    }

    public function delete( $iId )
    {
        // Executer la requete
        $stmt1 = $this->dbh->prepare( QUERY_DELETE );
        $stmt1->bindValue(':typ_id', $iId, PDO::PARAM_INT);
    }

    public function index()
    {
      $aTypeLogement = array();

      // Executer la requete
      $stmt1 = $this->dbh->prepare(QUERY_INDEX);
      if ( $stmt1->execute() ) {
        $aTypeLogement = $stmt1->fetchAll(PDO::FETCH_ASSOC);
      }

      return($aTypeLogement);
    }

}
