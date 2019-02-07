<?php
namespace OCFram;

class MaxFileSizeValidator extends Validator
{
    protected $validFileType;
    protected $fileName;
  
    public function __construct($errorMessage, $maxFileSize, $fileName)
    {
        parent::__construct($errorMessage);
        
        $this->setMaxFileSize($maxFileSize);
        $this->setFileName($fileName);
    }
    
    public function isValid($value)
    {
        $fileSize = $_FILES[$this->fileName]['size'];
        return  $fileSize <= $this->maxFileSize;
    }
    
    public function setMaxFileSize($maxFileSize)
    {
        $maxFileSize = (int) $maxFileSize;
    
        if ($maxFileSize > 0)
        {
        $this->maxFileSize = $maxFileSize;
        }
      
        else
        {
            throw new \RuntimeException('La taille minimun du fichier ne peut pas être 0 octet');
        }
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
}