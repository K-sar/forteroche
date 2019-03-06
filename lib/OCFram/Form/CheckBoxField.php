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
    
    $widget .= 
   '<div class="form-check">
      <label for="'.$this->name.'" class="col-sm-2 form-check-label">
        <input class="form-check-input" type="checkbox" id="'.$this->name.'" name="'.$this->name.'" value="1" ';
  
        if ($this->value == 1)
        {
          $widget .= 'checked="" ';
        }

        $widget .= '> 
        '.$this->label.' 
      </label>
    </div>';


    return $widget;
  }
}