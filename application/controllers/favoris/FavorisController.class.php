<?php


class FavorisController
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

       // Récupération du compte client de l'utilisateur connecté.
       $user_Id = $userSession->getUserId();

       $recette_Id = $formFields['recette_Id'];

        // Création du favoris.
        
       $favorisModel = new FavorisModel();
      $search = $favorisModel->searchFavoris($user_Id, $recette_Id);

      if($search == true){
          $data = $favorisModel->create
          (
              $user_Id,
              $recette_Id
          );

          $http->sendJsonResponse($data);
      }else{

          exit();
        }

    }
}