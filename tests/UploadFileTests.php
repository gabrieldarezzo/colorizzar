<?php

namespace Colorizzar\Test;

use Colorizzar\UploadFile;

class UploadFileTests extends ColorizzarTests
{
    public function setUp()
    {
        parent::setUp();
    }
    
    /**
    * @group upload
    */
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

    /**
    * @expectedException RuntimeException
    */
    public function testUploadFileWithWrongArray()
    {
        $uploadClass = (new UploadFile)
            ->setUploadPath($this->folderOut)
            ->upload([])
        ;
    }

    public function testGenerateHashLenght()
    {
        $this->assertEquals(strlen(UploadFile::generateHash()), 16);
    }

    public function testGenerateHashUnique()
    {
        $this->assertNotEquals(UploadFile::generateHash(), UploadFile::generateHash());
    }

    public function testTypeImage()
    {
        $this->assertEquals(UploadFile::getImageType($this->fileLocation), IMAGETYPE_PNG);
    }
}
