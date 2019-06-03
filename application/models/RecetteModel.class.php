<?php

class RecetteModel
{
    //fonction pour créer une recette
    public function create($name, $ingredients, $photo, $description, $salePrice)
    {
        $sql = 'INSERT INTO Recette
        (
            Name,
            Ingredients,
            Photo,
            Description,
            
        ) VALUES (?, ?, ?, ?, ?)';

        // Insertion de la recette dans la base de données.
        $database = new Database();
        $database->executeSql($sql,
        [
            $name,
            $ingredients,
            $photo,
            $description,
    
        ]);
    }
    //fonction pour trouver l'id de la recette
    public function find($recetteId)
    {
        $database = new Database();

        $sql = 'SELECT
                    Name,
                    Ingredients,
                    Photo,
                    Description
                FROM Recette
                WHERE Id = ?';

        // Récupération de la recette spécifiée
        return $database->queryOne($sql, [ $recetteId ]);
    }

    public function findId($name){
         $database = new Database();

        $sql = 'SELECT
                    Id
                FROM Recette
                WHERE Name = ?';

                // Récupération de la recette spécifiée
        return $database->queryOne($sql, [ $name ]);
    }

    //fonction pour lister l'ensemble des recette
    public function listAll()
    {
        $database = new Database();

        $sql = 'SELECT * FROM Recette';

        // Récupération de toutes les recettes.
        return $database->query($sql);
    }

    //fonction pour supprimer une recette
    public function deleteRecette(array $recettes) 
    {
        $database = new Database();

        foreach($recettes as $recette) {
            $sql = 'DELETE FROM Recette WHERE Id = ?';

            $database->executeSql($sql,[$recettes['Id']]);
        }
    }

     public function favoris(
        $user_Id
        )
    {
        
        $sql = "SELECT User_Id, Recette_Id FROM Recette INNER JOIN Recetteline ON Recette.Id = Recetteline.Recette_Id WHERE User_Id = ?";

       // Insertion du favoris dans la base de données.
       $database = new Database();
        return $database->query($sql,
        [
           $user_Id
        ]);

    }


}

/*
SELECT
  *,
  IF(
    (
      Id IN(
      SELECT
        Recette_Id
      FROM
        Recetteline
      WHERE
        User_Id = 9
    )
    ),
    'true',
    'false'
  ) AS inFavoris
FROM
  Recette
*/