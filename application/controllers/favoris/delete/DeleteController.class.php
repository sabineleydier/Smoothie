<?php


class DeleteController
{
    public function httpGetMethod(Http $http)
    {
        $userSession = new UserSession();
        if($userSession->isAuthenticated() == false)
        {
           // On ne peut pas ajouter aux favoris sans être connecté !
            $http->redirectTo('/user/login');
        }
   }
   public function httpPostMethod(Http $http, array $formFields)
    {
       $userSession = new UserSession();
       if($userSession->isAuthenticated() == false)
       {
           // On ne peut pas ajouter aux favoris sans être connecté !
           $http->redirectTo('/user/login');
       }

        //Récupération du compte client de l'utilisateur connecté.
        $user_Id = $userSession->getUserId();

       $recette_Id = $formFields['recette_Id'];

        // Suppression du favoris.
        
       $deleteModel = new DeleteModel();
        $data = $deleteModel->delete
        (
            $user_Id,
            $recette_Id
        );

       // Redirection vers la page d'accueil.
         $http->sendJsonResponse($data);

    }
}