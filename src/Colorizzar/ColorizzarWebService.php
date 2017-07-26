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
        }

        $carFileName->upload($file, UploadFile::generateHash() . '.png');
        $customName = $carFileName->getCustomNameFile();
        
        $changeColor = new ChangeColor($carFileName->getFullPathFile());
        $changeColor->setFromHex($colorFrom->getHex());
        $changeColor->setToHex($colorTo->getHex());
        return $changeColor->colorizeKeepAplhaChannnel($customFolder . '/' . $customName);
    }
}
