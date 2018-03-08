<?php

namespace Colorizzar\Test;

use Colorizzar\Colors;
use Colorizzar\UploadFile;
use Colorizzar\ColorizzarWebService;

class ColorizzarWebServiceTests extends ColorizzarTests
{
    public function setUp()
    {
        parent::setUp();
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
