<?php


class MealController
{
    
    public function httpGetMethod(Http $http)
    {
        $userSession = new UserSession();
        if($userSession->getAdmin() != 1)
        {
           $http->redirectTo('/user/login');
        }
        $mealModel = new MealModel();
        $meals     = $mealModel->listAll();

        return
        [
            'flashBag' => new FlashBag(),
            'meals'    => $meals,
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $userSession = new UserSession();
        if($userSession->getAdmin() != 1)
        {
           $http->redirectTo('/user/login');
        }

        if($http->hasUploadedFile('photo') == true)
        {
            $photo = $http->moveUploadedFile('photo', '/images');
        }
        else
        {
            $photo = 'no-photo.png';
        }

        if(empty($formFields['name']) == false) {
            $mealModel = new MealModel();
            $mealModel->create
            (
                $formFields['name'],
                $formFields['description'],
                $photo,
                $formFields['salePrice']
            );

            $http->redirectTo('/admin/meal');
        } 

        // récup le name de chaque meal checked et push in $meals 
        


        $mealId = $formFields['tab'];

        // var_dump($mealId);
       
         $mealModel = new MealModel();
         foreach($mealId as $Id){
         $meals = $mealModel->find($Id);
         }
        $newMeal = $mealModel->deleteProduct($mealId);

        
       
    }
}