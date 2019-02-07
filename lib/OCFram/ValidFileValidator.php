<?php
namespace OCFram;

class ValidFileValidator extends Validator
{
    protected $fileName;
  
    public function __construct($errorMessage,  $fileName)
    {
      parent::__construct($errorMessage);
      
      $this->setFileName($fileName);
    }
    
    public function isValid($value)
    {
        if (      $extension_upload = strtolower(  substr(  strrchr($_FILES[$this->fileName]['name'], '.')  ,1)  ) == '')
        {
            $value = 0;
        }
        else
        {
            $value = $_FILES[$this->fileName]['error'];
        }

        return $value == 0;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
}