<?php
class Repository_origin
{
    private $connection = null;

    public function __construct()
    {
        try {
            $this->connection = pg_connect("host=database port=5432 dbname=todo_db user=todo password=password");
            if ($this->connection == null) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception("Database connection failed :" . $e->getMessage());
        }
    }
}
?>