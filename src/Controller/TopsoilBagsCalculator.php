<?php

namespace BagsCalculator\Controller;

use BagsCalculator\Controller\BagsCalculator;

class TopsoilBagsCalculator extends BagsCalculator
{


    public  function __construct(float $width, float $length, float $depth, string $measurementUnit, string $depthUnit)
    {

        $bagType = "topsoil";
        $bagsForCubeMeter = 1.4;
        parent::__construct($bagType, $bagsForCubeMeter, $width,  $length,  $depth,  $measurementUnit,  $depthUnit);
    }
}
