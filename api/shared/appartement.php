<?php

class Appartement
{
    public int $id;
    public int $capacite;
    public int $superficie;
    public int $disponible;
    public int $prix;
    public int $v_admin;
    public int $v_proprio;
    public int $id_proprio;
    public int $id_addresse;

    public function set_from_array($array)
    {
        if (isset($array["id"])) {
            $this->id = $array["id"];
        }
        $this->capacite = $array["capacite"];
        $this->superficie = $array["superficie"];
        $this->disponible = $array["disponible"];
        $this->prix = $array["prix"];
        $this->v_admin = $array["valide_admin"];
        $this->v_proprio = $array["valide_proprio"];
        $this->id_proprio = $array["proprietaire"];
        $this->id_addresse = $array["addresse"];
    }

    public function get_as_array(): array
    {
        $array = [];
        if (isset($this->id)) {
            $array["id"] = $this->id;
        }
        $array["capacite"] = $this->capacite;
        $array["superficie"] = $this->superficie;
        $array["disponible"] = $this->disponible;
        $array["prix"] = $this->prix;
        $array["valide_admin"] = $this->v_admin;
        $array["valide_proprio"] = $this->v_proprio;
        $array["proprietaire"] = $this->id_proprio;
        $array["addresse"] = $this->id_addresse;
        return $array;
    }
}
