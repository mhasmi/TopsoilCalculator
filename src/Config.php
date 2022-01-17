<?php

namespace BagsCalculator;

class Config
{
    static $dbHost = "localhost";
    static $dbDatabase = "test_code";
    static $dbUsername = "root";
    static $dbPassword = "";
    static $dbPort = 3306;



    static $measurementUnits = array("Meter", "Yard", "Foot");
    static $depthUnits = array("Centimeter", "Inch");

    static $defaultMeasurementUnit = "Meter";
    static $defaultDepthUnit = "Centimeter";
    static $defaultWidth = 1;
    static $defaultLength = 1;
    static $defaultDepth = 1;
}
