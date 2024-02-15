<?php
include_once("./repository/utilisateur.php");
include_once("./shared/utilisateur.php");
function prepare_connection()
{
    session_start();
}
class Service_utilisateur
{
    private Repository_utilisateur $repostitory;

    public function __construct()
    {
        $this->repostitory = new Repository_utilisateur;
    }


    public function has_access(int $privilege_level)
    {
        /*
        *   renvoie si l'utilisateur a au moins le status $privilege_level
        *   si le niveau de privilège exigé est de 0, il revoie true même 
        *   si il n'y a pas de compte connecté
        */
        if ($privilege_level == 0) {
            return true;
        }
        if (!isset($_SESSION["utilisateur"]->id)) {
            return false;
        }
        return $_SESSION["utilisateur"]->status >= $privilege_level;
    }
    public function is_status(int $privilege_level): bool
    {
        $status = 0;
        if (isset($_SESSION["utilisateur"]->status)) {
            $status = $_SESSION["utilisateur"]->status;
        }
        return $status == $privilege_level;
    }

    public function connect(String $nom, String $mdp)
    {
        $utilisateur = $this->repostitory->connect($nom, $mdp);
        if (is_null($utilisateur)) {
            resolve_with_message(403, "l'utilisateur ou le mot de passe est incorect");
        } else {
            $_SESSION["utilisateur"] = $utilisateur;
            resolve_with_message(200, "l'utilisateur a bien été connecté");
        }
    }


    public function inscription(String $nom, String $mdp)
    {
        if ($this->repostitory->is_inscrit($nom)) {
            resolve_with_message(400, "le nom d'utilisateur existe déjà");
        } else {
            $this->repostitory->inscription($nom, $mdp, 1);
            resolve_with_message(201, "l'utilisateur a bien été enregistré");
        }
    }

    public function disconnect()
    {
        session_destroy();
        resolve_with_message(200, "l'utilisateur a bien été déconnecté");
    }

    public function get_status(int $utilisateur){
        return $this->repostitory->get_status($utilisateur);
    }
    public function get_all()
    {
        $utilisateurs = $this->repostitory->get_all();
        return $utilisateurs;
    }

    public function modifier_status(int $utilisateur_id, int $status){
        $this->repostitory->modifier_status($utilisateur_id, $status);
    }
}
