<?php

namespace BagsCalculator\Support;

class LoadUtils
{
    public static function loadView($path, $data): string
    {
        ob_start();
        include $path;
        return (ob_get_clean());
    }
}
