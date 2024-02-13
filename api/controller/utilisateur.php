<?php
include_once("./shared/form.php");
function utilisateur_controler($uri)
{
    $model = new Service_utilisateur();
    $_POST = getallheaders();

    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if ($model->has_access(3)) {
                // get all user
            } elseif ($model->is_status(0)) {
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
