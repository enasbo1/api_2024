<?php
include_once("./repository/origin.php");
include_once("./shared/reservation.php");



class Repository_reservation extends Repository_origin
{

    public function create_reservation($appartement_id,$debut,$fin,$client){
        $this->post("reservation",[
            "lieu"=> $appartement_id,
            "date_debut"=> $debut,
            "date_fin"=> $fin,
            "client"=> $client
        ]
        );
    }
    public function delete_reservation($id){
        $q="";
    }
}