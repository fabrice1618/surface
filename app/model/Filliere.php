<?php

// Ajouter requetes
define('QUERY_INSERT', "INSERT INTO filliere (fil_id, fil_name, fil_nb) VALUES (NULL, :fil_name, :fil_nb);");
define('QUERY_SELECT', "SELECT * FROM filliere WHERE fil_id=:fil_id");
define('QUERY_UPDATE', "UPDATE filliere SET fil_name = :fil_name, fil_nb = :fil_nb WHERE fil_id = :fil_id ");
define('QUERY_DELETE', "DELETE FROM filliere WHERE fil_id= :fil_id ");
define('QUERY_INDEX', "SELECT * FROM filliere");

class FilliereModel extends Model
{
    const FIELD_LIST = [
        'fil_id' => 'validateId',
        'fil_name' => 'validateString',
        'fil_nb' => 'validateNb',
    ];


    public function __construct()
    {
        parent::__construct();
    }


    public function create()
    {
        $id = 0;

        $stmt1 = $this->dbh->prepare(QUERY_INSERT);
        $stmt1->bindValue(':fil_name', $this->fil_name, PDO::PARAM_STR);
        $stmt1->bindValue(':fil_nb', $this->fil_nb, PDO::PARAM_INT);
        if ($stmt1->execute()) {

        }

        return ($id);
    }

    public function read($id)
    {


        $stmt1 = $this->dbh->prepare(QUERY_SELECT);
        $stmt1->bindValue(':fil_id', $id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            $this->data = $stmt1->fetch(PDO::FETCH_ASSOC);
        }

    }

    public function update()
    {
        $stmt1 = $this->dbh->prepare(QUERY_UPDATE);
        $stmt1->bindValue(':fil_name', $this->fil_name, PDO::PARAM_STR);
        $stmt1->bindValue(':fil_nb', $this->fil_nb, PDO::PARAM_STR);
        $stmt1->bindValue(':fil_id', $this->fil_id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            // echo "Update réussi\n";
        }
    }

    public function delete($id)
    {
        $stmt1 = $this->dbh->prepare(QUERY_DELETE);
        $stmt1->bindValue(':fil_id', $id, PDO::PARAM_INT);
        if ($stmt1->execute()) {
            // echo "L'effacement est réussi\n";
        }
    }

    public function index()
    {
        $filliere = array();

        $stmt1 = $this->dbh->prepare(QUERY_INDEX);
        if ($stmt1->execute()) {

            $filliere = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        }

        return ($filliere);
    }


}