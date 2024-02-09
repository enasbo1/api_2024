<?php

class TodoModel {

    private $connection = null;

    public function __construct() {
        try {
            $this->connection = pg_connect("host=database port=5432 dbname=todo_db user=todo password=password");
            if (  $this->connection == null ) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception("Database connection failed :".$e->getMessage());
        }
    }

    public function getTodos(): array {
            $result = pg_query($this->connection, "SELECT * FROM todos");
            $todos = [];

            if (!$result) {
                throw new Exception(pg_last_error());
            }

            while ($row = pg_fetch_assoc($result)) {
                $todos[] = $row;
            }

            return $todos;
    }

    public function getTodo($id): mixed {
        // ImplÃ©mentation
    }

    public function deleteTodos($id): void {
       // Implementation
    }

    public function addTodo($description): void {
        $date = date('Y-m-d H:i:s');
        $result = pg_query($this->connection, "INSERT INTO todos (done, description, date_time) VALUES (FALSE, '$description', '$date')");

        if (!$result) {
            throw new Exception(pg_last_error());
        }

        return;
    }

    public function updateTodos($id, $todo_object): void {
        $query = "UPDATE todos set ";

        if (isset($todo_object->done)) {
            if ($todo_object->done == "true") {
                $query .= " done = TRUE ";
            } else if ($todo_object->done == "false") {
                $query = " done = FALSE ";
            }
        }

        if (isset($todo_object->done) && isset($todo_object->description)) {
            $query .= " , ";
        }

        if (isset($todo_object->description)) {
            $query .= " description = '".$todo_object->description."' ";
        }

        $query .= " where id = $id; ";
        $result = pg_query($this->connection,$query); 

        if (!$result) {
           throw new Exception(pg_last_error());
        }
    }
}