<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO secteur (sec_id, sec_name) VALUES (NULL, :sec_name);");
define('QUERY_SELECT', "SELECT * FROM secteur WHERE sec_id=:sec_id");
define('QUERY_UPDATE', "UPDATE secteur SET sec_name = :sec_name WHERE sec_id = :sec_id ");
define('QUERY_DELETE', "DELETE FROM secteur WHERE sec_id= :sec_id ");
define('QUERY_INDEX', "SELECT * FROM secteur");


class Secteur extends Model
{
    private const FIELD_LIST = [
        'sec_id' => 'validateId',
        'sec_name' => 'validateString',
    ];


    public function __construct()
    {
        parent::__construct();
    }


    public function create()
    {
        $iIdCree = 0;

        $stmt1 = $this->dbh->prepare(QUERY_INSERT);
        $stmt1->bindValue(':sec_id', $this->sec_id, PDO::PARAM_INT);
        $stmt1->bindValue(':sec_name', $this->sec_name, PDO::PARAM_STR);
        if ($stmt1->execute()) {
            // recuperation de l'ID de la ligne crée
            $iIdCree = $this->dbh->lastInsertId();
        }
        $this->sec_id = $iIdCree;

        return ($iIdCree);
    }

    public function read($iId)
    {

        $stmt1 = $this->dbh->prepare(QUERY_SELECT);
        $stmt1->bindValue(':sec_id', $iId, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
        }

    }

    public function update()
    {
        $stmt1 = $this->dbh->prepare(QUERY_UPDATE);
        $stmt1->bindValue(':sec_name', $this->sec_name, PDO::PARAM_STR);
        $stmt1->bindValue(':sec_id', $this->sec_id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            //  echo "Update réussi\n";
        }

    }

    public function delete($iId)
    {
        $stmt1 = $this->dbh->prepare(QUERY_DELETE);
        $stmt1->bindValue(':sec_id', $iId, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            //    echo "L'effacement est réussi\n";
        }
    }

    public function index()
    {
        $aSecteur = array();

        $stmt1 = $this->dbh->prepare(QUERY_INDEX);
        if ($stmt1->execute()) {
            $aTypeSalle = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($aSecteur);
    }

}
