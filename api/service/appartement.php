<?php
include_once("./repository/appartement.php");
include_once("./shared/appartement.php");

class Service_appartement
{
    private Repository_appartement $repository;

    public function __construct()
    {
        $this->repository = new Repository_appartement;
    }

    public function get_list()
    {
        return $this->repository->get_all();
    }

    public function get_appartement($id)
    {
        return $this->repository->get_by_id($id);
    }

    public function create_appartement($data)
    {
        $this->repository->add_new($data);
    }

    public function update_appartement($id, $data)
    {
        return $this->repository->update_one($id, $data);
    }

    public function delete_appartement($id)
    {
        return $this->repository->delete_one($id);
    }
}
