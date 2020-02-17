<?php
namespace Controller\Api;


// Ajouter requetes
define('QUERY_INSERT', " INSERT INTO logement (log_id, usr_id, log_nom, log_adresse, log_cp, vil_id, typ_id ) VALUES (NULL, :usr_id, :log_nom), :log_adresse, :log_cp, :vil_id, :typ_id " );
define('QUERY_SELECT', " SELECT * FROM logement WHERE log_id = :log_id " );
define('QUERY_UPDATE', " UPDATE logement SET log_id = :log_id, usr_id = :usr_id, log_nom = :log_nom, log_adresse = :log_adresse, log_cp = :log_cp, vil_id = :vil_id, typ_id = :typ_id WHERE log_id = :log_id,  " );
define('QUERY_DELETE', " DELETE FROM logement WHERE log_id = :log_id " );
define('QUERY_INDEX', " SELECT * FROM logement " );

class LogementModel
{
    private $dbh;     // connexion a la BDD

    public function __construct( $dbh )
    {
      $this->dbh = $dbh;
    }

    public function create( $oLogement )
    {
      $iIdCree = 0;

      $stmt1 = $this->dbh->prepare( QUERY_INSERT );
      $stmt1->bindValue(':log_id', $oLogement->getLogId(), PDO::PARAM_INT);
      $stmt1->bindValue(':pce_nom', $oLogement->getUserId(), PDO::PARAM_STR);
      $stmt1->bindValue(':pce_long', $oLogement->getLogNom(), PDO::PARAM_STR);
      $stmt1->bindValue(':pce_larg', $oLogement->getLogAdresse(), PDO::PARAM_STR);
      $stmt1->bindValue(':pce_nom', $oLogement->getLogCP(), PDO::PARAM_STR);
      $stmt1->bindValue(':pce_long', $oLogement->getVilleId(), PDO::PARAM_STR);
      $stmt1->bindValue(':pce_larg', $oLogement->getTypeId(), PDO::PARAM_STR);
      $stmt1->bindValue(':pce_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
        // recuperation de l'ID de la ligne crée
        $iIdCree = $this->dbh->lastInsertId();
      }
      return($iIdCree);
    }

    public function read( $iId )
    {
      $aLogement = array();

      $stmt1 = $this->dbh->prepare( QUERY_SELECT );
      $stmt1->bindValue(':log_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
          $aPiece = $stmt1->fetch(PDO::FETCH_ASSOC);
      }
      return($aLogement);
    }

    public function update( $iId, $oLogement )
    {
        $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
        $stmt1->bindValue(':log_id', $oLogement->getLogId(), PDO::PARAM_INT);
        $stmt1->bindValue(':pce_nom', $oLogement->getUserId(), PDO::PARAM_STR);
        $stmt1->bindValue(':pce_long', $oLogement->getLogNom(), PDO::PARAM_STR);
        $stmt1->bindValue(':pce_larg', $oLogement->getLogAdresse(), PDO::PARAM_STR);
        $stmt1->bindValue(':pce_nom', $oLogement->getLogCP(), PDO::PARAM_STR);
        $stmt1->bindValue(':pce_long', $oLogement->getVilleId(), PDO::PARAM_STR);
        $stmt1->bindValue(':pce_larg', $oLogement->getTypeId(), PDO::PARAM_STR);
        $stmt1->bindValue(':pce_id', $iId, PDO::PARAM_INT);
    }

    public function delete( $iId )
    {
        $stmt1 = $this->dbh->prepare( QUERY_DELETE );
        $stmt1->bindValue(':log_id', $iId, PDO::PARAM_INT);
    }

    public function index()
    {
      $aLogement = array();

      $stmt1 = $this->dbh->prepare(QUERY_INDEX);
      if ( $stmt1->execute() ) {
        $aLogement = $stmt1->fetchAll(PDO::FETCH_ASSOC);
      }

      return($aLogement);
    }

}
