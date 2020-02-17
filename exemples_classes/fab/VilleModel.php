<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO ville (vil_id, vil_desc) VALUES (NULL, :vil_desc);" );
define('QUERY_SELECT', "SELECT * FROM ville WHERE vil_id=:vil_id" );
define('QUERY_UPDATE', "UPDATE ville SET vil_desc = :vil_desc WHERE vil_id = :vil_id " );
define('QUERY_DELETE', "DELETE FROM ville WHERE vil_id= :vil_id " );
//define('QUERY_INDEX', "" );

class VilleModel
{
    private $dbh;     // connexion a la BDD

    public function __construct( $dbh )
    {
      $this->dbh = $dbh;
    }

    public function create( $sVilDesc)
    {
      $iIdCree = 0;

      // Prepare SQL statement
      $stmt1 = $this->dbh->prepare( QUERY_INSERT );
      $stmt1->bindValue(':vil_desc', $sVilDesc, PDO::PARAM_STR);
      if ( $stmt1->execute() ) {
        // recuperation de l'ID de la ligne crée
        $iIdCree = $this->dbh->lastInsertId();
      }

      return($iIdCree);
    }

    public function read( $iId )
    {
      $sVilDesc = "";

      $stmt1 = $this->dbh->prepare( QUERY_SELECT );
      $stmt1->bindValue(':vil_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
          $aUser = $stmt1->fetch(PDO::FETCH_ASSOC);
      }

      return($sVilDesc);
    }

    public function update( $iId, $sVilDesc )
    {
      $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
      $stmt1->bindValue(':vil_desc', $sVilDesc, PDO::PARAM_STR);
      $stmt1->bindValue(':vil_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
      //  echo "Update réussi\n";
      }
    }

    public function delete( $iId )
    {
      $stmt1 = $this->dbh->prepare( QUERY_DELETE );
      $stmt1->bindValue(':vil_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
    //    echo "L'effacement est réussi\n";
      }
    }

/*
    public function index()
    {
      $aVille = array();

      // Executer la requete

      return($aVille);
    }
*/

}
