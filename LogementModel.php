<?php

// Ajouter requetes
define('QUERY_INSERT', "" );
define('QUERY_SELECT', "" );
define('QUERY_UPDATE', "" );
define('QUERY_DELETE', "" );
define('QUERY_INDEX', "" );

class LogementModel
{
    private $dbh;     // connexion a la BDD

    public function __construct( $dbh )
    {
      $this->dbh = $dbh;
    }

    public function create( $logement )
    {
      $iIdCree = 0;

      // Executer la requete

      return($iIdCree);
    }

    public function read( $iId )
    {
      $aLogement = array();

      // Executer la requete

      return($aLogement);
    }

    public function update( $iId, $logement )
    {
        // Executer la requete
    }

    public function delete( $iId )
    {
        // Executer la requete
    }

    public function index()
    {
      $aLogement = array();

      // Executer la requete

      return($aLogement);
    }

}
