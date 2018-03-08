<?php
namespace Colorizzar\Test;

use Colorizzar\Colors;
use PHPUnit\Framework\TestCase;

class ColorizzarTests extends TestCase
{
    protected $allColors;
    protected $fileLocation;
    protected $folderOut;

    //Default is Red car, 'tests/files/car.png'
    protected $defaultRedRGB = 255;
    protected $defaultGreenRGB = 31;
    protected $defaultBlueRGB = 40;
    protected $defaultHex = '#FF1F28';
    protected $mockFile;
    

    public function setUp()
    {
        $this->fileLocation = __DIR__.'/files/car.png';
        $this->folderOut = __DIR__.'/output/';
        $this->allColors = Colors::getAllColors();
        $this->defaultFolder = $this->folderOut . '..'.  DIRECTORY_SEPARATOR .'..' . DIRECTORY_SEPARATOR;


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

    public function testFileCreation()
    {
        $this->assertTrue(file_exists($this->fileLocation));
        $this->assertTrue(is_readable($this->fileLocation));
    }

    public function assertPreConditions()
    {
        $this->assertFileExists(
            $this->fileLocation,
            'Arquivo de origem deve exitir.'
        );
    }
}
