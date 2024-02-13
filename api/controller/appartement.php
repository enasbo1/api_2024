<?php
include_once("./shared/form.php");
function appartement_controler($uri)
{
    // $model = new Service_appartement();

    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            $_POST = getallheaders();
            $id = header_verification([
                "id" => "r"
            ]);
            if (is_null($id)) {
                //$model->get_list();
                resolve_with_message(200,$model->get_list());
                //
            } else {
                resolve_with_message(400, "...");
            }
            break;
        case "POST":
            if(is_null($_SESSION["utilisateur"])){
                resolve_with_message(200,"please log in");
                break;
            }
            $_POST = getallheaders();
            $appartement = header_verification([
                "capacite"=>"r",
                "superficie" => "r",
                // "disponible" => "availaible",
                "prix" => "r",
                "v_admin" => "r",
                "v_proprio" => "r",
                // "id_proprio" => "id_proprio",
                "id_addresse" => "r"
            ]);
            if (is_null($appartement)) {
            } else {
                resolve_with_message(200, "Please provide a capacity, a space, a price, a street");
                break;
            }
            resolve_with_message(200,"code pour creer un appartement");
            break;
        case "DELETE":
            if(is_null($_SESSION["utilisateur"])){
                resolve_with_message(200,"please log in");
                break;
            }
            $_POST = getallheaders();
            $id = header_verification([
                "id" => "r"
            ]);
            resolve_with_message(200,"code pour supprimer un appartement");
            break;
        case "PATCH":
            if(is_null($_SESSION["utilisateur"])){
                resolve_with_message(200,"please log in");
                break;
            }
            resolve_with_message(200,"code pour modifier appartement");
            break;
    }
}
