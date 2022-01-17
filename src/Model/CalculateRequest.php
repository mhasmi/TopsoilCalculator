<?php

namespace BagsCalculator\Model;

use BagsCalculator\Support\DbUtils;

class CalculateRequest
{
    private float $width;
    private float $length;
    private float $depth;
    private string $measurementUnit;
    private string $depthUnit;
    private string $bagType;


    public function setDimensions(float $width, float $length, float $depth): void
    {
        $this->width = $width;
        $this->length = $length;
        $this->depth = $depth;
    }

    public function setBagType(string $bagType)
    {
        $this->bagType  = $bagType;
    }
    public function getBagType(): string
    {
        return  $this->bagType;
    }

    public function setMeasurementUnit(string $measurementUnit): void
    {
        $this->measurementUnit = $measurementUnit;
    }

    public function setDepthUnit(string $depthUnit): void
    {
        $this->depthUnit = $depthUnit;
    }

    public function getMeasurementUnit(): string
    {
        return $this->measurementUnit;
    }

    public function getDepthUnit(): string
    {
        return  $this->depthUnit;
    }
    public function getWidth(): float
    {
        return  $this->width;
    }

    public function getLength(): float
    {
        return  $this->length;
    }

    public function getDepth(): float
    {
        return  $this->depth;
    }

    public function save(int $totalBags): void
    {
        $sql = "INSERT INTO `bag_calculate_requests`( `bag_type`,`width`, `length`, `depth`, `measurement_unit`, `depth_unit`, `total_bags`,`calculate_date`) VALUES ('" . DbUtils::escape($this->bagType) . "'," . DbUtils::escape($this->width) . "," . DbUtils::escape($this->length) . "," . DbUtils::escape($this->depth) . ",'" . DbUtils::escape($this->measurementUnit) . "','" . DbUtils::escape($this->depthUnit) . "'," . $totalBags . ",NOW()) ";
        DbUtils::query($sql);
    }
}
