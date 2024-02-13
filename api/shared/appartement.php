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
        $this->id = $array["id"];
        $this->capacite = $array["capacity"];
        $this->superficie = $array["space"];
        $this->disponible = $array["availaible"];
        $this->prix = $array["price"];
        $this->v_admin = $array["v_admin"];
        $this->v_proprio = $array["v_proprio"];
        $this->id_proprio = $array["id_proprio"];
        $this->id_addresse = $array["id_addresse"];
    }
}
?>