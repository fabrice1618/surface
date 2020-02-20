<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO ville (vil_id, vil_desc) VALUES (NULL, :vil_desc);" );
define('QUERY_SELECT', "SELECT * FROM ville WHERE vil_id=:vil_id" );
define('QUERY_UPDATE', "UPDATE ville SET vil_desc = :vil_desc WHERE vil_id = :vil_id " );
define('QUERY_DELETE', "DELETE FROM ville WHERE vil_id= :vil_id " );
//define('QUERY_INDEX', "" );

class Ville extends Model
{
  private const FIELD_LIST = [
    'vil_id'=>'validateId',
    'vil_desc'=>'validateString'
];


  public function __construct()
  {
    parent::__construct();
  }

    public function create()
    {
      $iIdCree = 0;

      // Prepare SQL statement
      $stmt1 = $this->dbh->prepare( QUERY_INSERT );
      $stmt1->bindValue(':vil_desc', $this->vil_desc, PDO::PARAM_STR);
      if ( $stmt1->execute() ) {
        // recuperation de l'ID de la ligne crée
        $iIdCree = (int)$this->dbh->lastInsertId();
      }

    // MAJ de l'instance avec le usr_id de la database
    $this->vil_id = $iIdCree;

      return($iIdCree);
    }

    public function read( $iId )
    {

      $stmt1 = $this->dbh->prepare( QUERY_SELECT );
      $stmt1->bindValue(':vil_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
          $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
      }
    }

    public function update()
    {
      $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
      $stmt1->bindValue(':vil_desc', $this->vil_desc, PDO::PARAM_STR);
      $stmt1->bindValue(':vil_id', $this->vil_id, PDO::PARAM_INT);
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

}
