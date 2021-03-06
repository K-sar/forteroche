<?php
namespace OCFram\Form;

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
        if (!empty($_FILES)) 
        {
            //return false;
            
            $file = $_FILES[$this->fileName]['name'];
        
            if ($file == '')     
            {
                $value = 0;
            }
            else
            {
                $value = $_FILES[$this->fileName]['error'];
            }
        }

        return $value == 0;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
}