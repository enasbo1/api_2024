<?php
include_once("./repository/origin.php");
include_once("./shared/reservation.php");



class Repository_reservation extends Repository_origin
{
    public function get_list_reservation_lieu($lieu){
        $list = $this->get("reservation",["date_debut","date_fin"],["lieu"=> $lieu]);
        return $list;
    }

    public function create_reservation($appartement_id,$debut,$fin, $client){
        $debutdmY = DateTime::createFromFormat('d/m/Y', $debut);
        $Ddebut = $debutdmY->format('Y-m-d');
        $findmY = DateTime::createFromFormat('d/m/Y', $fin);
        $Dfin = $findmY->format('Y-m-d'); 
        //$Ddebut=date('Y-m-d',strtotime($debut));
        //$Dfin=date('Y-m-d',strtotime($fin));
        $this->post("reservation",
        array(
            "lieu"=> $appartement_id,
            "date_debut"=> $Ddebut,
            "date_fin"=> $Dfin,
            "client"=> $client
            )
        );
    }

    public function is_owner($appartement, $client){
        $ownerV =$this->get("reservation",["id"],["id"=> $appartement,"client"=> $client]);
        return $ownerV;
    }
    public function delete_reservation($id){
        $this->delete("reservation","id",$id);
    }

    public function get_list_reservation_client($id){
        $list = $this->get("reservation",["id","date_debut","date_fin"],["client"=> $id]);
        return $list;
    }
}