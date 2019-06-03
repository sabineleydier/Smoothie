<?php


class UserSession
{
	public function __construct()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
            // Démarrage du module PHP de gestion des sessions.
			session_start();
		}
	}

    //function pour créer une nouvelle seession
    public function create($userId, $firstName, $lastName, $email, $admin)
    {
        // Construction de la session utilisateur.
        $_SESSION['user'] =
        [
            'UserId'    => $userId,
            'FirstName' => $firstName,
            'LastName'  => $lastName,
            'Email'     => $email,
            'Admin'     => $admin
        ];
    }

    //fonction pour détruire une session
    public function destroy()
    {
        // Destruction de l'ensemble de la session.
        $_SESSION = array();
        session_destroy();
    }

    //fonction pour récupérer l'email de l'utilisateur connecté.
    public function getEmail()
    {
        if($this->isAuthenticated() == false) {
            return null;
        }
        return $_SESSION['user']['Email'];
    }
    
    //fonction pour vérifier si l'utilisateur est un administrateur
    public function getAdmin()
    {
        if($this->isAuthenticated() == false ) {
            return null;
        }
        return $_SESSION['user']['Admin'];
    }

    //fonction pour récupérer le prénom de l'utilisateur
    public function getFirstName() {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['FirstName'];
    }

    // fonction pour récupérer le prénom et le nom de l'utilisateur
    public function getFullName() {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['FirstName'].' '.$_SESSION['user']['LastName'];
    }

    //fonction pour récupérer le nom de l'utilisateur
    public function getLastName() {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['LastName'];
    }

    //fonction pour récupérer l'Id de l'utilisateur
    public function getUserId() {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['UserId'];
    }

    //fonction pour vérifier si l'utilisateur est connecté.
	public function isAuthenticated()
	{
		if(array_key_exists('user', $_SESSION) == true)
		{
			if($_SESSION['user'] == 33)
			{
                return 33;
            }
            elseif (empty($_SESSION['user']) == false) {
				return true;
            }
        }
		return false;
	}
}