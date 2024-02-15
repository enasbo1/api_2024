<?php
include_once("./repository/origin.php");
include_once("./shared/appartement.php");


class Repository_appartement extends Repository_origin
{
    public function get_all()
    {
        $result = $this->get('appartement', [
            'id',
            'capacite',
            'superficie',
            'disponible',
            'prix',
            'valide_admin',
            'valide_proprio',
            'proprietaire',
            'addresse'
        ], []);
        return $result;
    }

    public function get_by_id($id)
    {
        $query = "SELECT * FROM appartement WHERE id = $1";
        $result = $this->query_params($query, array($id));
        return $result;
    }

    public function add_new(Appartement $appartement)
    {
        $this->post('appartement', $appartement->get_as_array());
    }

    public function update_one($id, $data)
    {
        $setPart = [];
        $values = [];
        foreach ($data as $key => $value) {
            $setPart[] = "$key = ?";
            $values[] = $value;
        }
        $setPartString = implode(', ', $setPart);
        $query = "UPDATE appartement SET $setPartString WHERE id = ?";
        $values[] = $id;

        $result = $this->query_params($query, $values);
        return $result;
    }

    public function delete_one($id)
    {
        $query = "DELETE FROM appartement WHERE id = $1";
        $result = $this->query_params($query, array($id));
        return $result;
    }
}
