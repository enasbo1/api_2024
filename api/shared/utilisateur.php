<?php

class Utilisateur
{
    public int $id;
    public string $nom;
    public int $status;

    public function set_from_array($array)
    {
        $this->id = $array["id"];
        $this->nom = $array["nom"];
        $this->status = $array["status"];
    }
}
?>