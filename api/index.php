<?php

include_once "./todo.php";

header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Origin: *");

function resolve_with_message($status, $message) {
    http_response_code($status);
    echo '{"message": "'.$message.'"}';
    exit();
}

function resolve_with_content($status, $payload) {
    http_response_code($status);
    echo json_encode($payload);
    exit();
}

function todo_controller($uri) {
    $model = new TodoModel();

    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            $todos = $model->getTodos();
            resolve_with_content(200, $todos);
        break;

        case "PATCH":
            $body = file_get_contents("php://input");
            $json = json_decode($body);

            try {
                $model->updateTodos($uri[3],$json);
                
                resolve_with_message(204, "Todo was modified successfully!");
            } catch (Exception $e) {
                resolve_with_message(500, $e->getMessage());
            }
        break;
        
        case "DELETE":
            resolve_with_message(501, "Not implemented");
        break;

        case "POST":
            $body = file_get_contents("php://input");
            $json = json_decode($body);
            $description = $json->description;

            if (!isset($json->description)) {
                resolve_with_message(400, "Please provide a description.");
            }

           try {
                $model->addTodo($description);
            } catch (Exception $e) {
                resolve_with_message(500, "An error occured.");
            } 
            resolve_with_message(201, "Created");
        break;
    }
}

function router() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );


    if (!isset($uri[2])) { 
        resolve_with_message(200, "Welcome to To-Do Api");
    }

    switch ($uri[2]) {
        case "to-do":
            todo_controller($uri); 
            break;

        default:
            resolve_with_message(404, "Endpoint does not exist");
            exit();
    }
}

router();
?>