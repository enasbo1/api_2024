<?php
include_once("./shared/form.php");
function appartement_controler($uri)
{
    $model = new Service_appartement();

    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            $_POST = getallheaders();
            $id = header_verification("", [
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
    }
}
