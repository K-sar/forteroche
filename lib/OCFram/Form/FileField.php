<?php
namespace OCFram\Form;

class FileField extends Field
{  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<label>'.$this->label.'</label><input type="file" name="'.$this->name.'" />';
    return $widget;
  }

  public function setValue($value)
  {
      $this->value = $value;
  }
}