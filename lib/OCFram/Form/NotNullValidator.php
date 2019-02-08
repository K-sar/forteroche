<?php
namespace OCFram\Form;

class NotNullValidator extends Validator
{
  public function isValid($value)
  {
    return $value != '';
  }
}