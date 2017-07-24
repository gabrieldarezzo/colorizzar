<?php

namespace Colorizzar;

use ReflectionClass;
use ReflectionException;
use InvalidArgumentException;

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
                static::getColorByName($className)
            );
        }

        return $colors;
    }

    /**
     * @TODO Make private and remove `generateColorClasses` script.
     */
    public static function normalizeColorToClassName($name)
    {
        $invalidChars = [' ', '\'', ']', '[', '(', ')'];
        return ucfirst(
            str_replace($invalidChars, '', $name)
        );
    }

    /**
     * @TODO Rename to `createByName` to better behave as a factory.
     */
    public static function getColorByName($name)
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
}
