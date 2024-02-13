<?php

class Appartement
{
    public int $id;


    public function set_from_array($array)
    {
        $this->id = $array["id"];
    }
}
?>