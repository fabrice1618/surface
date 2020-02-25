<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO salle (sal_id, sal_name, typ_id, sec_id) VALUES (NULL, :sal_name, :typ_id, :sec_id);");
define('QUERY_SELECT', "SELECT * FROM salle WHERE sal_id=:sal_id");
define('QUERY_UPDATE', "UPDATE salle SET sal_name = :sal_name, typ_id = :typ_id, sec_id = :sec_id WHERE sal_id = :sal_id ");
define('QUERY_DELETE', "DELETE FROM salle WHERE sal_id= :sal_id ");
define('QUERY_INDEX', "SELECT * FROM salle");

class salleModel extends Model
{
    private const FIELD_LIST = [
        'sal_id' => 'validateId',
        'sal_name' => 'validateString',
        'sec_id' => 'validateId',
        'typ_id' => 'validateId',
    ];


    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $id = 0;

        $stmt1 = $this->dbh->prepare(QUERY_INSERT);
        $stmt1->bindValue(':sal_name', $this->sal_name, PDO::PARAM_INT);
        $stmt1->bindValue(':typ_id', $this->typ_id, PDO::PARAM_INT);
        $stmt1->bindValue(':sec_id', $this->sec_id, PDO::PARAM_INT);
        if ($stmt1->execute()) {

        }

        return ($id);
    }

    public function read($id)
    {

        $stmt1 = $this->dbh->prepare(QUERY_SELECT);
        $stmt1->bindValue(':sal_id', $id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $salle = $stmt1->fetch(PDO::FETCH_ASSOC);
        }

    }

    public function update()
    {
        $stmt1 = $this->dbh->prepare(QUERY_UPDATE);
        $stmt1->bindValue(':sal_name', $this->sal_name, PDO::PARAM_INT);
        $stmt1->bindValue(':sal_id', $this->sal_id, PDO::PARAM_INT);
        $stmt1->bindValue(':typ_id', $this->typ_id, PDO::PARAM_INT);
        $stmt1->bindValue(':sec_id', $this->sec_id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            // echo "Update réussi\n";
        }
    }

    public function delete($id)
    {
        $stmt1 = $this->dbh->prepare(QUERY_DELETE);
        $stmt1->bindValue(':sal_id', $id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            // echo "L'effacement est réussi\n";
        }
    }

    public function index()
    {
        $salle = array();

        $stmt1 = $this->dbh->prepare(QUERY_INDEX);
        if ($stmt1->execute()) {

            $salle = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($salle);
    }


}