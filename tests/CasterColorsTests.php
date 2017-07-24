<?php

namespace Colorizzar\Test;

use Colorizzar\Colors;
use Colorizzar\CasterColors;

class CasterColorsTests extends \PHPUnit_Framework_TestCase
{

    private $allColors;
    
    public function setUp()
    {        
        $this->allColors = Colors::getAllColors();
    }

    
    public function testRgbToHex()
    {
        foreach($this->allColors as $classColor){
            $hexaResult = CasterColors::rgbToHex($classColor->getRgb());            
            $this->assertEquals($hexaResult, $classColor->getHex());
        }        
    }

    public function testHexToRgb()
    {        
        foreach($this->allColors as $classColor){
            $rgbResult = CasterColors::hexToRgb($classColor->getHex());
            $this->assertEquals($rgbResult, $classColor->getRgb());
        }        
    }
   
}
