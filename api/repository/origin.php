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

    public function post(string $table, array $array)
    {
        try {
            $q = 'INSERT INTO ' . strtoupper($table) . '(';
            $i = 1;
            foreach ($array as $key => $value) {
                $q = $q . $key;
                if ($i < count($array)) {
                    $q = $q . ",";
                }
                $i += 1;
            }

            $q = $q . ') VALUE (';
            $i = 1;
            foreach ($array as $key => $value) {
                $q = $q . $value;
                if ($i < count($array)) {
                    $q = $q . ",";
                }
                $i += 1;
            }
            $q = $q . ')';
            pg_query($this->connection, $q);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function get(string $table, array $attributs, array $restric)
    {
        $r = '';
        $i = 1;
        foreach ($attributs as $att) {
            $r .= '"' . $att . '"';
            if ($i < count($attributs)) {
                $r = $r . ",";
            }
            $i += 1;
        }
        $q = "SELECT $r FROM $table ";

        $i = 0;
        foreach ($restric as $key => $val) {
            if ($i == 0) {
                $q .= " WHERE ";
                $i = 1;
            } else {
                $q .= " AND ";
            }
            $q .= $key . ' = \'' . $val ."'";
        }
        $elements = pg_query($this->connection, $q);
        return pg_fetch_assoc($elements);
    }
    
    public function delete(String $table, String $attribut, String $value)
    {
        $q = 'DELETE FROM ' . strtoupper($table) . ' WHERE ' . $attribut . ' = ' . $value;
        pg_query($this->connection, $q);
    }
}
