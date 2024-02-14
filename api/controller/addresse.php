<?php
include_once("./shared/form.php");
include_once("./service/addresse.php");

function addresse_controler($uri)
{
    $model = new Service_addresse();
    $utilisateur = new Service_utilisateur();
    $_POST = getallheaders();

    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if (count($uri) < 4) {
                if ($utilisateur->has_access(1)) {
                    $addresses = $model->get_all();
                    resolve_with_content(200, $addresses);
                }else{
                    resolve_with_message(403, "vous n'avez pas accès à ces donnés, veillez vous connecter");
                }
            }
            break;
        case "POST":
            if ($utilisateur->has_access(1)) {
                $error = header_verification([
                    "lieu"=>"r"
                ]);
                if (is_null($error)){
                    $id = $model->add_one($_POST["lieu"]);
                    resolve_with_content(201, $id);
                }else{
                    resolve_with_message(400, $error);
                }
            }else{
                resolve_with_message(403, "vous n'avez pas accès à ces donnés, veillez vous connecter");
            }
            break;
    }
}
