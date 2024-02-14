<?php
include_once("./shared/form.php");
include_once("./service/reservation.php");
function reservation_controler($uri)
{
    $model = new Service_reservation();
    $user = new Service_utilisateur();

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            if(0){ //temporary
            if(!$user->has_access(1)){
                resolve_with_message(403, "Please login");
                break;
            }
            }
            $_POST = getallheaders();
            $err = header_verification("", [
                "debut" => "r",
                "fin" => "r",
                "appartement" => "r"
            ]);
            $header = $_POST;
            if(is_null($err)){
                $model->verif_date_start($header["debut"]);
                $model->verif_date_debut_fin($header["debut"],$header["fin"]);
                $model->create_reservation(1,$header["debut"],$header["fin"]);
                resolve_with_message(400, "Code pour ajouter une reservation");
                break;
            } else {
                resolve_with_message(400, "Please provide the selected appartement and a duration (date of start and date of end)");
                break;
            }

            break;
        case 'DELETE':
            if(0){ //temporary
            if(!$user->has_access(1)){
                resolve_with_message(403, "Please login");
                break;
            }
            }
            $_POST = getallheaders();
            $err = header_verification("", [
                "reservation" => "r"
            ]);
            if(is_null($err)){
                $user=1;
                
            } else {
                resolve_with_message(400, "Please provide the reservation code");
                break;
            }
            

            break;
    }
}