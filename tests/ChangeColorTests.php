<?php

namespace Colorizzar\Test;

use Colorizzar\ChangeColor;
use Colorizzar\Colors;
use Colorizzar\CasterColors;

class ChangeColorTests extends ColorizzarTests
{
    private $newOutput = '/tmp/new_output/';

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage File "invalid_file_path" not exists.
     */
    public function testConstructorWithInvalidFilePath()
    {
        $changeColor = new ChangeColor('invalid_file_path');
    }

    public function testColorizeByNameColorWithCreatingSubFolder()
    {
        $changeColor = new ChangeColor($this->fileLocation);
        $changeColor->setFromRGB($this->defaultRedRGB, $this->defaultGreenRGB, $this->defaultBlueRGB);
        $result = $changeColor->colorizeByNameColor('Red Violet', $this->newOutput, 'violetinha.png');
        unlink($this->newOutput . 'violetinha.png');
        rmdir($this->newOutput);

        $this->assertTrue($result);
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
        $result = $changeColor->colorizeByNameColor('Red Violet', $this->folderOut);

        $this->assertTrue($result);
    }

    public function testColorizeByNameColorCustomName()
    {
        $changeColor = new ChangeColor($this->fileLocation);
        $changeColor->setFromRGB($this->defaultRedRGB, $this->defaultGreenRGB, $this->defaultBlueRGB);
        $changeColor->colorizeByNameColor('Red Violet', $this->folderOut, 'violetinha.png');

        $this->assertTrue(file_exists($this->folderOut . 'violetinha.png'));
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
            $carCreated = strtolower($result['file_name']) . '.png';
            $finalResult = $finalResult && $result['result'];
            $findFile = $findFile && file_exists($this->folderOut . $carCreated);
        }

        $this->assertTrue($finalResult);
        $this->assertTrue($findFile);
    }

       
    public function provideValidHexName()
    {
        return [
            'HexaDecimal Blue' => ['#1F75FE'],
            'HexaDecimal Red' => ['#EE204D'],
            'HexaDecimal VioletBlue' => ['#324AB2'],
            'HexaDecimal Orange' => ['#FF7538'],
            'HexaDecimal TorchRed' => ['#FF1F28'],
        ];
    }

    /**
     * @dataProvider provideValidHexName
    */
    public function testSetAndToToHex($hexaDecimal)
    {
        $changeColor = new ChangeColor($this->fileLocation);
        $changeColor->setFromHex($this->defaultHex);

        $changeColor->setToHex($hexaDecimal);
        $fileOut = $this->folderOut . $hexaDecimal . '.png';
        $changeColor->colorizeKeepAplhaChannnel($fileOut);

        $this->assertTrue(file_exists($fileOut));
    }
}
