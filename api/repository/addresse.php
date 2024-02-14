<?php
include_once("./repository/origin.php");
include_once("./shared/utilisateur.php");


class Repository_addresse extends Repository_origin
{
    public function get_all()
    {
        $reponse = $this->get("addresse",["id", "lieu"], []);
        return $reponse;
    }

    public function add_one(String $lieu){
        $this->post("addresse", ["lieu"=>$lieu]);
    }
}
