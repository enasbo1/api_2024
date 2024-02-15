<?php
include_once("./repository/origin.php");
include_once("./shared/appartement.php");

class Repository_appartement extends Repository_origin
{
    private $connection;
    private string $table = "appartement";

    public function get_appartement($id) {
        if ($id != null) {
            $query = "SELECT * FROM {$this->table} WHERE id = $1";
            $result = pg_query_params($this->connection, $query, [$id]);
            return pg_fetch_assoc($result);
        } else {
            $query = "SELECT * FROM {$this->table}";
            $result = pg_query($this->connection, $query);
            return pg_fetch_all($result);
        }
    }

    public function add_new(Appartement $appartement) {
        $query = "INSERT INTO {$this->table} (capacite, superficie, disponible, prix, id_proprio, id_addresse) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
        $params = [
            $appartement->capacite, 
            $appartement->superficie, 
            $appartement->disponible, 
            $appartement->prix, 
            $appartement->id_proprio, 
            $appartement->id_addresse
        ];
        pg_query_params($this->connection, $query, $params);
    }
    

    public function update_appartement(Appartement $appartement) {
        $setParts = [];
        $params = [];
        $i = 1;

        $fieldsToUpdate = [
            'capacite' => $appartement->capacite,
            'superficie' => $appartement->superficie,
            'disponible' => $appartement->disponible,
            'prix' => $appartement->prix,
            'v_admin' => $appartement->v_admin,
            'v_proprio' => $appartement->v_proprio,
            'id_proprio' => $appartement->id_proprio,
            'id_addresse' => $appartement->id_addresse,
        ];
    
        foreach ($fieldsToUpdate as $field => $value) {
            if (isset($value)) {
                $setParts[] = "$field = \$$i";
                $params[] = $value;
                $i++;
            }
        }
    
        $params[] = $appartement->id;
        $setString = implode(', ', $setParts);
        $query = "UPDATE {$this->table} SET $setString WHERE id = \$$i";
    
        pg_query_params($this->connection, $query, $params);
    }    

    public function delete_appartement($id) {
        $query = "DELETE FROM {$this->table} WHERE id = $1";
        pg_query_params($this->connection, $query, [$id]);
    }
}
