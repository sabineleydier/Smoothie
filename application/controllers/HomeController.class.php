<?php

class HomeController
{
    public function httpGetMethod()
    {
        // Récupération de tous les smoothies.
        /*$mealModel = new MealModel();
        $meals     = $mealModel->listAll();

        return
        [
            'flashBag' => new FlashBag(),
            'meals'    => $meals,
        ];*/
        $loveProductModel = new MealModel();
        $loveProducts = $loveProductModel->loveProducts();

        return
        [
            'flashBag' => new FlashBag(),
            'loveProducts'    => $loveProducts,
        ];
    }
}
