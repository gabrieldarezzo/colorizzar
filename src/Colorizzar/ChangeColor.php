<?php

namespace Colorizzar;

use Colorizzar\Colors;

class ChangeColor
{

    

    //Same of 'car.png', rgb(255, 31, 40) == #ff1f28
    private $defaultRed = 255;
    private $defaultGreen = 31;
    private $defaultBlue = 40;


    //Original content: http://stackoverflow.com/questions/17733805/php-replace-base-color-of-transparent-png-image
    public function colorizeKeepAplhaChannnel($inputFilePathIn, $targetRedIn, $targetGreenIn, $targetBlueIn, $saida)
    {

        $im_src = imagecreatefrompng($inputFilePathIn);
        $im_dst = imagecreatefrompng($inputFilePathIn);
        $width = imagesx($im_src);
        $height = imagesy($im_src);

        // Note this: FILL IMAGE WITH TRANSPARENT BG
        imagefill($im_dst, 0, 0, IMG_COLOR_TRANSPARENT);
        imagesavealpha($im_dst, true);
        imagealphablending($im_dst, true);

        $flagOK = 1;
        for ($x=0; $x<$width; $x++) {
            for ($y=0; $y<$height; $y++) {
                $rgb = imagecolorat($im_src, $x, $y);
                $colorOldRGB = imagecolorsforindex($im_src, $rgb);
                $alpha = $colorOldRGB["alpha"];
                $colorNew = imagecolorallocatealpha($im_src, $targetRedIn, $targetGreenIn, $targetBlueIn, $alpha);

                $flagFoundColor = true;

                $colorOld = imagecolorallocatealpha($im_src, $colorOldRGB["red"], $colorOldRGB["green"], $colorOldRGB["blue"], 0);
                
                $color2Change = imagecolorallocatealpha($im_src, $this->defaultRed, $this->defaultGreen, $this->defaultBlue, 0);

                $flagFoundColor = ($color2Change == $colorOld);

                if (false === $colorNew) {
                    $flagOK = 0;
                } elseif ($flagFoundColor) {
                    imagesetpixel($im_dst, $x, $y, $colorNew);
                }
            }
        }
        
        $flagOK2 = imagepng($im_dst, $saida);
    }

    public function colorizeToAllColors($fileInput, $folderOut)
    {

        $colors = Colors::getAllColors();

        foreach ($colors as $color) {
            $targetRed = $color->rgb[0];
            $targetGreen = $color->rgb[1];
            $targetBlue = $color->rgb[2];
            
            $colorNameTmp = str_replace(' ', '_', strtolower($color->name));
            $colorName = str_replace("'", '', $colorNameTmp);
            $fullName = $folderOut . '/' . $colorName . '.png';

            
            $this->colorizeKeepAplhaChannnel($fileInput, $targetRed, $targetGreen, $targetBlue, $fullName);
        }
    }


    public function colorizeByNameColor($nameColor, $fileInput, $folderName, $fileName = '')
    {
        //check $folderName, and force end with '/'

        $color = Colors::getColorByName($nameColor);

        $targetRed = $color->rgb[0];
        $targetGreen = $color->rgb[1];
        $targetBlue = $color->rgb[2];
        
        $colorNameTmp = str_replace(' ', '_', strtolower($color->name));
        $colorName = str_replace("'", '', $colorNameTmp);

        if ($fileName == '') {
            $fullName = $folderName . $colorName . '.png';
        } else {
            $fullName = $folderName . $fileName;
        }
        
        $this->colorizeKeepAplhaChannnel($fileInput, $targetRed, $targetGreen, $targetBlue, $fullName);
    }
}
