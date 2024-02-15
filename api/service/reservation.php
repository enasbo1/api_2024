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

    public function is_available($lieu,$debut,$fin){
        $list = $this->repostitory->get_list_reservation_lieu($lieu);
        $debutdmY = DateTime::createFromFormat('d/m/Y', $debut);
        $Ddebut = $debutdmY->format('Y-m-d');
        $findmY = DateTime::createFromFormat('d/m/Y', $fin);
        $Dfin = $findmY->format('Y-m-d');
        //var_dump($Ddebut,$Dfin);
        
        foreach($list as $key => $value){
            //var_dump($Ddebut>$value["date_debut"] && $value["date_fin"]>$Ddebut);
            //var_dump($Dfin>$value["date_debut"] && $value["date_fin"]>$Dfin);
            //var_dump($Ddebut<$value["date_debut"] && $value["date_fin"]<$Dfin);
            if(($Ddebut>$value["date_debut"] && $value["date_fin"]>$Ddebut)||($Dfin>$value["date_debut"] && $value["date_fin"]>$Dfin)||($Ddebut<$value["date_debut"] && $value["date_fin"]<$Dfin)){
                resolve_with_message(400,"les dates séléctionné ne sont pas disponible");
            }
        }
    }

    public function create_reservation($appartement,$debut,$fin,$client){
        $this->repostitory->create_reservation($appartement,$debut,$fin,$client);
    }

    public function is_owner($appartement,$client){
        $ownerV = $this->repostitory->is_owner($appartement,$client);
        if(!$ownerV){
            resolve_with_message(400,"Vous n'êtes pas autorisé à annuler cette réservation");
        }
    }

    public function delete_reservation($appartement){
        $this->repostitory->delete_reservation($appartement);
    }

    public function get_list_reservation_client($client){
        $list = $this->repostitory->get_list_reservation_client($client);
    }
    public function verif_dispo(){

    }

    public function verif_reservation_user_verification(){

    }

    public function reservation_verification($debut,$fin,$appartement_id){

    }
}