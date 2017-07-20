<?php

use Colorizzar\Colors;

class ColorTests extends PHPUnit_Framework_TestCase
{    
    public function SetUp()
    {

    }

    public function testArrayColors()
    {        
    	$colors = Colors::getAllColors();

    	$this->assertTrue(is_array($colors));

    	$color = $colors[42];

    	//Name
    	$this->assertEquals($color->name, 'Granny Smith Apple');

    	//R
    	$this->assertEquals($color->rgb[0], 168);
    	//G
    	$this->assertEquals($color->rgb[1], 228);
    	//B
    	$this->assertEquals($color->rgb[2], 160);

    	$colorViolet = Colors::getColorByName('Red Violet');
    	//R
    	$this->assertEquals($colorViolet->rgb[0], 192);
    	//G
    	$this->assertEquals($colorViolet->rgb[1], 68);
    	//B
    	$this->assertEquals($colorViolet->rgb[2], 143);
    }
    
   
}
