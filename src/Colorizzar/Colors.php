<?php

namespace Colorizzar;

use ReflectionClass;
use ReflectionException;
use InvalidArgumentException;
use Exception;

class Colors
{
    const COLOR_CLASS_NAME_TEMPLATE = 'Colorizzar\\Color\\%s';

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

    private static function normalizeColorToClassName($name)
    {
        $invalidChars = [' ', '\'', ']', '[', '(', ')'];
        return ucfirst(
            str_replace($invalidChars, '', $name)
        );
    }

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


    public static function createByHex($hexaDecimal)
    {
        foreach(static::getAllColors() as $classColor) {
            if($classColor->getHex() == $hexaDecimal){
                return $classColor;
            }
        }

        throw new Exception(
            sprintf('File Color not exists HexDecimal used: "%s"', $hexaDecimal)
        );

    }
}
