<?php


class OrderController
{
   public function httpGetMethod(Http $http)
   {
           $userSession = new UserSession();
           if($userSession->isAuthenticated() == false)
           {
               // On ne peut pas commander sans être connecté !
               $http->redirectTo('/user/login');

            }
            //Redirection vers la page commande
               
               
               $mealModel = new MealModel();
               $meals     = $mealModel->listAll();

               return
               [
                   'flashBag' => new FlashBag(),
                   'meals'    => $meals,
               ];
            




    }
    



}