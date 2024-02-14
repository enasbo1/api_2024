<?php
class Addresse
{
    public int $id;
    public string $lieu;

    public function set_from_array($array)
    {
        $this->id = $array["id"];
        $this->lieu = $array["lieu"];
    }
}
