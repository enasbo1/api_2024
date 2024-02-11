<?php

class Utilisateur
{
    public int $id;
    public string $nom;
    public string $mdp;
    public int $status;

    public function set_from_array($array)
    {
        $this->id = $array["id"];
        $this->nom = $array["nom"];
        $this->mdp = $array["mdp"];
        $this->status = $array["status"];
    }
}
?>