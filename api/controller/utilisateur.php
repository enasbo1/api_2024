<?php
include_once("./shared/form.php");
function utilisateur_controler($uri)
{
    $model = new Service_utilisateur();

    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            $_POST = getallheaders();
            $error = header_verification("", [
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
    }
}
