<?php

namespace App\Repository;

use App\Model\Product;
use PDO;

class ProductRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        //$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $products = [];
        $result = $this->pdo->query('SELECT * FROM product')->fetchAll();
        foreach ($result as $row) {
            $product = new Product();
            $product->setId($row['id']);
            $product->setName($row['name']);
            $product->setPrice($row['price']);
            $product->setDescription($row['description']);

            $products[] = $product;
        }

        return $products;
    }
}
