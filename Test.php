<?php
include __DIR__ . "/vendor/autoload.php";

use BagsCalculator\Controller\TopsoilBagsCalculator;
use BagsCalculator\Config;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class CalculatorTest extends TestCase
{

    function testvalidInputs()
    {
        $topsoilBagsCalculator = new TopsoilBagsCalculator(12, Config::$defaultLength, 15, Config::$defaultMeasurementUnit, "Inch");
        $this->assertEquals($topsoilBagsCalculator->getCalculateRequest()->getWidth(), 12);
        $this->assertEquals($topsoilBagsCalculator->getCalculateRequest()->getLength(), Config::$defaultLength);
        $this->assertEquals($topsoilBagsCalculator->getCalculateRequest()->getDepth(), 15);
        $this->assertEquals($topsoilBagsCalculator->getCalculateRequest()->getMeasurementUnit(), Config::$defaultMeasurementUnit);
        $this->assertEquals($topsoilBagsCalculator->getCalculateRequest()->getDepthUnit(), "Inch");
    }

    function testInvalidInputs()
    {
        $this->expectException(InvalidArgumentException::class);
        $topsoilBagsCalculator = new TopsoilBagsCalculator(-1, Config::$defaultLength, Config::$defaultDepth, Config::$defaultMeasurementUnit, Config::$defaultDepthUnit);
    }

    function testBagsCalculateDefaultUnits()
    {

        $topsoilBagsCalculator = new TopsoilBagsCalculator(12, 12, 12, Config::$defaultMeasurementUnit, Config::$defaultDepthUnit);
        $bagsCount  = $topsoilBagsCalculator->calculateBagsCount();
        $this->assertEquals($bagsCount, 25);
    }

    function testBagsCalculate()
    {

        $topsoilBagsCalculator = new TopsoilBagsCalculator(12, 12, 12, "Meter", "Inch");
        $bagsCount  = $topsoilBagsCalculator->calculateBagsCount();
        $this->assertEquals($bagsCount, 62);
    }
}
