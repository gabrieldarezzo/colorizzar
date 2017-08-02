<?php

namespace Colorizzar\Test;

use Colorizzar\CasterColors;

require_once __DIR__ . '/ColorizzarTests.php';

class CasterColorsTests extends ColorizzarTests
{
    public function setUp()
    {
        parent::setUp();
    }
        
    public function testRgbToHex()
    {
        foreach ($this->allColors as $classColor) {
            $hexaResult = CasterColors::rgbToHex($classColor->getRgb());
            $this->assertEquals($hexaResult, $classColor->getHex());
        }
    }

    public function testHexToRgb()
    {
        foreach ($this->allColors as $classColor) {
            $rgbResult = CasterColors::hexToRgb($classColor->getHex());
            $this->assertEquals($rgbResult, $classColor->getRgb());
        }
    }
}
