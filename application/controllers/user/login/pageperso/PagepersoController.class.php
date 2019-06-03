<?php

class PagePersoController
{
    public function httpGetMethod(Http $http, array $queryFields){

       
        //récupère toutes les infos concernant l'user
        $infoUser = new UserModel();
        $recupInfoUser = $infoUser->findId($queryFields['id']);
        //récupère toutes les commandes de l'user
        $commandesUser = new OrderModel();
        
        $commandes = $commandesUser->findOrderWithUser($queryFields['id']);

        //récupère les id des récettes en fonction de l'user
        $favorisUser = new FavorisModel();
        $favorisSearch = $favorisUser->search($queryFields['id']);
       
        //affiche les favoris        
        $favoris = $favorisUser->searchWithUserId($queryFields['id']);
        
        return
                    [
                        'flashBag' => new FlashBag(),
                        'infos'  => $recupInfoUser,
                        'commandes'  => $commandes,
                        'favoris' => $favoris,
                    ];

        
        

    }

    public function httpPostMethod(Http $http, array $formFields){
        $contactUser = new UserModel();
        $userSession = new UserSession();
        $userId= $userSession->getUserId();
        $User = $contactUser->changeContact(
            $formFields['LastName'],
            $formFields['FirstName'],
            $formFields['Address'],
            $formFields['ZipCode'],
            $formFields['City'],
            $formFields['Phone'],
            $userId
            );

     var_dump ($userId);
        exit();

        
    }
    
}