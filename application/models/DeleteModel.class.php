<?php

class DeleteModel
{
    //fonction pour créer un favoris
    public function delete($user_Id, $recette_Id)
    {
        $sql = 'DELETE FROM `Recetteline` WHERE `User_Id` = ? AND Recette_Id = ?';
    
    // Insertion du favoris dans la base de données.
    $database = new Database();
    $database->executeSql($sql,
    [
        $user_Id,
        $recette_Id,
    ]);

    // Ajout d'un message de notification.
        $flashBag = new FlashBag();
        $flashBag->add('Votre favoris à bien été supprimé, nous vous en remercions.');
    }
}