<?php

namespace Colorizzar\Test;

use Colorizzar\UploadFile;

class UploadFileTests extends \PHPUnit_Framework_TestCase
{

    //Default is Red car, 'tests/files/car.png'
    private $mockFile;
    private $folderOut;

    public function setUp()
    {
        $this->fileLocation = __DIR__.'/files/car.png';
        $this->folderOut = __DIR__.'/output/';
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
    
   
    public function testUploadFileDiferentUploadPath()
    {
        $uploadClass = (new UploadFile)
            ->setUploadPath($this->folderOut . 'mycustomfolder')
            ->upload($this->mockFile)
        ;

        $this->assertTrue(file_exists($this->folderOut . 'mycustomfolder/car.png'));
    }


    public function testUploadCustomName()
    {
        $customName = 'test.png';
        $carFileName = new UploadFile();
        $carFileName->setUploadPath($this->folderOut . 'mycustomfolder3');
        $carFileName->upload($this->mockFile, $customName);
        $this->assertEquals($customName, $carFileName->getCustomNameFile());
    }

    public function testUploadFileWithWrongArray()
    {
        $uploadClass = (new UploadFile)
            ->setUploadPath($this->folderOut)
            ->upload([])
        ;

        $this->assertFalse($uploadClass);
    }

    public function testGenerateHashLenght()
    {
        $this->assertEquals(strlen(UploadFile::generateHash()), 16);
    }

    public function testGenerateHashUnique()
    {
        $this->assertNotEquals(UploadFile::generateHash(), UploadFile::generateHash());
    }
}
