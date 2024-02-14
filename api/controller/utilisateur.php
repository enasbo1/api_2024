<?php
include_once("./shared/form.php");
function utilisateur_controler($uri)
{
    $model = new Service_utilisateur();
    $_POST = getallheaders();

    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if ($model->has_access(3)) {
                $utilisateurs = $model->get_all();
                resolve_with_content(200, $utilisateurs);
            }else{
                resolve_with_message(403, "vous n'avez pas les droit necessaire pour optenir ces information");
            }
            break;
        case "UPDATE":
            if ($model->has_access(3)) {
                $error = header_verification([
                    "status" => "!int :<,4"
                ]);
                if (is_null($error)) {
                    $header = $_POST;
                    $model->modifier_status($uri[3], (int) $header['status']);
                    resolve_with_message(200, "le status de l'utilisateur a été modifié avec succès");
                } else {
                    resolve_with_message(400, "veillez specifier le status que vous voulez donner à l'utilisateur");
                }
            }else{
                resolve_with_message(403, "vous n'avez pas les droit necessaire pour optenir ces information");
            }
            break;
        case "PUT":
            $error = header_verification([
                "nom" => "r",
                "mdp" => "r"
            ]);
            if (is_null($error)) {
                $header = $_POST;
                $model->connect($header['nom'], $header['mdp']);
            } else {
                resolve_with_message(400, "Please Provide a name and a password");
            }
            break;
        case "POST":
            $error = header_verification([
                "nom" => "r",
                "mdp" => "r"
            ]);
            if (is_null($error)) {
                $header = $_POST;
                $model->inscription($header['nom'], $header['mdp']);
            }else{
                resolve_with_message(400, "Please Provide a name and a password");
            }
            break;
        case "REQUEST":
                $model->disconnect();
            break;
    }
}
