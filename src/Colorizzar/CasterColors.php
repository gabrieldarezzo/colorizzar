<?php

namespace Colorizzar;

class CasterColors
{

    public static function rgbToHex(Array $rgb)
    {
        $hexColor = sprintf("#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2]);
        return strtoupper($hexColor);
    }

    public static function hexToRgb($hex)
    {
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        return (array) [$r, $g, $b];
    }
    
}
