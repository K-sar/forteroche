<?php
namespace OCFram\Form;

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
      if (!empty($_FILES)) 
      {   
        $file = $_FILES[$this->fileName]['name'];
        
        if ($file == '')
        {
          return true;
        }
        else
        {
          $file = explode('.', $file);
          $extension = array_pop($file);
            
          return in_array($extension, $this->validFileType);
        }
      }
      return true;
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