<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO `type_logement` (`typ_id`, `typ_desc`) VALUES (NULL, :typ_desc)" );
define('QUERY_SELECT', "SELECT * FROM type_logement WHERE typ_id=:typ_id " );
define('QUERY_UPDATE', "UPDATE type_logement SET typ_desc=:typ_desc WHERE typ_id=:typ_id " );
define('QUERY_DELETE', "DELETE FROM type_logement WHERE typ_id=:typ_id" );
define('QUERY_INDEX', "SELECT * FROM type_logement" );

class TypeLogement extends Model
{
  private const FIELD_LIST = [
    'typ_id'=>'validateId',
    'typ_desc'=>'validateString'
];

public function __construct()
{
  parent::__construct();
}

    public function create()
    {
      $iIdCree = 0;

      // Executer la requete
      $stmt1 = $this->dbh->prepare( QUERY_INSERT );
      $stmt1->bindValue(':typ_desc', $this->typ_desc, PDO::PARAM_STR);
      if ( $stmt1->execute() ) {
        // recuperation de l'ID de la ligne crée
        $iIdCree = $this->dbh->lastInsertId();
      }

      $this->typ_id = $iIdCree;

      return($iIdCree);
    }

    public function read( $iId )
    {

      // Executer la requete
      $stmt1 = $this->dbh->prepare( QUERY_SELECT );
      $stmt1->bindValue(':typ_id', $iId, PDO::PARAM_INT);
      if ( $stmt1->execute() ) {
        $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
      }

    }

    public function update()
    {
        // Executer la requete
        $stmt1 = $this->dbh->prepare( QUERY_UPDATE );
        $stmt1->bindValue(':typ_desc', $this->typ_desc, PDO::PARAM_STR);
        $stmt1->bindValue(':typ_id', $this->typ_id, PDO::PARAM_INT);
        if ( $stmt1->execute() ) {
        //  echo "Update réussi\n";
        }

    }

    public function delete( $iId )
    {
        // Executer la requete
        $stmt1 = $this->dbh->prepare( QUERY_DELETE );
        $stmt1->bindValue(':typ_id', $iId, PDO::PARAM_INT);
        if ( $stmt1->execute() ) {
      //    echo "L'effacement est réussi\n";
        }
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
