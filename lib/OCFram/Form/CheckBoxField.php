<?php
namespace OCFram\Form;

class CheckBoxField extends Field
{  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<div><input type="checkbox" id="'.$this->name.'" name="'.$this->name.'" value="1" ';
    
    if ($this->value == 1)
    {
      $widget .= 'checked ';
    }

    $widget .= '><label for="'.$this->name.'" >'.$this->label.'</label></div>';


    return $widget;
  }
}