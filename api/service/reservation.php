<?php
include_once("./repository/reservation.php");
include_once("./shared/reservation.php");

class Service_reservation
{
    private Repository_reservation $repostitory;

    public function __construct()
    {
        $this->repostitory = new Repository_reservation;
    }

    public function dispo($appartement,$start,$end){
        //insert into reservation (lieu,date_debut,date_fin,proprietaire) VALUES ()
    }

    public function verif_date_start($debut){
        $today = new DateTime();
        $debut = date('Y-m-d', strtotime(str_replace('/', '-', $debut)));
        $today = date('Y-m-d');
        if($debut<$today){
            resolve_with_message(400,"Start date is already passed");
        }
    }

    public function verif_date_debut_fin($debut,$fin){
        
        $debut = date('Y-m-d', strtotime(str_replace('/', '-', $debut)));
        $fin = date('Y-m-d', strtotime(str_replace('/', '-', $fin)));
        if($debut>$fin){
            resolve_with_message(400,"Start date is after start end");
        }
        return;
    }

    public function create_reservation($appartement,$debut,$fin){
        $this->repostitory->create_reservation($appartement,$debut,$fin);
    }
    public function verif_dispo(){

    }

    public function verif_reservation_user_verification(){

    }

    public function reservation_verification($debut,$fin,$appartement_id){

    }
}