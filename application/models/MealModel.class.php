<?php

class MealModel
{
    //fonction pour créer un produit
    public function create($name, $description, $photo, $salePrice)
    {
        $sql = 'INSERT INTO Meal
        (
            Name,
            Description,
            Photo,
            SalePrice
        ) VALUES (?, ?, ?, ?)';

        // Insertion du produit dans la base de données.
        $database = new Database();
        $database->executeSql($sql,
        [
            $name,
            $description,
            $photo,
            $salePrice,
        ]);
    }
    //fonction pour trouver l'id du produit
    public function find($mealId)
    {
        $database = new Database();

        $sql = 'SELECT
                    Name,
                    Description,
                    Photo,
                    SalePrice
                FROM Meal
                WHERE Id = ?';

        // Récupération du produit alimentaire spécifié.
        return $database->queryOne($sql, [ $mealId ]);
    }

    //fonction pour lister l'ensemble des produits
    public function listAll()
    {
        $database = new Database();

        $sql = 'SELECT * FROM Meal';

        // Récupération de tous les produits alimentaires.
        return $database->query($sql);
    }

    //fonction pour supprimer un produit de la base
    public function deleteMeals(array $meals) 
    {
        $database = new Database();

        foreach($meals as $meal) {
            $sql = 'DELETE FROM Meal WHERE Id = ?';

            $database->executeSql($sql,[$meal['Id']]);
        }
    }

    public function deleteProduct(array $meals) 
    {
        $database = new Database();

        foreach($meals as $meal) {
            $sql = 'DELETE FROM Meal WHERE Id = ?';

            $database->executeSql($sql, [$meal]);
        }
    }

    public function loveProducts()
    {
        $database = new Database();

        $sql = 'SELECT * FROM Meal LIMIT 0, 4';

        // Récupération des 3 premiers produits.
        return $database->query($sql);
    }
}