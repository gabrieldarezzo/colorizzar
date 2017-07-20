<?php

use Colorizzar\ChangeColor;
use Colorizzar\Colors;

class ChangeColorTests extends PHPUnit_Framework_TestCase
{
    private $fileLocation;
    private $folderOut;
    
    public function SetUp()
    {
        $this->fileLocation = __DIR__.'./files/car.png';
        $this->folderOut = __DIR__.'./output/';
    }    

    public static function setUpBeforeClass() {
        //Limpa arquivos antigos 
        //(rm rf is just for linux...)
        $files = glob(__DIR__.'./output/*');        
        foreach($files as $file) {
            if(is_file($file)){
                unlink($file);
            }
        }
    }

    public function testFileCreation()
    {
        $this->assertTrue(file_exists($this->fileLocation));
        $this->assertTrue(is_readable($this->fileLocation));
    }

    public function testColorizeKeepAplhaChannnel()
    {        
        $targetRed   = 135;
        $targetGreen = 206;
        $targetBlue  = 235;
        $fileOut     = $this->folderOut . 'new_blue_car.png';

        $changeColor = new ChangeColor();
        $changeColor->colorizeKeepAplhaChannnel($this->fileLocation, $targetRed, $targetGreen, $targetBlue, $fileOut);
        
        $this->assertTrue(file_exists($this->fileLocation));
    }


    public function testColorizeByNameColor()
    {
        $changeColor = new ChangeColor();

        //Check Default Name
        $changeColor->colorizeByNameColor('Red Violet', $this->fileLocation, $this->folderOut);
        $this->assertTrue(file_exists($this->folderOut . 'red_violet.png'));

        //Check Custom name
        $changeColor->colorizeByNameColor('Red Violet', $this->fileLocation, $this->folderOut, 'violetinha.png');
        $this->assertTrue(file_exists($this->folderOut . 'violetinha.png'));        
    }

    
    public function testColorizeLoopColors()
    {

        $colors = Colors::getAllColors();

        foreach($colors as $color) {            

            $targetRed   = $color->rgb[0];
            $targetGreen = $color->rgb[1];
            $targetBlue  = $color->rgb[2];

            $colorNameTmp = str_replace(' ', '_', strtolower($color->name));
            $colorName = str_replace("'", '', $colorNameTmp);             

            $folderOut     = $this->folderOut . $colorName . '.png';
            $changeColor = new ChangeColor();
            $changeColor->colorizeKeepAplhaChannnel($this->fileLocation, $targetRed, $targetGreen, $targetBlue, $folderOut);            
        }


        $this->assertTrue(file_exists($this->folderOut . 'blue.png'));        
    }   

    public function testColorizeToAllColors()
    {        
        $changeColor = new ChangeColor();
        $changeColor->colorizeToAllColors($this->fileLocation, $this->folderOut);
    }
    
}
