<?php
include_once("./repository/origin.php");
include_once("./shared/utilisateur.php");


class Repository_utilisateur extends Repository_origin
{
    public function is_inscrit(String $nom): bool
    {
        $element = $this->get("utilisateur", ["id"], ["nom"=>$nom]);
        return($element!=[]);
    }

    public function connect(String $nom, String $mdp): Utilisateur|null
    {
        $element = $this->get("utilisateur", ["id"], ["nom"=>$nom]);
        if ($element==[])
        {
            return null;
        }
        $utilisateur = new Utilisateur;
        $utilisateur->set_from_array($element[0]);
        return $utilisateur;
    }
}
