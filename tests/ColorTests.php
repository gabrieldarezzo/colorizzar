<?php

namespace Colorizzar\Test;

use Colorizzar\Colors;

class ColorTests extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideValidColorName
     */
    public function testCreateByName($name)
    {
        $color = Colors::createByName($name);

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
        return (array) [
            'Single name' => ['Yellow'],
            'Compund name with space' => ['Yellow Orange'],
            'Compound name with spaces' => ['Granny Smith Apple'],
            'Compound name without spaces' => ['RedViolet'],
        ];
    }

    /**
     * @dataProvider provideInvalidColorName
     */
    public function testCreateByNameWithNonExistingColor($name)
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessageRegExp(
            '/Color \w+ not found./'
        );

        Colors::createByName($name);
    }

    public function provideInvalidColorName()
    {
        return (array) [
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


    /**
     * @dataProvider provideValidHexName
     */
    public function testCreateByHex($hexaDecimal)
    {        
        $colors = Colors::getAllColors();

        $classColor = Colors::createByHex($hexaDecimal);

        $this->assertInstanceOf(
            'Colorizzar\\Color\\HtmlColor',
            $classColor,
            sprintf(
                'Expected instance of HtmlColor when HexaDecimal "%s" send.',
                $hexaDecimal
            )
        );       
    }

    public function provideValidHexName()
    {
        return (array) [
            'HexaDecimal Blue' => ['#1F75FE'],
            'HexaDecimal Red' => ['#EE204D'],            
        ];
    }

}
