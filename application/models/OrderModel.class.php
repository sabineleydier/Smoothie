<?php


class OrderModel
{
    //fonction pour lister l'ensemble des commandes
    public function listAll() 
    {
        //connection à la bdd
        $database = new Database();
                //requete sql
                $sql = 'SELECT
                    Id,
                    User_Id,
                    CreationTimestamp,
                    TotalAmount,
                    TaxRate,
                    TaxAmount
                FROM `Order`
                ORDER BY CreationTimestamp';
                
        return $database->query($sql);

    }

    //fonction pour retrouver une commande en particulier
	public function find($orderId)
	{
        $database = new Database();

        $sql = 'SELECT
                    User_Id,
                    CreationTimestamp,
                    TotalAmount,
                    TaxRate,
                    TaxAmount
                FROM `Order`
                WHERE Id = ?';

		// Récupération de la commande spécifiée.
		return $database->queryOne($sql, [ $orderId ]);
    }
    
    //Fonction pour retrouver les détails d'une commande
	public function findOrderLines($orderId)
	{
		$database = new Database();

        $sql = 'SELECT
                    QuantityOrdered,
                    PriceEach,
                    Name,
                    Photo
                FROM OrderLine
                INNER JOIN Meal ON Meal.Id = OrderLine.Meal_Id
                WHERE Order_Id = ?';

		// Récupération des lignes de la commande spécifiée.
		return $database->query($sql, [ $orderId ]);
	}

    //fonction pour valider une commande
    public function validate($userId, array $basketItems)
    {
        $database = new Database();
      $totalAmount = 0 ;

        // Insertion des lignes de la commande.

        foreach($basketItems as $basketItem)
        {
           // Ajout du montant HT de la ligne du panier au montant total HT.
           $totalAmount += $basketItem['quantity'] * $basketItem['salePrice'];
     }

        // Insertion de la commande dans la base de donées.
        $orderId = $database->executeSql
        (
            'INSERT INTO `Order`
			(
				User_Id,
				CreationTimestamp,
				TaxRate,
                TotalAmount
			) VALUES (?, NOW(), 20, ?)',
            [ $userId, $totalAmount ]
        );


        $sql = 'INSERT INTO OrderLine 
        (
            Order_Id,
            Meal_Id,
            QuantityOrdered,
            PriceEach
        ) VALUES (?, ?, ?, ?)';

        // Initialisation du montant total HT.
         $totalAmount = 0;

        // Insertion des lignes de la commande.
        foreach($basketItems as $basketItem)
        {
            // Ajout du montant HT de la ligne du panier au montant total HT.
            $totalAmount += $basketItem['quantity'] * $basketItem['salePrice'];

            // Insertion d'une ligne de commande dans la base de données.
            $database->executeSql
            (
                $sql,
                [
                    $orderId,
                    $basketItem['mealId'],
                    $basketItem['quantity'],
                    $basketItem['salePrice']
                ]
            );
        }

        // Mise à jour de la commande dans la base de données, avec les montants.
        $sql = 'UPDATE `Order`
				SET TotalAmount       = ?,
					TaxAmount         = ? * TaxRate / 100
				WHERE Id = ?';

        $database->executeSql
        (
            $sql,
            [
                $totalAmount,
                $totalAmount,
                $orderId
            ]
        );


        return $orderId;
    }

    public function findOrderWithUser($userId)
    {
        $database = new Database();

        $sql = 'SELECT Id, TaxRate, TotalAmount, TaxAmount, CreationTimestamp FROM `Order` WHERE User_Id = ?';

		// Récupération des  commandes spécifiées
		return $database->query($sql, [$userId]);
    }
} 