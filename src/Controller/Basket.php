<?php

namespace BagsCalculator\Controller;

use BagsCalculator\Model\Product;
use BagsCalculator\Model\Basket as BasketModel;
use BagsCalculator\Support\LoadUtils;


class Basket
{
    public function addProductToBasket(int $productId, int $bagsCount)
    {
        $this->validate($bagsCount);
        $product = Product::getProduct($productId);
        BasketModel::addProductToBasket($product, $bagsCount);
    }

    private function validate(int $bagsCount): void
    {
        if ($bagsCount <= 0) {
            throw new \InvalidArgumentException("bags count must be more 0 ");
        }
    }

    public function removeFromBasket($bagsDetails)
    {
    }

    public  function viewAddCard(string $bagType): string
    {
        $data = array();
        $data['products'] = Product::getProducts($bagType);
        return LoadUtils::loadView(__DIR__ . "/../view/basketAdd.html", $data);
    }
}
