<?php

namespace Colorizzar;

use Colorizzar\Colors;
use Exception;

class ChangeColor
{
    private $filePathIn;

    private $fromRed;
    private $fromGreen;
    private $fromBlue;

    private $toRed;
    private $toGreen;
    private $toBlue;

    /**
    * Set File Path
    * @param string $inputFilePathIn File Path of file you want change color
    */
    public function __construct($inputFilePathIn)
    {
        if (!file_exists($inputFilePathIn)) {
            throw new Exception(
                sprintf('File "%s" not exists.', $inputFilePathIn)
            );
        }

        $this->filePathIn = $inputFilePathIn;
    }

    /**
    * Set RGB colors From
    * @param int $r color
    * @param int $g color
    * @param int $b color
    */
    public function setFromRGB($red, $green, $blue)
    {
        $this->fromRed   = $red;
        $this->fromGreen = $green;
        $this->fromBlue  = $blue;
    }

    /**
    * Set RGB colors To
    * @param int $r color
    * @param int $g color
    * @param int $b color
    */
    public function setToRGB($red, $green, $blue)
    {
        $this->toRed   = $red;
        $this->toGreen = $green;
        $this->toBlue  = $blue;
    }

    /**
    * Check if fromRGB is set
    * @return boolean
    */
    public function validateFromRGB()
    {
        return isset($this->fromRed, $this->fromGreen, $this->fromBlue);
    }


    /**
    * Check if fromRGB is set
    * @return boolean
    */
    public function validateToRGB()
    {
        return isset($this->toRed, $this->toGreen, $this->toBlue);
    }

    /**
    * Check if fromRGB is set
    * Original content: http://stackoverflow.com/questions/17733805/php-replace-base-color-of-transparent-png-image
    * @param string $fileOutPath File Path where new file will created
    * @return boolean
    */
    public function colorizeKeepAplhaChannnel($fileOutPath)
    {
        if (!$this->validateFromRGB()) {
            throw new Exception("You should use setFromRGB() method");
        }

        if (!$this->validateToRGB()) {
            throw new Exception("You should use setToRGB() method");
        }

        $im_src = imagecreatefrompng($this->filePathIn);
        $im_dst = imagecreatefrompng($this->filePathIn);
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
                $colorNew = imagecolorallocatealpha($im_src, $this->toRed, $this->toGreen, $this->toBlue, $alpha);

                $flagFoundColor = true;

                $colorOld = imagecolorallocatealpha(
                    $im_src,
                    $colorOldRGB["red"],
                    $colorOldRGB["green"],
                    $colorOldRGB["blue"],
                    0
                );

                $color2Change = imagecolorallocatealpha($im_src, $this->fromRed, $this->fromGreen, $this->fromBlue, 0);

                $flagFoundColor = ($color2Change == $colorOld);

                if (false === $colorNew) {
                    $flagOK = 0;
                } elseif ($flagFoundColor) {
                    imagesetpixel($im_dst, $x, $y, $colorNew);
                }
            }
        }

        return imagepng($im_dst, $fileOutPath);
    }

    /**
    * Will recive color name and will replace
    * @param string $nameColor
    * @param string $folderName Save file in this folder
    * @param string $fileName (optional) If you don't send nothing will get sanitize name of color, ex: 'red_violet.png'
    * @return boolean
    */
    public function colorizeByNameColor($nameColor, $folderName, $fileName = '')
    {
        $color = Colors::createByName($nameColor);

        $rgb = $color->getRgb();
        $targetRed = $rgb[0];
        $targetGreen = $rgb[1];
        $targetBlue = $rgb[2];
        $colorName = $color->getColorName();

        $fullName = $folderName . (($fileName == '') ? $colorName . '.png' : $fileName);

        $this->setToRGB($targetRed, $targetGreen, $targetBlue);

        return $this->colorizeKeepAplhaChannnel($fullName);
    }

    /**
    * Will Loop all colors and create a new file with a new color
    * @param string $folderName Where save all new files
    * @return Array
    */
    public function colorizeToAllColors($folderOut)
    {
        $returArr = [];
        foreach (Colors::getAllColors() as $color) {
            $rgb = $color->getRgb();
            $targetRed = $rgb[0];
            $targetGreen = $rgb[1];
            $targetBlue = $rgb[2];
            $colorName = $color->getColorName();
            $fullName = $folderOut . '/' . $colorName;

            $this->setToRGB($targetRed, $targetGreen, $targetBlue);
            $resultFile = $this->colorizeKeepAplhaChannnel($fullName);

            $returArr[] = [
                 'result'    => $resultFile
                ,'file_name' => $colorName
            ];
        }

        return $returArr;
    }
}
