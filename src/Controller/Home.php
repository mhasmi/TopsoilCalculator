<?php

namespace BagsCalculator\Controller;

use BagsCalculator\Controller\TopsoilBagsCalculator;
use BagsCalculator\Controller\Basket;
use BagsCalculator\Config;

class Home
{

    public static function index()
    {

        if (!isset($_GET['action'])) {
            self::view();
        } else {
            switch ($_GET['action']) {
                case "calculate": {
                        self::calculateBags();
                        break;
                    }
                case "addToBasket": {
                        self::addProductToBasket();
                        break;
                    }
            }
        }
    }

    private static function view()
    {
        $topsoilBagsCalculator = new TopsoilBagsCalculator(Config::$defaultWidth, Config::$defaultLength, Config::$defaultDepth, Config::$defaultMeasurementUnit, Config::$defaultDepthUnit);
        $data["calculatorView"] = $topsoilBagsCalculator->viewCalculatorCard();
        $basket = new Basket();
        $data["addBasketView"] = $basket->viewAddCard($topsoilBagsCalculator->getCalculateRequest()->getBagType());

        include_once(__DIR__ . "/../view/home.html");
    }
    private static function calculateBags()
    {
        try {
            $topsoilBagsCalculator = new TopsoilBagsCalculator($_POST['width'], $_POST['length'], $_POST['depth'], $_POST['measurementUnit'], $_POST['depthUnit']);
            $data['totalBags'] = $topsoilBagsCalculator->calculateBagsCount();
            $topsoilBagsCalculator->saveCalculateRequest($data['totalBags'] );

            $result = array(
                "succ" => true,
                "data" => $data,
                "errorMessage" => ""
            );
            echo json_encode($result);
        } catch (\Error | \Exception $e) {
            $result = array(
                "succ" => false,
                "data" => array(),
                "errorMessage" => $e->getMessage()
            );
            echo json_encode($result);
        }
    }

    private static function addProductToBasket()
    {
        try {
            $basket = new Basket();
            $basket->addProductToBasket($_POST['productId'], $_POST['bagsCount']);

            $result = array(
                "succ" => true,
                "data" => array(),
                "errorMessage" => ""
            );
            echo json_encode($result);
        } catch (\Error | \Exception $e) {
            $result = array(
                "succ" => false,
                "data" => array(),
                "errorMessage" => $e->getMessage()
            );
            echo json_encode($result);
        }
    }
}
