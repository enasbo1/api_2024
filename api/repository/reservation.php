<?php
include_once("./repository/origin.php");
include_once("./shared/reservation.php");



class Repository_reservation extends Repository_origin
{
    function convertDate($dateText) {
        $dateObj = DateTime::createFromFormat('d/m/Y', $dateText);
        return $dateObj->format('Y-m-d');
    }

    public function create_reservation($appartement_id,$debut,$fin, $client){
        $Ddebut=date('Y-m-d',strtotime($debut));
        $Dfin=date('Y-m-d',strtotime($fin));
        $this->post("reservation",
        array(
            "lieu"=> $appartement_id,
            "date_debut"=> $Ddebut,
            "date_fin"=> $Dfin,
            "client"=> $client
            )
        );
    }
    public function delete_reservation($id){
        $q="";
    }
}