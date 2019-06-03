<?php


class RecetteController
{
	public function httpGetMethod()
	{
            // Récupération de tous les recettes de smoothie
            $userSession = new UserSession();
            $user_Id = $userSession->getUserId();
            $recetteModel = new RecetteModel();
            $recettes    = $recetteModel->listAll();
            $favoris = $recetteModel->favoris($user_Id);
    
            return
            [
                'flashBag' => new FlashBag(),
                'recettes'    => $recettes,
                'favoris' => $favoris
            ];
        }
}