<?php
namespace OCFram;

class FileField extends Field
{  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<input type="hidden" name="MaxFileSize" value="'.$this->maxFileSize.'" /><label>'.$this->label.'</label><input type="file" name="'.$this->name.'" />';
    return $widget;
  }
}