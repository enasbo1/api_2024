<?php
include_once("./repository/appartement.php");

class Service_appartement
{
    private Repository_appartement $repository;

    public function __construct()
    {
        $this->repository = new Repository_appartement();
    }

    public function get_appartement($id) {
        try {
            $result = $this->repository->get_appartement($id);
            if ($result) {
                resolve_with_content(200, $result);
            } else {
                resolve_with_message(404, "Appartement not found");
            }
        } catch (Exception $e) {
            resolve_with_message(500, "An error occurred: " . $e->getMessage());
        }
    }

    public function add_new(Appartement $appartement) {
        try {
            $this->repository->add_new($appartement);
            resolve_with_message(201, "Appartement added successfully");
        } catch (Exception $e) {
            resolve_with_message(500, "An error occurred: " . $e->getMessage());
        }
    }

    public function update_appartement(Appartement $appartement) {
        try {
            $this->repository->update_appartement($appartement);
            resolve_with_message(204, "Appartement updated successfully");
        } catch (Exception $e) {
            resolve_with_message(500, "An error occurred: " . $e->getMessage());
        }
    }

    public function delete_appartement($id) {
        try {
            $this->repository->delete_appartement($id);
            resolve_with_message(200, "Appartement deleted successfully");
        } catch (Exception $e) {
            resolve_with_message(500, "An error occurred: " . $e->getMessage());
        }
    }
}
