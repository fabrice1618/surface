<?php

// Ajouter requetes
define('QUERY_INSERT', "" );
define('QUERY_SELECT', "" );
define('QUERY_UPDATE', "" );
define('QUERY_DELETE', "" );
define('QUERY_INDEX', "" );

class TypeLogementModel
{
    private $dbh;     // connexion a la BDD

    public function __construct( $dbh )
    {
      $this->dbh = $dbh;
    }

    public function create( $sTypDesc)
    {
      $iIdCree = 0;

      // Executer la requete

      return($iIdCree);
    }

    public function read( $iId )
    {
      $sTypDesc = "";

      // Executer la requete

      return($sTypDesc);
    }

    public function update( $iId, $sTypDesc )
    {
        // Executer la requete
    }

    public function delete( $iId )
    {
        // Executer la requete
    }

    public function index()
    {
      $aTypeLogement = array();

      // Executer la requete

      return($aTypeLogement);
    }

}
