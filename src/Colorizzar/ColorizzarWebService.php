<?php

namespace Colorizzar;

use Colorizzar\Color\HtmlColor;
use Colorizzar\ChangeColor;
use Colorizzar\UploadFile;

class ColorizzarWebService
{
    public function createFile($file, HtmlColor $colorFrom, HtmlColor $colorTo, $customFolder = '')
    {
        $carFileName = new UploadFile();

        if ($customFolder != '') {
            $carFileName->setUploadPath($customFolder);
            $customFolder =  $customFolder . DIRECTORY_SEPARATOR;
        } else {
            //Get Default folder in this case
            $customFolder = $carFileName->getUploadPath() . DIRECTORY_SEPARATOR;
        }

        $newNameFile = UploadFile::generateHash() . '.png';
        $carFileName->upload($file, $newNameFile);
        $customName = $carFileName->getCustomNameFile();
        
        $changeColor = new ChangeColor($carFileName->getFullPathFile());
        $changeColor->setFromHex($colorFrom->getHex());
        $changeColor->setToHex($colorTo->getHex());
        return $changeColor->colorizeKeepAplhaChannnel($customFolder . $customName);
    }
}
