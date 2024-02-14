<?php
include_once("./repository/addresse.php");
include_once("./shared/addresse.php");
class Service_addresse
{
    private Repository_addresse $repostitory;

    public function __construct()
    {
        $this->repostitory = new Repository_addresse;
    }

    public function get_all()
    {
        $adresses = $this->repostitory->get_all();
        return $adresses;
    }

    public function add_one(String $lieu)
    {
        $adresses = $this->repostitory->get_all();
        $not_in = true;
        foreach($adresses as $value){
            if ($value["lieu"]===$lieu){
                $not_in = false;
            }
        }
        if ($not_in){
            $this->repostitory->add_one($lieu);
        }else{
            resolve_with_message(400, "l'addresse existe déjà");
        }
    }
}
