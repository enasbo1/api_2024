<?php
include_once("./repository/appartement.php");
include_once("./shared/appartement.php");

class Service_appartement
{
    private Repository_appartement $repostitory;

    public function __construct()
    {
        $this->repostitory = new Repository_appartement;
    }

    public function get_list(){

    }

    public function delete($id){
    
    }

    public function create($id){

    }
}