<?php
include_once("./origin.php");
include_once("../shared/utilisateur.php");


class Repository_connection extends Repository_origin
{
    public function is_inscrit(String $nom): bool
    {
        $nom;
        return false;
    }

    public function connect(String $nom, String $mdp): Utilisateur|null
    {
        $nom;
        $mdp;
        return new Utilisateur;
    }
}
