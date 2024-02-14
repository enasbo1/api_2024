<?php
include_once("./repository/origin.php");
include_once("./shared/utilisateur.php");


class Repository_addresse extends Repository_origin
{
    public function get_all()
    {
        $reponse = $this->get("addresse", ["id", "lieu"], []);
        return $reponse;
    }

    public function add_one(String $lieu): int|null
    {
        $this->post("addresse", ["lieu" => $lieu]);
        $addresse = $this->get("addresse", ["id"], ["lieu" => $lieu]);
        if (count($addresse) == 0) {
            return null;
        } else {
            return $addresse[0]['id'];
        }
    }
}
