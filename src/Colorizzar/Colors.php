<?php

namespace Colorizzar;

use ReflectionClass;
use ReflectionException;
use InvalidArgumentException;
use Exception;

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
}
