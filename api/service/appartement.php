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

    public function create_appartement(array $data, int $propietaire, bool $from_admin=false)
    {
        $appartement = new Appartement();
        $data["disponible"] = false;
        $data["valide_admin"] = $from_admin;
        $data["valide_proprio"] = false;
        $data["proprietaire"] = $propietaire;
        $appartement->set_from_array($data);
        $this->repository->add_new($appartement);
        $service_utilisateur = new Service_utilisateur();

        $status = $service_utilisateur->get_status($propietaire);
        if ($status<2){
            $service_utilisateur->modifier_status($propietaire, 2);
        }
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
