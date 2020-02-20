<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO `piece` (`pce_id`, `log_id`, `pce_nom`, `pce_long`, `pce_larg`) VALUES (NULL, :log_id, :pce_nom, :pce_long, :pce_larg) " );
define('QUERY_SELECT', "SELECT * FROM `piece` WHERE pce_id = :pce_id " );
define('QUERY_UPDATE', "UPDATE `piece` SET pce_nom = :pce_nom, pce_long=:pce_long, pce_larg=:pce_larg WHERE pce_id = :pce_id " );
define('QUERY_DELETE', "DELETE FROM `piece` WHERE pce_id=:pce_id" );
define('QUERY_INDEX', "SELECT * FROM piece" );

class PieceModel
{
  private const FIELD_LIST = [
    'pce_id'=>'validateId',
    'log_id'=>'validateId',
    'pce_nom'=>'validateString',
    'pce_long'=>'validateDimension',
    'pce_larg'=>'validateDimension',

];


  public function __construct()
  {
    parent::__construct();
  }

  public function validateDimension( $nDimension )
  {
    $lReturn = false;

      if ( is_numeric($nDimension) && $nDimension < 20 && $nDimension > 0 ) {
          $lReturn = true;
      }
    return($lReturn);
  }

  public function getSurface()
  {
      $surface = $this->longueur * $this->largeur;

      return($surface);
  }


    public function create()
    {
      $iIdCree = 0;

      // Executer la requete
      $stmt1 = $this->dbh->prepare( QUERY_INSERT );
      $stmt1->bindValue(':log_id', $this->log_id, PDO::PARAM_INT);
      $stmt1->bindValue(':pce_nom', $this->pce_nom, PDO::PARAM_STR);
      $stmt1->bindValue(':pce_long', $this->pce_long, PDO::PARAM_STR);
      $stmt1->bindValue(':pce_larg', $this->pce_larg, PDO::PARAM_STR);
      if ( $stmt1->execute() ) {
        // recuperation de l'ID de la ligne crée
        $iIdCree = (int)$this->dbh->lastInsertId();
      }

      $this->pce_id = $iIdCree;

      return($iIdCree);
    }

    public function read( $iId )
    {

      // Executer la requete
      $stmt1 = $this->dbh->prepare( QUERY_SELECT );
      $stmt1->bindValue(':pce_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
          $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
      }

    }


    public function update()
    {
        // Executer la requete
        $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
        $stmt1->bindValue(':pce_nom', $this->pce_nom, PDO::PARAM_STR);
        $stmt1->bindValue(':pce_long', $this->pce_long, PDO::PARAM_STR);
        $stmt1->bindValue(':pce_larg', $this->pce_larg, PDO::PARAM_STR);
        $stmt1->bindValue(':pce_id', $this->pce_id, PDO::PARAM_INT);
        if ( $stmt1->execute() ) {
        //  echo "Update réussi\n";
        }

    }

    public function delete( $iId )
    {
        // Executer la requete
        $stmt1 = $this->dbh->prepare( QUERY_DELETE );
        $stmt1->bindValue(':pce_id', $iId, PDO::PARAM_INT);
        if ( $stmt1->execute() ) {
      //    echo "L'effacement est réussi\n";
        }
    }

    public function index()
    {
      $aPiece = array();

      // Executer la requete
      $stmt1 = $this->dbh->prepare(QUERY_INDEX);
      if ( $stmt1->execute() ) {
        $aPiece = $stmt1->fetchAll(PDO::FETCH_ASSOC);
      }

      return($aPiece);
    }

}
