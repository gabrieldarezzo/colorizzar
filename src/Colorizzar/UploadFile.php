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
        static::handle();

        $name = (($customNameFile == '') ? $file['arquivo']['name'] : $customNameFile);
        $tmp_name = $file['arquivo']['tmp_name'];
        $this->setCustomNameFile($name);
        
        $upload_dir = $this->UploadPath . DIRECTORY_SEPARATOR . $name;

        $this->setFullPathFile($upload_dir);   
            
        if (!is_uploaded_file($tmp_name)) {
            return static::copyImage($tmp_name, $upload_dir);
        }
            
        return static::moveImage($tmp_name, $upload_dir);
    }

	/**
    * Responsible for conditional verification
    * @return void
    */
    protected static function handle(array $file)
    {
        if( empty( $file ) ) {
            return throw new \RuntimeException('File not defined');
        }    
        
        if(! file_exists( $this->UploadPath) ) {
            mkdir( $this->UploadPath );
        }
        
        if ($file['arquivo']['error'] !== UPLOAD_ERR_OK) {
            return throw new \Exception($file['arquivo']['error']); 
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
    protected static function moveImage($tmp_name, $dir)
    {
        return move_uploaded_file($tmp_name, $dir);
    }
}
