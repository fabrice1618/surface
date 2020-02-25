<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO tranche_horaire (tra_id, tra_name) VALUES (NULL, :tra_name);");
define('QUERY_SELECT', "SELECT * FROM tranche_horaire WHERE tra_id=:tra_id");
define('QUERY_UPDATE', "UPDATE tranche_horaire SET tra_name = :tra_name WHERE tra_id = :tra_id ");
define('QUERY_DELETE', "DELETE FROM tranche_horaire WHERE tra_id= :tra_id ");
define('QUERY_INDEX', "SELECT * FROM tranche_horaire");

class Tranche extends Model
{
    private const FIELD_LIST = [
        'tra_id' => 'validateId',
        'tra_name' => 'validateString',
    ];


    public function __construct()
    {
        parent::__construct();
    }


    public function create()
    {
        $iIdCree = 0;

        $stmt1 = $this->dbh->prepare(QUERY_INSERT);
        $stmt1->bindValue(':tra_id', $this->tra_id, PDO::PARAM_INT);
        $stmt1->bindValue(':tra_name', $this->tra_name, PDO::PARAM_STR);
        if ($stmt1->execute()) {
            // recuperation de l'ID de la ligne crée
            $iIdCree = $this->dbh->lastInsertId();
        }
        $this->tra_id = $iIdCree;

        return ($iIdCree);
    }

    public function read($iId)
    {

        $stmt1 = $this->dbh->prepare(QUERY_SELECT);
        $stmt1->bindValue(':tra_id', $iId, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
        }

    }

    public function update()
    {
        $stmt1 = $this->dbh->prepare(QUERY_UPDATE);
        $stmt1->bindValue(':tra_name', $this->tra_name, PDO::PARAM_STR);
        $stmt1->bindValue(':tra_id', $this->tra_id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            //  echo "Update réussi\n";
        }

    }

    public function delete($iId)
    {
        $stmt1 = $this->dbh->prepare(QUERY_DELETE);
        $stmt1->bindValue(':tra_id', $iId, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            //    echo "L'effacement est réussi\n";
        }
    }

    public function index()
    {
        $aTranche = array();

        $stmt1 = $this->dbh->prepare(QUERY_INDEX);
        if ($stmt1->execute()) {
            $aTranche = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($aTranche);
    }

}
