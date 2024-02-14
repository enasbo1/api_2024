<?php
include_once("./repository/origin.php");
include_once("./shared/appartement.php");


class Repository_appartement extends Repository_origin
{
	private $connection;

    public function __construct() {
        try {
            $this->connection = pg_connect("host=database port=5432 dbname=todo_db user=todo password=password");
            if ($this->connection == null) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception("Database connection failed :" . $e->getMessage());
        }
    }

    public function get_all() {
        $query = "SELECT * FROM appartements";
        $result = pg_query($this->connection, $query);
        return pg_fetch_all($result);
    }

    public function get_by_id($id) {
        $query = "SELECT * FROM appartements WHERE id = $1";
        $result = pg_query_params($this->connection, $query, array($id));
        return pg_fetch_assoc($result);
    }

    public function add_new($data) {
        $query = "INSERT INTO appartements (id, addresse, capacite, superficie, disponible, prix, propriétaire) VALUES ($id, $data["addresse"], $data["capacite"], $data["superficie"], $data["disponible"], $data["prix"], $user_id)";
        $result = pg_query_params($this->connection, $query, array_values($data));
        return $result;
    }

    public function update($id, $data) {
        $setPart = [];
        $values = [];
        foreach ($data as $key => $value) {
            $setPart[] = "$key = ?";
            $values[] = $value;
        }
        $setPartString = implode(', ', $setPart);
        $query = "UPDATE appartements SET $setPartString WHERE id = ?";
        $values[] = $id;

        $result = pg_query_params($this->connection, $query, $values);
        return $result;
    }

    public function delete($id) {
        $query = "DELETE FROM appartements WHERE id = $1";
        $result = pg_query_params($this->connection, $query, array($id));
        return $result;
    }
}