<?php

namespace BagsCalculator\Controller;

use BagsCalculator\Support\CalculateUtils;
use BagsCalculator\Model\CalculateRequest;
use BagsCalculator\Model\Product;
use BagsCalculator\Support\LoadUtils;
use \Exception;
use BagsCalculator\Config;


abstract class BagsCalculator
{

    private CalculateRequest $calculateRequest;
    private float $bagsForCubeMeter;


    public  function __construct(string $bagType, float $bagsForCubeMeter, float $width, float $length, float $depth, string $measurementUnit, string $depthUnit)
    {

        $this->validate($bagsForCubeMeter, $width,  $length,  $depth,  $measurementUnit,  $depthUnit);

        $this->calculateRequest = new CalculateRequest();
        $this->calculateRequest->setBagType($bagType);
        $this->calculateRequest->setMeasurementUnit($measurementUnit);
        $this->calculateRequest->setDepthUnit($depthUnit);
        $this->calculateRequest->setDimensions($width, $length, $depth);

        $this->setBagsForCubeMeter($bagsForCubeMeter);
    }

    private function validate(float $bagsForCubeMeter, float $width, float $length, float $depth, string $measurementUnit, string $depthUnit): void
    {
        if ($bagsForCubeMeter <= 0) {
            throw new \InvalidArgumentException("bags For CubeMeter must be more 0 ");
        }

        if ($width <= 0) {
            throw new \InvalidArgumentException("Width must be more than 0 ");
        }

        if ($length <= 0) {
            throw new \InvalidArgumentException("Length must be more than 0 ");
        }

        if ($depth <= 0) {
            throw new \InvalidArgumentException("Depth must be more than 0 ");
        }

        if (!in_array($measurementUnit, Config::$measurementUnits)) {
            throw new \InvalidArgumentException("measurement unit not correct!  ");
        }

        if (!in_array($depthUnit, Config::$depthUnits)) {
            throw new \InvalidArgumentException("depth unit not correct!");
        }
    }



    public function setBagsForCubeMeter(float $bagsForCubeMeter): void
    {
        $this->bagsForCubeMeter = $bagsForCubeMeter;
    }

    public function getCalculateRequest(): CalculateRequest
    {
        return $this->calculateRequest;
    }






    private function volumeCalculate(): float
    {
        $widthInMeter = CalculateUtils::convertToMeter($this->calculateRequest->getWidth(), $this->calculateRequest->getMeasurementUnit());
        $lengthInMeter = CalculateUtils::convertToMeter($this->calculateRequest->getlength(), $this->calculateRequest->getMeasurementUnit());
        $depthInMeter = CalculateUtils::convertToMeter($this->calculateRequest->getDepth(), $this->calculateRequest->getDepthUnit());

        return $widthInMeter * $lengthInMeter * $depthInMeter;
    }
    public function calculateBagsCount(): int
    {
        return ceil($this->volumeCalculate() * $this->bagsForCubeMeter);
    }
    public function saveCalculateRequest(int $totalBags): void
    {
        $this->calculateRequest->save($totalBags);
    }

    public  function viewCalculatorCard(): string
    {
        $data = array();
        $data['width'] = $this->calculateRequest->getWidth();
        $data['length'] = $this->calculateRequest->getLength();
        $data['depth'] = $this->calculateRequest->getDepth();
        $data['measurementUnit'] = $this->calculateRequest->getMeasurementUnit();
        $data['depthUnit'] = $this->calculateRequest->getDepthUnit();
        $data['measurementUnits'] = Config::$measurementUnits;
        $data['depthUnits'] = Config::$depthUnits;

        $data['totalBags'] = $this->calculateBagsCount();

        $data['products'] = Product::getProducts($this->calculateRequest->getBagType());



        return LoadUtils::loadView(__DIR__ . "/../view/calculator.html", $data);
    }
}
