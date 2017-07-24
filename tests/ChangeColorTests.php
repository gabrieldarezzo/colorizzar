<?php

namespace Colorizzar\Test;

use Colorizzar\ChangeColor;
use Colorizzar\Colors;

class ChangeColorTests extends \PHPUnit_Framework_TestCase
{
    private $fileLocation;
    private $folderOut;

    //Default is Red car, 'tests/files/car.png'
    private $defaultRedRGB = 255;
    private $defaultGreenRGB = 31;
    private $defaultBlueRGB = 40;

    public function setUp()
    {
        $this->fileLocation = __DIR__.'/files/car.png';
        $this->folderOut = __DIR__.'/output/';

        //Delete all old files if exists, (Will ignore .gitkeep because glob() ignores all 'hidden')
        $files = glob(__DIR__.'./output/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    public function assertPreConditions()
    {
        $this->assertFileExists(
            $this->fileLocation,
            'Arquivo de origem deve exitir.'
        );
    }

    public function testFileCreation()
    {
        $this->assertTrue(file_exists($this->fileLocation));
        $this->assertTrue(is_readable($this->fileLocation));
    }

    /**
    * @expectedException Exception
    */
    public function testShouldValidateSetFromRGB()
    {
        $changeColor = new ChangeColor($this->fileLocation);
        //$changeColor->setFromRGB($this->defaultRedRGB, $this->defaultGreenRGB, $this->defaultBlueRGB);

        //Blue Color
        $red   = 135;
        $green = 206;
        $blue  = 235;
        $changeColor->setToRGB($red, $green, $blue);

        $fileOut = $this->folderOut . 'new_blue_car.png';
        $changeColor->colorizeKeepAplhaChannnel($fileOut);

        $this->assertTrue(file_exists($this->fileLocation));
    }

    /**
    * @expectedException Exception
    */
    public function testShouldValidateSetToRGB()
    {
        $changeColor = new ChangeColor($this->fileLocation);
        $changeColor->setFromRGB($this->defaultRedRGB, $this->defaultGreenRGB, $this->defaultBlueRGB);

        //Blue Color
        $red   = 135;
        $green = 206;
        $blue  = 235;
        //$changeColor->setToRGB($red, $green, $blue);

        $fileOut = $this->folderOut . 'new_blue_car.png';
        $changeColor->colorizeKeepAplhaChannnel($fileOut);

        $this->assertTrue(file_exists($this->fileLocation));
    }

    public function testColorizeKeepAplhaChannnel()
    {
        $changeColor = new ChangeColor($this->fileLocation);
        $changeColor->setFromRGB($this->defaultRedRGB, $this->defaultGreenRGB, $this->defaultBlueRGB);

        //Blue Color
        $red   = 135;
        $green = 206;
        $blue  = 235;
        $changeColor->setToRGB($red, $green, $blue);

        $fileOut = $this->folderOut . 'new_blue_car.png';
        $changeColor->colorizeKeepAplhaChannnel($fileOut);

        $this->assertTrue(file_exists($this->fileLocation));
    }

    public function testColorizeByNameColorDefaultName()
    {
        $changeColor = new ChangeColor($this->fileLocation);
        $changeColor->setFromRGB($this->defaultRedRGB, $this->defaultGreenRGB, $this->defaultBlueRGB);
        $changeColor->colorizeByNameColor('Red Violet', $this->folderOut);

        $this->assertTrue(file_exists($this->folderOut . 'red_violet.png'));
    }

    public function testColorizeByNameColorCustomName()
    {
        $changeColor = new ChangeColor($this->fileLocation);
        $changeColor->setFromRGB($this->defaultRedRGB, $this->defaultGreenRGB, $this->defaultBlueRGB);
        $changeColor->colorizeByNameColor('Red Violet', $this->folderOut, 'violetinha.png');

        $this->assertTrue(file_exists($this->folderOut . 'violetinha.png'));
    }

    public function testColorizeLoopColors()
    {
        $changeColor = new ChangeColor($this->fileLocation);
        $changeColor->setFromRGB($this->defaultRedRGB, $this->defaultGreenRGB, $this->defaultBlueRGB);

        foreach (Colors::getAllColors() as $color) {
            $rgb = $color->getRgb();
            $targetRed   = $rgb[0];
            $targetGreen = $rgb[1];
            $targetBlue  = $rgb[2];
            $colorName = $color->getColorName();

            $folderOut = $this->folderOut . $colorName . '.png';

            $changeColor->setToRGB($targetRed, $targetGreen, $targetBlue);
            $changeColor->colorizeKeepAplhaChannnel($folderOut);
        }

        $this->assertTrue(file_exists($this->folderOut . 'blue.png'));
    }

    public function testColorizeToAllColors()
    {
        $changeColor = new ChangeColor($this->fileLocation);
        $changeColor->setFromRGB($this->defaultRedRGB, $this->defaultGreenRGB, $this->defaultBlueRGB);

        $resultAllColors = $changeColor->colorizeToAllColors($this->folderOut);

        $finalResult = true;
        $findFile = true;

        //Check if result is true and file exists
        foreach ($resultAllColors as $result) {
            $finalResult = $finalResult && $result['result'];
            $findFile = $findFile && file_exists($this->folderOut . $result['file_name']);
        }

        $this->assertTrue($finalResult);
        $this->assertTrue($findFile);
    }
}
