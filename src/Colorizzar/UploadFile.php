<?php

namespace Colorizzar;

use Exception;
use RuntimeException;

class UploadFile
{
    private $UploadPath = 'uploads';
    private $customNameFile;
    private $fullPathFile;

    /**
    * @param string $path Set UploadPath
    * @return Colorizzar
    */
    public function setUploadPath($path)
    {
        //var_dump($path);
        $this->UploadPath = $path;
        return $this;
    }

    /**
    * Get Actual [or default] uploadFile
    * @return string
    */
    public function getUploadPath()
    {
        return $this->UploadPath;
    }


    /**
    * @param string $customNameFile
    * @return Colorizzar
    */
    public function setCustomNameFile($customNameFile)
    {
        $this->customNameFile = $customNameFile;
        return $this;
    }

    /**
    * @return string Colorizzar->customNameFile
    */
    public function getCustomNameFile()
    {
        return $this->customNameFile;
    }

    public function setFullPathFile($fullPathFile)
    {
        $this->fullPathFile = $fullPathFile;
    }

    /**
    * @return string Colorizzar->customNameFile
    */
    public function getFullPathFile()
    {
        return $this->fullPathFile;
    }

    /**
    * Generate a Hash
    * @return string
    */
    public static function generateHash()
    {
        return strtoupper(bin2hex(openssl_random_pseudo_bytes(8)));
    }

    /**
    * Upload File, just pass array of global $_FILES the core concept is facility to test
    * @param array $file with $_FILES to save, should be just one with name="arquivo"
    * @param string $customNameFile (optional) custom name
    * @return boolean
    */
    public function upload(array $file, $customNameFile = '')
    {
        $this->handle($file);

        $name = (($customNameFile == '') ? $file['arquivo']['name'] : $customNameFile);
        $tmp_name = $file['arquivo']['tmp_name'];
        $this->setCustomNameFile($name);


        $upload_dir = $this->UploadPath . DIRECTORY_SEPARATOR . $name;
        //var_dump($upload_dir);
        //var_dump($name);

        $this->setFullPathFile($upload_dir);
            
        //Make my life easy to test, if not upload just copy
        if (!is_uploaded_file($tmp_name)) {
            return copy($tmp_name, $upload_dir);
            //return static::copyImage($tmp_name, $upload_dir);
        }
        
        return static::moveUpload($tmp_name, $upload_dir);
    }

    /**
    * Responsible for conditional verification
    * @return void
    */
    private function handle(array $file)
    {
        if (empty($file)) {
            throw new RuntimeException('File not defined');
        }
        
        if (! file_exists($this->UploadPath)) {
            mkdir($this->UploadPath);
        }
        
        if ($file['arquivo']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception($file['arquivo']['error']);
        }
    }

    /**
    * Copy image
    * @return bool
    */
    protected static function copyImage($tmp_name, $dir)
    {
        return copy($tmp_name, $dir);
    }
    
    /**
    * Move image.
    * @return bool
    */
    protected static function moveUpload($tmp_name, $dir)
    {
        return move_uploaded_file($tmp_name, $dir);
    }


    /**
    * Return Image Type
    * @param string $nameFile
    * @return int
    */
    public static function getImageType($nameFile)
    {
        return getimagesize($nameFile)[2];
    }
}
