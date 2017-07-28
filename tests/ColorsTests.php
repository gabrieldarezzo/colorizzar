<?php

namespace Colorizzar\Test;

use Colorizzar\Colors;

class ColorTests extends \PHPUnit_Framework_TestCase
{
    private $fileLocation;

    public function setUp()
    {
        $this->fileLocation = __DIR__.'/files/car.png';
    }

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
            134,
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
            'HexaDecimal TorchRed' => ['#FF1F28'],
        ];
    }

    /**
    * @expectedException Exception
    */
    public function testValidateNonExistHex()
    {
        $colors = Colors::getAllColors();
        $blueColor = Colors::createByHex('#ZZZZZZ');
    }

    
    public function testGetAllUniqueColors()
    {
        $uniqueColorsArr = Colors::getAllUniqueRgbColors($this->fileLocation);
        $this->assertTrue(is_array($uniqueColorsArr));
        $this->assertCount(
            36,
            $uniqueColorsArr,
            'Should be 36 colors red, black and shades of gray' //Ohhh Grey
        );
    }


    public function provideValidColors()
    {
        return (array) [
            'HexaDecimal TorchRed' => ['#FF1F28'],
            'RGB TorchRed' => [255, 31, 40],
        ];
    }

    /**
     * @dataProvider provideValidColors
     */
    public function testContainsThisColors($color)
    {
        $uniqueColorsArr = Colors::getAllUniqueRgbColors($this->fileLocation);

        $containColor = Colors::containsThisColor($color, $uniqueColorsArr);
        $this->assertTrue($containColor);
    }


    public function testNotFoundThisColor()
    {
        $uniqueColorsArr = Colors::getAllUniqueRgbColors($this->fileLocation);

        //Valid Color #324AB2 -> VioletBlue/Hexadecimal
        $containColor = Colors::containsThisColor('#324AB2', $uniqueColorsArr);
        $this->assertFalse($containColor);

        //Valid Color #324AB2 -> VioletBlue/Rgb
        $containColor = Colors::containsThisColor([50, 74, 178], $uniqueColorsArr);
        $this->assertFalse($containColor);
    }

    /**
     * @dataProvider provideValidColors
     */
    public function testContainsThisColorsByFile($color)
    {
        $containColor = Colors::containsThisColorByFile($color, $this->fileLocation);
        $this->assertTrue($containColor);
    }

    public function testNotFoundThisColorByFile()
    {
        //Valid Color #324AB2 -> VioletBlue/Hexadecimal
        $containColor = Colors::containsThisColorByFile('#324AB2', $this->fileLocation);
        $this->assertFalse($containColor);

        //Valid Color #324AB2 -> VioletBlue/Rgb
        $containColor = Colors::containsThisColorByFile([50, 74, 178], $this->fileLocation);
        $this->assertFalse($containColor);
    }
}
