<?php
include_once("./shared/form.php");
include_once("./service/reservation.php");
function reservation_controler($uri)
{
    $model = new Service_reservation();
    $user = new Service_utilisateur();

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            if ($user->has_access(1)) {
                $_POST = getallheaders();
                $err = header_verification([
                    "debut" => "r",
                    "fin" => "r",
                    "lieu" => "r !int"
                ]);
                $header = $_POST;
                if (is_null($err)) {
                    $model->verif_date_start($header["debut"]);
                    $model->verif_date_debut_fin($header["debut"],$header["fin"]);
                    $model->is_available($header["lieu"],$header["debut"],$header["fin"]);
                    $model->create_reservation($header["lieu"],$header["debut"],$header["fin"], $_SESSION["utilisateur"]->id);
                    resolve_with_message(200, "votre réservation a bien été effectué");
                } else {
                    resolve_with_message(400, "Please provide the selected appartement and a duration (date of start and date of end)");
                }
            } else {
                resolve_with_message(403, "vous n'avez pas les droits pour accéder à cette procédure, connectez-vous");
            }
            break;

        case 'DELETE':
            if (!$user->has_access(1)) {
                resolve_with_message(403, "Please login");
                break;
            } else {
                $_POST = getallheaders();
                $err = header_verification([
                    "reservation_ID" => "r !int"
                ]);
                $header = $_POST;
                if (is_null($err)) {
                    $model->is_owner($header["reservation_ID"], $_SESSION["utilisateur"]->id);
                    $model->delete_reservation($header["reservation_ID"]);
                    resolve_with_message(200, "reservation annulée avec succes");
                } else {
                    resolve_with_message(400, "Please provide the reservation code");
                    break;
                }
            }
        case "GET":
            if($user->has_access(1)){
                $reponse = $model->get_list_reservation_client($_SESSION["utilisateur"]->id);
                resolve_with_content(200, $reponse);
            }else{
                resolve_with_message(403, "vous n'avez pas les droits pour accéder à cette procédure, connectez-vous");
            }
            break;

    }
}
