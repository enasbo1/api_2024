<?php
include_once("./shared/form.php");
include_once("./service/appartement.php");
function appartement_controler($uri)
{
    $model = new Service_appartement();
    $user = new Service_utilisateur();
    $_POST = getallheaders();

    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if (count($uri)<4) {
                resolve_with_content(200,$model->get_list());
                //
            } elseif(filter_var($uri[3],FILTER_VALIDATE_INT)){
                $resultat = $model->get_appartement($uri[3]);
                resolve_with_content(200, $resultat);
            }else{
                resolve_with_message(400, "mauvaise requete");
            }
            break;
        case "POST":
            if(!$user->has_access(1)){
                resolve_with_message(403, "Please login");
                break;
            }
            if ($user->has_access(3) && (!isset($_POST["status"]) || ($_POST["status"]==3))){
                $error = header_verification([
                    "capacite"=>"r !int",
                    "superficie" => "r !int",
                    "prix" => "r !float",
                    "proprietaire" => "r !int",
                    "addresse" => "r !int"
                ]);
                if (is_null($error)){
                    $model->create_appartement($_POST, $_POST["proprietaire"], true);
                    resolve_with_message(200,"l'appartement a bien été créé");
                }
                else{
                    resolve_with_message(400,$error);
                }
            }else{
                $error = header_verification([
                    "capacite"=>"r !int",
                    "superficie" => "r !int",
                    "prix" => "r !float",
                    "addresse" => "r !int"
                ]);
                if (is_null($error)) {
                    $model->create_appartement($_POST, $_SESSION['utilisateur']->id);
                    resolve_with_message(200,"l'appartement a bien été créé");
                } else {
                    resolve_with_message(400, "Please provide a capacity, a space, a price, a street");
                    break;
                }
                break;
            }
        case "DELETE":
            if(!$user->has_access(3)){
                resolve_with_message(403, "Please login");
                break;
            }
            $id = header_verification([
                "id" => "r"
            ]);
            resolve_with_message(503,"la suppression des appartement n'est pas encore implementé");
            break;
        case "PATCH":
            if(!$user->has_access(1)){
                resolve_with_message(403, "Please login");
                break;
            }
            resolve_with_message(503,"la modification des appartement n'est pas encore implementé");
            break;
    }
}
