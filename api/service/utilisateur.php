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
    public function has_acces(int $privilege_level)
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
        return $_SESSION["status"] >= $privilege_level;
    }

    public function connect(String $nom, String $mdp)
    {
        $utilisateur = $this->repostitory->connect($nom, $mdp);
        if (is_null($utilisateur)) {
            resolve_with_message(403, "l'utilisateur ou le mot de passe est incorect");
        } else {
            $_SESSION["utilisateur"] = $utilisateur;
        }
    }

    public function disconnect()
    {
        session_abort();
    }
}
