<?php
 // Récupération du détail de la recette en fonction de son id
class RecettedetailsController
{
	public function httpGetMethod(Http $http, array $queryFields)
	{
       //vérifie si la clé id se trouve bien dans $queryFields($_GET)
        if(array_key_exists('id', $queryFields) == true)
        {

            //verifie que l'id est bien un integer avec ctype _digit
            if(ctype_digit($queryFields['id']) == true)
            {
				// Récupération des informations concernant le recette en fonction de son id
                $recetteDetailModel = new RecetteModel();
				$recetteDetail      = $recetteDetailModel->find($queryFields['id']);

				/*
				 * Sérialisation de l'aliment (qui est un tableau PHP) en une
				 * chaîne de caractères JSON puis envoi de la réponse HTTP.
				 */
                 return
                    [
                        'flashBag' => new FlashBag(),
                        'recette'  => $recetteDetail,
                    ];
                 
                 
            
            }

        }
        

        // En cas d'erreur, redirection vers la page d'accueil.
        $http->redirectTo('/');
	}

    public function httpPostMethod(Http $http, array $formFields)
    {
       $userSession = new UserSession();
       if($userSession->isAuthenticated() == false)
       {
           // On ne peut pas ajouter aux favoris sans être connecté !
           $http->redirectTo('/user/login');
       }

       // Récupération du compte client de l'utilisateur connecté.
       $userId = $userSession->getUserId();

       $variable = $_SERVEUR['REQUEST_URI'];
       $tab = explode("=", $variable);
       $recette_Id = $tab[1];

        // Création du favoris.
        
       /*$favorisModel = new FavorisSession();
        $favorisModel->save();
        $favorisModel->load();*/

       // Redirection vers la page d'accueil.
        //$http->redirectTo('/');
    }
}