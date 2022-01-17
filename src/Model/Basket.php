<?php

namespace BagsCalculator\Model;

use BagsCalculator\Support\DbUtils;
use BagsCalculator\Model\Product;

class Basket
{

    public static function addProductToBasket(Product $product, int $bagsCount): void
    {
        $sql = "INSERT INTO `basket_products`( `product_id`, `price`, `bags_quantity`, `total_cost`, `added_date`) VALUES (" . $product->getId() . "," . $product->getPrice() . "," . DbUtils::escape($bagsCount) . "," . DbUtils::escape($product->getPrice() * $bagsCount) . ",Now())";
        DbUtils::query($sql);
    }
}
