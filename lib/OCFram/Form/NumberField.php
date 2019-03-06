<?php
namespace OCFram\Form;

class NumberField extends Field
{
  protected $maxLength;
  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<label class="col-sm-2 col-form-label">'.$this->label.'</label><div class="col-sm-10"><input type="number" min="0" max="999" name="'.$this->name.'"';
    
    if (!is_null($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }

    if (!empty($this->placeholder))
    {
      $widget .= ' placeholder="'.htmlspecialchars($this->placeholder).'"';
    }
    
    return $widget .= ' /></div>';
  }

  public function setValue($value)
  {
    if (is_numeric($value))
    {
      $this->value = $value;
    }
  }
}