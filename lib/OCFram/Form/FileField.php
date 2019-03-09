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
    
    $widget .= '<div class="form-group row"><label class="col-sm-2 col-form-label">'.$this->label.'</label><div class="col-sm-10"><input type="file" class="form-control-file" name="'.$this->name.'" /></div></div>';
    

    return $widget;
  }

  public function setValue($value)
  {
      $this->value = $value;
  }
}