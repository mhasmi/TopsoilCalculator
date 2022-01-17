<?php

namespace BagsCalculator\Model;

use BagsCalculator\Support\DbUtils;

class Product
{

    private int $id;
    private string $name;
    private float $price;

    public function __construct(int $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public static function getProducts(string $category)
    {
        $sql = "select id,name,price from products where category = '" . DbUtils::escape($category) . "'";
        $results = DbUtils::query($sql);
        return $results->rows;
    }

    public static function getProduct(int $product_id): Product
    {
        $sql = "select id,name,price from products where id = '" . DbUtils::escape($product_id) . "'";
        $results = DbUtils::query($sql);
        if ($results->num_rows == 0) {
            throw new \Exception("Product Not Found!");
        }
        $product =  new Product($results->rows[0]['id'], $results->rows[0]['name'], $results->rows[0]['price']);
        return $product;
    }
}
