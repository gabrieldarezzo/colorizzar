<?php

namespace Colorizzar;

use ReflectionClass;
use ReflectionException;
use InvalidArgumentException;
use Exception;
use Colorizzar\CasterColors;

class Colors
{
    const COLOR_CLASS_NAME_TEMPLATE = 'Colorizzar\\Color\\%s';


    /**
    * Return array with all colors in project
    * @return array
    */
    public static function getAllColors()
    {
        $colors = [];
        foreach (glob(__DIR__.'/Color/*.php') as $fileName) {
            $className = str_replace(
                ['.php'],
                '',
                basename($fileName)
            );

            if ($className == 'HtmlColor') {
                continue;
            }

            array_push(
                $colors,
                static::createByName($className)
            );
        }

        return $colors;
    }

    /**
    * Normalize Class Name
    * @return string
    */
    private static function normalizeColorToClassName($name)
    {
        $invalidChars = [' ', '\'', ']', '[', '(', ')'];
        return ucfirst(
            str_replace($invalidChars, '', $name)
        );
    }

    /**
    * Return a instance of Colors by name color
    * @param string $name File Path where new file will created
    * @return Colors
    */
    public static function createByName($name)
    {
        $normalizedName = static::normalizeColorToClassName($name);
        $className = sprintf(self::COLOR_CLASS_NAME_TEMPLATE, $normalizedName);

        try {
            $reflection = new ReflectionClass($className);

            return $reflection->newInstance();
        } catch (ReflectionException $e) {
            throw new InvalidArgumentException(
                sprintf('Color %s not found.', $normalizedName),
                0,
                $e
            );
        }
    }

    /**
    * Return a instance of Colors by hexadecimal, Ex: '#1F75FE'
    * @param string $name File Path where new file will created
    * @return Colors
    */
    public static function createByHex($hexaDecimal)
    {
        foreach (static::getAllColors() as $classColor) {
            if ($classColor->getHex() == $hexaDecimal) {
                return $classColor;
            }
        }

        throw new Exception(
            sprintf('File Color not exists HexDecimal used: "%s"', $hexaDecimal)
        );
    }

    /**
    * Loop (start x, y) pixel by pixel, if is unique rgb color get and return array
    * (y)
    *  |
    *  |
    *  +----(x)
    * @param string $name File Path where new file will created
    * @return array
    */
    public static function getAllUniqueHexColors($filePathIn)
    {
        if (!file_exists($filePathIn)) {
            throw new Exception(
                sprintf('File "%s" not exists.', $filePathIn)
            );
        }

        $im_src = imagecreatefrompng($filePathIn);
        $width = imagesx($im_src);
        $height = imagesy($im_src);

        $uniqueRgb = [];

        for ($x=0; $x < $width; $x++) {
            for ($y=0; $y < $height; $y++) {
                $rgb = imagecolorat($im_src, $x, $y);
                
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                
                $rgbLoop = [$r, $g, $b];
                
                $isUnique = true;
                for ($i = 0; $i < count($uniqueRgb); $i++) {
                    if ($uniqueRgb[$i][0] == $rgbLoop[0]
                        && $uniqueRgb[$i][1] == $rgbLoop[1]
                        && $uniqueRgb[$i][2] == $rgbLoop[2]
                    ) {
                        $isUnique = false;
                    }
                }

                if ($isUnique) {
                    $uniqueRgb[] = $rgbLoop;
                }
            }
        }

        return $uniqueRgb;
    }


    /**
    * Check if contains hexadecimal color in image
    * @param mixed[string hexaDecimal /array rgb] Accept Hexadecimal or rgb
    * @return boolean
    */
    public static function containsThisColor($searchParams, $rgbArr)
    {
        if (!is_array($searchParams)) {
            $searchParams = CasterColors::hexToRgb($searchParams);
        }

        foreach ($rgbArr as $rgb) {
            if ($rgb[0] == $searchParams[0]
                && $rgb[1] == $searchParams[1]
                && $rgb[2] == $searchParams[2]
            ) {
                return true;
            }
        }

        return false;
    }
}
