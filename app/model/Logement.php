<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO logement (log_id, usr_id, log_nom, log_adresse, log_cp, vil_id, typ_id ) VALUES (NULL, :usr_id, :log_nom, :log_adresse, :log_cp, :vil_id, :typ_id ) " );
define('QUERY_SELECT', "SELECT * FROM logement WHERE log_id = :log_id " );
define('QUERY_UPDATE', "UPDATE logement SET log_nom = :log_nom, log_adresse = :log_adresse, log_cp = :log_cp, vil_id = :vil_id, typ_id = :typ_id WHERE log_id = :log_id " );
define('QUERY_DELETE', "DELETE FROM logement WHERE log_id = :log_id " );
define('QUERY_INDEX', "SELECT * FROM logement " );

class Logement extends Model
{
  private const FIELD_LIST = [
    'log_id'=>'validateId',
    'usr_id'=>'validateId',
    'log_nom'=>'validateString',
    'log_adresse'=>'validateString',
    'log_cp'=>'validateLog_cp',
    'vil_id'=>'validateId',
    'typ_id'=>'validateId'
];


  public function __construct()
  {
    parent::__construct();
  }

  private function validateLog_cp($sLog_cp)
  {
      $lReturn = false;

      if ( is_string($sLog_cp) && intval($sLog_cp) > 0 ) {
          $lReturn = true;
      }

    return($lReturn);
  }

  
    public function create()
    {
      $iIdCree = 0;

      $stmt1 = $this->dbh->prepare( QUERY_INSERT );
      $stmt1->bindValue(':usr_id', $this->usr_id, PDO::PARAM_INT);
      $stmt1->bindValue(':log_nom', $this->log_nom, PDO::PARAM_STR);
      $stmt1->bindValue(':log_adresse', $this->log_adresse, PDO::PARAM_STR);
      $stmt1->bindValue(':log_cp', $this->log_cp, PDO::PARAM_STR);
      $stmt1->bindValue(':vil_id', $this->vil_id, PDO::PARAM_INT);
      $stmt1->bindValue(':typ_id', $this->typ_id, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
        // recuperation de l'ID de la ligne crée
        $iIdCree = $this->dbh->lastInsertId();
      }
      $this->log_id = $iIdCree;

      return($iIdCree);
    }

    public function read( $iId )
    {

      $stmt1 = $this->dbh->prepare( QUERY_SELECT );
      $stmt1->bindValue(':log_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
          $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
      }

    }

    public function update()
    {
        $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
        $stmt1->bindValue(':log_nom', $this->log_nom, PDO::PARAM_STR);
        $stmt1->bindValue(':log_adresse', $this->log_adresse, PDO::PARAM_STR);
        $stmt1->bindValue(':log_cp', $this->log_cp, PDO::PARAM_STR);
        $stmt1->bindValue(':vil_id', $this->vil_id, PDO::PARAM_INT);
        $stmt1->bindValue(':typ_id', $this->typ_id, PDO::PARAM_INT);
        $stmt1->bindValue(':log_id', $this->log_id, PDO::PARAM_INT);
        if ( $stmt1->execute() ) {
          //  echo "Update réussi\n";
          }

    }

    public function delete( $iId )
    {
        $stmt1 = $this->dbh->prepare( QUERY_DELETE );
        $stmt1->bindValue(':log_id', $iId, PDO::PARAM_INT);
        if ( $stmt1->execute() ) {
          //    echo "L'effacement est réussi\n";
            }
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
