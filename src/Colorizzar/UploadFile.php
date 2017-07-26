<?php

namespace Colorizzar;

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
        $this->UploadPath = $path;
        return $this;
    }


    /**
    * @param string $customNameFile
    */
    public function setCustomNameFile($customNameFile)
    {
        $this->customNameFile = $customNameFile;
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
        if (count($file) == 0) {
            return false;
        }
            
        if (!file_exists($this->UploadPath)) {
            mkdir($this->UploadPath);
        }

        $name = (($customNameFile == '') ? $file['arquivo']['name'] : $customNameFile);
        $tmp_name = $file['arquivo']['tmp_name'];
        $this->setCustomNameFile($name);
        
        if ($file['arquivo']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = $this->UploadPath . DIRECTORY_SEPARATOR . $name;

            $this->setFullPathFile($upload_dir);

            
            
            if (!is_uploaded_file($tmp_name)) {
                return copy($tmp_name, $upload_dir);
            }
            
            return move_uploaded_file(
                $tmp_name,
                $upload_dir
            );
        }
    }
}
