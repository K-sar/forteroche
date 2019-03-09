<?php
namespace OCFram\Form;

class StringField extends Field
{
  protected $maxLength;
  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<div class="form-group row"><label class="col-sm-2 col-form-label">'.$this->label.'</label><div class="col-sm-10"><input type="text" class="form-control" name="'.$this->name.'"';
    
    if (!is_null($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }

    if (!empty($this->placeholder))
    {
      $widget .= ' placeholder="'.htmlspecialchars($this->placeholder).'"';
    }
    
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }
    
    return $widget .= ' /></div></div>';
  }
  
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
    
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}