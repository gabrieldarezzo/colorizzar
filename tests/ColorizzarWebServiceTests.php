<?php

namespace Colorizzar\Test;

use Colorizzar\Colors;
use Colorizzar\UploadFile;
use Colorizzar\ColorizzarWebService;

class ColorizzarWebServiceTests extends \PHPUnit_Framework_TestCase
{
    //Default is Red car, 'tests/files/car.png'
    private $mockFile;
    private $fileLocation;
    private $folderOut;
    
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

        //Mock File, equivalent of $_FILE but don't forget about (uploaded via PHP's HTTP POST upload mechanism check)
        $this->mockFile = [
            'arquivo' => [
                'name' => 'car.png',
                'type' => 'image/jpeg',
                'tmp_name' => $this->fileLocation,
                'error' => 0,
                'size' => 827
            ]
        ];
    }


    public function provideValidColorName()
    {
        return (array) [
            'Banana Color' => ['BananaMania'],
            'Brown Color' => ['Brown'],
            'Yellow Color' => ['Yellow'],
            'Blue Color' => ['Blue'],
        ];
    }

    /**
    * @group clx
    */
    public function testCreateFile()
    {
        $colorizzarWS = new ColorizzarWebService();

        $torchRed = Colors::createByName('TorchRed');
        $black = Colors::createByName('BananaMania');
        $result = $colorizzarWS->createFile($this->mockFile, $torchRed, $black);

        $this->assertTrue($result);
    }


    /**
     * @dataProvider provideValidColorName
    */
    public function testCreateFileWithCustomFolder($colorName)
    {
        $colorizzarWS = new ColorizzarWebService();
        $fullCustomFolder = $this->folderOut . 'wsfolder';

        $torchRed = Colors::createByName('TorchRed');
        $black = Colors::createByName($colorName);
        $result = $colorizzarWS->createFile($this->mockFile, $torchRed, $black, $fullCustomFolder);

        $this->assertTrue($result);
    }
}
