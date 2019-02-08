<?php
namespace OCFram\Form;

class NumberValidator extends Validator
{
    public function isValid($value)
    {
		$value1 = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
		try{
				$value2 = (int) $value1 ;
			}
		catch (Exception $e) 
			{
				$value2 = 0;
			}
        return $value2 ;
    }
}