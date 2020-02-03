<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO `piece` (`pce_id`, `log_id`, `pce_nom`, `pce_long`, `pce_larg`) VALUES (NULL, :log_id, :pce_nom, :pce_long, :pce_larg) " );
define('QUERY_SELECT', "SELECT * FROM `piece` WHERE pce_id = :pce_id " );
define('QUERY_UPDATE', "UPDATE `piece` SET pce_nom = :pce_nom, pce_long=:pce_long, pce_larg=:pce_larg WHERE pce_id = :pce_id " );
define('QUERY_DELETE', "DELETE FROM `piece` WHERE pce_id=:pce_id" );
define('QUERY_INDEX', "SELECT * FROM piece" );

class PieceModel
{
    private $dbh;     // connexion a la BDD

    public function __construct( $dbh )
    {
      $this->dbh = $dbh;
    }

    public function create( $oPiece )
    {
      $iIdCree = 0;

      // Executer la requete
      $stmt1 = $this->dbh->prepare( QUERY_INSERT );
      $stmt1->bindValue(':log_id', $oPiece->getLogId(), PDO::PARAM_INT);
      $stmt1->bindValue(':pce_nom', $oPiece->getNom(), PDO::PARAM_STR);
      $stmt1->bindValue(':pce_long', $oPiece->getLongueur(), PDO::PARAM_STR);
      $stmt1->bindValue(':pce_larg', $oPiece->getLargeur(), PDO::PARAM_STR);
      if ( $stmt1->execute() ) {
        // recuperation de l'ID de la ligne crée
        $iIdCree = $this->dbh->lastInsertId();
      }

      return($iIdCree);
    }

    public function read( $iId )
    {
      $aPiece = array();

      // Executer la requete
      $stmt1 = $this->dbh->prepare( QUERY_SELECT );
      $stmt1->bindValue(':pce_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
          $aPiece = $stmt1->fetch(PDO::FETCH_ASSOC);
      }

      return($aPiece);
    }


    public function update( $iId, $oPiece )
    {
        // Executer la requete
        $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
        $stmt1->bindValue(':pce_nom', $oPiece->getNom(), PDO::PARAM_STR);
        $stmt1->bindValue(':pce_long', $oPiece->getLongueur(), PDO::PARAM_STR);
        $stmt1->bindValue(':pce_larg', $oPiece->getLargeur(), PDO::PARAM_STR);
        $stmt1->bindValue(':pce_id', $iId, PDO::PARAM_INT);
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
