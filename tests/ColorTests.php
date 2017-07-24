<?php

namespace Colorizzar\Test;

use Colorizzar\Colors;

class ColorTests extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideValidColorName
     */
    public function testGetColorByName($name)
    {
        $color = Colors::getColorByName($name);

        $this->assertInstanceOf(
            'Colorizzar\\Color\\HtmlColor',
            $color,
            sprintf(
                'Expected color "%s" to exist as a valid class.',
                $name
            )
        );
    }

    public function provideValidColorName()
    {
        return [
            'Single name' => ['Yellow'],
            'Compund name with space' => ['Yellow Orange'],
            'Compound name with spaces' => ['Granny Smith Apple'],
            'Compound name without spaces' => ['RedViolet'],
        ];
    }

    /**
     * @dataProvider provideInvalidColorName
     */
    public function testGetColorByNameWithNonExistingColor($name)
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessageRegExp(
            '/Color \w+ not found./'
        );

        Colors::getColorByName($name);
    }

    public function provideInvalidColorName()
    {
        return [
            'Non exisiting color' => ['Gugu lindo']
        ];
    }

    public function testGetAllColors()
    {
        $colors = Colors::getAllColors();

        $this->assertCount(
            133,
            $colors
        );
    }
}
