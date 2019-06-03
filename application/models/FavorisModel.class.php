<?php

class FavorisModel
{
    //fonction pour créer un favoris
    public function create($user_Id, $recette_Id)
    {
        $sql = 'INSERT INTO Recetteline
        (
            User_Id,
            Recette_Id
        ) VALUES (?, ?)';
    
    // Insertion du favoris dans la base de données.
    $database = new Database();
    $database->executeSql($sql,
    [
        $user_Id,
        $recette_Id,
    ]);

    // Ajout d'un message de notification.
        $flashBag = new FlashBag();
        $flashBag->add('Votre favoris est bien enregistré, nous vous en remercions.');
    }

    public function search($user_Id)//récupère User_Id et la recette_Id
    {
        $sql = 'SELECT * FROM `Recetteline` WHERE User_Id = ?';

        $database = new Database();
        $search = $database->queryOne($sql, [$user_Id]);

        if(empty($search) == true ){
            return true;
        }else{
            return false;
        }

    }

    public function searchWithUserId($userId)
    {
        $sql = 'SELECT Name, Photo, Recette.Id FROM Recette INNER JOIN Recetteline ON Recetteline.Recette_Id = Recette.Id WHERE User_Id = ?';

        $database = new Database();
        return $database->query($sql, [$userId]);

       
    }

    public function searchFavoris($user_Id, $recette_Id)
    {
        $sql = 'SELECT * FROM Recetteline WHERE User_Id = ? AND Recette_Id = ?';

        $database = new Database();
        $searchFavoris = $database->query($sql, [$user_Id, $recette_Id]);

        if(empty($searchFavoris) == true ){
            return true;
        }else{
            return false;
        }
    }
}