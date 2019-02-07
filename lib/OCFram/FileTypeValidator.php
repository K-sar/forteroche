<?php
namespace OCFram;

class FileTypeValidator extends Validator
{
    protected $validFileType;
    protected $fileName;
  
    public function __construct($errorMessage, $validFileType, $fileName)
    {
      parent::__construct($errorMessage);
      
      $this->setValidFileType($validFileType);
      $this->setFileName($fileName);
    }
    
    public function isValid($value)
    {
      $extension_upload = strtolower(  substr(  strrchr($_FILES[$this->fileName]['name'], '.')  ,1)  );
      
      return in_array($extension_upload, $this->validFileType);
    }
    
    public function setValidFileType($validFileType)
    {
      if (!is_null($validFileType))
      {
        $this->validFileType = $validFileType;
      }
      else
      {
        throw new \RuntimeException('Vous devez spécifier au moins un type de fichier');
      }
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
}