<?php

namespace local_symfony\validation;

use Symfony\Component\Validator\Constraint;

class float extends Constraint {
    public $message = 'The string "%string%" is not a valid PARAM_NUMBER.';
    
    public function validatedBy() {
	    return get_class($this).'_validator';
	}
}