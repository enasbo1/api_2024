<?php
include_once("./repository/origin.php");
include_once("./shared/appartement.php");


class Repository_appartement extends Repository_origin
{
    function exist(){
        $appartement = new Appartement();
    }
    function get_appartement_detail($id){
    
    }

    function creat_appartement($appartement){
    
    }
}