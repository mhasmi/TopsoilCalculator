<?php

namespace BagsCalculator\Support;

use \Exception;

class CalculateUtils
{
    public static function convertToMeter(float $value, $lengthUnit): float
    {
        switch ($lengthUnit) {
            case "Meter": {
                    return $value;
                    break;
                }

            case "Yard": {
                    return $value * 0.9144;
                    break;
                }
            case "Foot": {
                    return $value * 0.3048;
                    break;
                }
            case "Centimeter": {
                    return $value * 0.01;
                    break;
                }
            case "Inch": {
                    return $value * 0.0254;
                    break;
                }
            default: {
                    throw new Exception("unkown unit!");
                }
        }
    }
}
