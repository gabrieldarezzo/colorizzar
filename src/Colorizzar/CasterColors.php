<?php

namespace Colorizzar;

class CasterColors
{
    /**
    * Cast hexadecimal in rgb array
    * @param array rgb
    * @return string $hex hexadecimal
    */
    public static function rgbToHex(array $rgb)
    {
        $hexColor = sprintf("#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2]);
        return strtoupper($hexColor);
    }

    /**
    * Cast hexadecimal in rgb array
    * @param string $hex hexadecimal
    * @return array rgb
    */
    public static function hexToRgb($hex)
    {
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        return [$r, $g, $b];
    }

    /**
    * Cast Index color to array to rgb
    * @param resource $imageSource
    * @param int $x
    * @param int $y
    * @return array
    */
    public static function indexColorToRgb($imageSource, $x, $y)
    {
        $rgb = imagecolorat($imageSource, $x, $y);
                
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        return [$r, $g, $b];
    }
}
