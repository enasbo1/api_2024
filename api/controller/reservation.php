<?php
include_once("./shared/form.php");
include_once("./service/reservation.php");
function reservation_controler($uri)
{
    $model = new Service_reservation();
    $user = new Service_utilisateur();

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            if($user->has_access(1)){
                $_POST = getallheaders();
                $err = header_verification([
                    "debut" => "r",
                    "fin" => "r",
                    "lieu" => "r"
                ]);
                $header = $_POST;
                if(is_null($err)){
                    $model->verif_date_start($header["debut"]);
                    $model->verif_date_debut_fin($header["debut"],$header["fin"]);
                    $model->create_reservation($header["lieu"],$header["debut"],$header["fin"], $_SESSION["utilisateur"]->id);
                    resolve_with_message(200, "votre réservation a bien été effectué");
                } else {
                    resolve_with_message(400, "Please provide the selected appartement and a duration (date of start and date of end)");
                }
            }else{
                resolve_with_message(403, "vous n'avez pas les droits pour accéder à cette procédure, connectez-vous");
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
            $err = header_verification([
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