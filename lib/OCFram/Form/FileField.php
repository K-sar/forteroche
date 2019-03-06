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
    
    $widget .= '<label class="col-sm-2 col-form-label">'.$this->label.'<div class="col-sm-10"></label><input type="file" name="'.$this->name.'" /></div>';
    return $widget;
  }

  public function setValue($value)
  {
      $this->value = $value;
  }
}